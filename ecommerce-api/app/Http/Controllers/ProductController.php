<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Product::with('category');

            // Búsqueda por texto
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                });
            }

            // Filtrar por categorías
            if ($request->has('categories') && is_array($request->categories)) {
                $categories = array_filter($request->categories);
                if (!empty($categories)) {
                    $query->whereIn('category_id', $categories);
                }
            }

            // Ordenamiento
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');

            $allowedSorts = ['name', 'price', 'created_at', 'updated_at'];
            if (in_array($sortBy, $allowedSorts)) {
                $query->orderBy($sortBy, $sortOrder);
            }

            // Paginación
            $perPage = $request->get('per_page', 12);
            $perPage = min($perPage, 50); // Máximo 50 por página

            if ($request->has('page')) {
                $products = $query->paginate($perPage);

                // Transformar productos
                $products->getCollection()->transform(function ($product) {
                    return $this->transformProduct($product);
                });

                return response()->json([
                    'success' => true,
                    'data' => $products->items(),
                    'meta' => [
                        'current_page' => $products->currentPage(),
                        'per_page' => $products->perPage(),
                        'total' => $products->total(),
                        'last_page' => $products->lastPage(),
                        'from' => $products->firstItem(),
                        'to' => $products->lastItem(),
                    ],
                    'message' => 'Productos obtenidos exitosamente'
                ], 200);
            } else {
                // Sin paginación (para compatibilidad)
                $products = $query->limit($perPage)->get();
                $products->transform(function ($product) {
                    return $this->transformProduct($product);
                });

                return response()->json([
                    'success' => true,
                    'data' => $products,
                    'message' => 'Productos obtenidos exitosamente'
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los productos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = Product::with('category')->findOrFail($id);
            $product = $this->transformProduct($product);

            return response()->json([
                'success' => true,
                'data' => $product,
                'message' => 'Producto obtenido exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function search(Request $request): JsonResponse
    {
        try {
            $searchTerm = $request->get('search', '');

            if (empty($searchTerm)) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'Término de búsqueda vacío'
                ], 200);
            }

            $products = Product::with('category')
                ->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                ->orWhereHas('category', function($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%{$searchTerm}%");
                })
                ->limit(20)
                ->get();

            $products->transform(function ($product) {
                return $this->transformProduct($product);
            });

            return response()->json([
                'success' => true,
                'data' => $products,
                'message' => 'Búsqueda completada exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la búsqueda',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function transformProduct($product)
    {
        if ($product->image) {
            $product->image_url = asset('storage/' . $product->image);
        } else {
            $product->image_url = asset('images/no-image.jpg');
        }

        return $product;
    }
}
