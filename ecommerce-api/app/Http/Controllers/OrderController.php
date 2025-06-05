<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'products'               => 'required|array|min:1',
            'products.*.id'          => 'required|integer|exists:products,id',
            'products.*.quantity'    => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No autenticado'
            ], 401);
        }

        DB::beginTransaction();

        try {
            $itemsData = $data['products'];
            $totalAmount = 0.0;

            foreach ($itemsData as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['id']);
                $quantity = $item['quantity'];

                if ($quantity > $product->stock) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => "No hay stock suficiente para el producto: {$product->name}"
                    ], 422);
                }

                $price = $product->price;
                $totalAmount += $price * $quantity;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'total'   => $totalAmount,
                'status'  => 'PENDING'
            ]);

            foreach ($itemsData as $item) {
                $product = Product::findOrFail($item['id']);
                $quantity = $item['quantity'];
                $price = $product->price;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $quantity,
                    'price'      => $price
                ]);

                $product->decrement('stock', $quantity);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data'    => [
                    'order_id' => $order->id,
                    'total'    => $totalAmount
                ],
                'message' => 'Pedido registrado exitosamente'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el pedido',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
