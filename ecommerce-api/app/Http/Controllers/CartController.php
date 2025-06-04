<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the user's cart with products
     */
    public function index(): JsonResponse
    {
        try {
            $user = Auth::user();

            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            $cartWithProducts = Cart::with(['products' => function($query) {
                $query->with('category')->select([
                    'products.id',
                    'products.name',
                    'products.description',
                    'products.price',
                    'products.image',
                    'products.category_id'
                ]);
            }])->find($cart->id);

            $cartItems = $cartWithProducts->products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image_url' => $product->image ? asset('storage/' . $product->image) : asset('images/no-image.jpg'),
                    'category' => $product->category,
                    'quantity' => $product->pivot->quantity,
                    'subtotal' => $product->price * $product->pivot->quantity
                ];
            });

            $total = $cartItems->sum('subtotal');
            $totalItems = $cartItems->sum('quantity');

            return response()->json([
                'success' => true,
                'data' => [
                    'cart_id' => $cart->id,
                    'items' => $cartItems,
                    'total_items' => $totalItems,
                    'total_amount' => $total
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en index del carrito: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el carrito',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        try {
            $userId = Auth::user()->id;
            $productId = $request->input('product_id');

            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            $existingProduct = $cart->products()->where('product_id', $productId)->first();

            if ($existingProduct) {
                $cart->products()->updateExistingPivot($productId, [
                    'quantity' => $existingProduct->pivot->quantity + 1,
                    'updated_at' => now()
                ]);
            } else {
                $cart->products()->attach($productId, [
                    'quantity' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Producto agregado al carrito correctamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al agregar producto al carrito',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update product quantity in cart
     */
    public function updateQuantity(Request $request, $productId): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $user = Auth::user();
            $quantity = $request->quantity;

            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Carrito no encontrado'
                ], 404);
            }

            $productInCart = $cart->products()->where('product_id', $productId)->first();

            if (!$productInCart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no encontrado en el carrito'
                ], 404);
            }

            $cart->products()->updateExistingPivot($productId, [
                'quantity' => $quantity,
                'updated_at' => now()
            ]);

            $product = Product::find($productId);
            $subtotal = $product->price * $quantity;

            return response()->json([
                'success' => true,
                'message' => 'Cantidad actualizada',
                'data' => [
                    'product_id' => $productId,
                    'new_quantity' => $quantity,
                    'subtotal' => $subtotal
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en updateQuantity: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar cantidad',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove product from cart
     */
    public function removeFromCart($productId): JsonResponse
    {
        try {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Carrito no encontrado'
                ], 404);
            }

            $productInCart = $cart->products()->where('product_id', $productId)->first();

            if (!$productInCart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no encontrado en el carrito'
                ], 404);
            }

            // Remove product from cart
            $cart->products()->detach($productId);

            // Get product name for response
            $product = Product::find($productId);

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado del carrito',
                'data' => [
                    'product_name' => $product ? $product->name : 'Producto',
                    'removed_product_id' => $productId
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en removeFromCart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear all items from cart
     */
    public function clearCart(): JsonResponse
    {
        try {
            $user = Auth::user();

            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Carrito no encontrado'
                ], 404);
            }

            $cart->products()->detach();

            return response()->json([
                'success' => true,
                'message' => 'Carrito vaciado correctamente'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en clearCart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al vaciar el carrito',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart items count
     */
    public function getCartCount(): JsonResponse
    {
        try {
            $user = Auth::user();

            $cart = Cart::where('user_id', $user->id)->first();

            $count = 0;
            if ($cart) {
                $count = $cart->products()->sum('cart_product.quantity'); // Especificar la tabla pivot
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'count' => $count
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en getCartCount: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener contador del carrito',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
