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

            // Filtros de búsqueda...
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                });
            }

            // Filtro por categorías...
            if ($request->has('categories') && is_array($request->categories)) {
                $categories = array_filter($request->categories);
                if (!empty($categories)) {
                    $query->whereIn('category_id', $categories);
                }
            }

            // Orden y ordenamiento
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $allowedSorts = ['name', 'price', 'created_at', 'updated_at'];
            if (in_array($sortBy, $allowedSorts)) {
                $query->orderBy($sortBy, $sortOrder);
            }

            // Paginación (per_page viene de Angular)
            $perPage = $request->get('per_page', 12);
            $perPage = min($perPage, 50);

            if ($request->has('page')) {
                $products = $query->paginate($perPage);
                $products->getCollection()->transform(function ($product) {
                    return $this->transformProduct($product);
                });

                return response()->json([
                    'success' => true,
                    'data'    => $products->items(),
                    'meta'    => [
                        'current_page' => $products->currentPage(),
                        'per_page'     => $products->perPage(),
                        'total'        => $products->total(),
                        'last_page'    => $products->lastPage(),
                        'from'         => $products->firstItem(),
                        'to'           => $products->lastItem(),
                    ],
                    'message' => 'Productos obtenidos exitosamente'
                ], 200);
            } else {
                // Si no hay page, devuelve un simple limit()
                $products = $query->limit($perPage)->get();
                $products->transform(function ($product) {
                    return $this->transformProduct($product);
                });
                return response()->json([
                    'success' => true,
                    'data'    => $products,
                    'message' => 'Productos obtenidos exitosamente'
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los productos',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    private function transformProduct($product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => (float) $product->price,
            'image' => $product->image,
            'stock'       => $product->stock,
            'category' => $product->category ? [
                'id' => $product->category->id,
                'name' => $product->category->name
            ] : null,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at
        ];
    }

    public function show($id): JsonResponse
    {
        try {
            $product = Product::with('category')->findOrFail($id);
            $productTransformed = $this->transformProduct($product);

            return response()->json([
                'success' => true,
                'data'    => $productTransformed,
                'message' => 'Producto obtenido exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
                'error'   => $e->getMessage()
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
}
