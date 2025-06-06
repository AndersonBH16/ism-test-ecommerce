<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            // 1) Total de usuarios
            $totalUsers = User::count();

            // 2) Total de productos
            $totalProducts = Product::count();

            // 3) Total de pedidos
            $totalOrders = Order::count();

            // 4) Producto más solicitado (sumando cantidades en order_items)
            $mostRequested = DB::table('order_items')
                ->select('product_id', DB::raw('SUM(quantity) as total_qty'))
                ->groupBy('product_id')
                ->orderByDesc('total_qty')
                ->limit(1)
                ->first();

            if ($mostRequested) {
                // Obtener nombre del producto
                $product = Product::find($mostRequested->product_id);
                $mostRequestedProduct = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'count' => (int) $mostRequested->total_qty,
                ];
            } else {
                $mostRequestedProduct = null;
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'total_users' => $totalUsers,
                    'total_products' => $totalProducts,
                    'total_orders' => $totalOrders,
                    'most_requested_product' => $mostRequestedProduct,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener estadísticas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
