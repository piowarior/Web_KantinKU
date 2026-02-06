<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Helper\EncryptionHelper;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/orders",
     *     operationId="getOrders",
     *     tags={"Orders"},
     *     summary="Get all orders",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index()
    {
        $orders = Order::all();

        $response = EncryptionHelper::encrypt(json_encode([
            'message' => 'success',
            'data' => $orders,
        ]));

        return response()->json(['data' => $response]);
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     operationId="storeOrder",
     *     tags={"Orders"},
     *     summary="Create new order",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'     => 'nullable|exists:users,id',
            'order_type'  => 'required|in:online,offline',
            'total_price' => 'required|integer|min:0',
            'status'      => 'nullable|in:pending,processing,ready,done',
        ]);

        $order = Order::create([
            'user_id'     => $validated['user_id'] ?? null,
            'order_code'  => Order::generateOrderCode(),
            'order_type'  => $validated['order_type'],
            'status'      => $validated['status'] ?? 'pending',
            'total_price' => $validated['total_price'],
        ]);

        $response = EncryptionHelper::encrypt(json_encode([
            'message' => 'Order created successfully',
            'data' => $order,
        ]));

        return response()->json(['data' => $response]);
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}",
     *     operationId="getOrderById",
     *     tags={"Orders"},
     *     summary="Get order by ID",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $response = EncryptionHelper::encrypt(json_encode([
            'message' => 'success',
            'data' => $order,
        ]));

        return response()->json(['data' => $response]);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}",
     *     operationId="updateOrder",
     *     tags={"Orders"},
     *     summary="Update order",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $validated = $request->validate([
            'order_type'  => 'sometimes|in:online,offline',
            'status'      => 'sometimes|in:pending,processing,ready,done',
            'total_price' => 'sometimes|integer|min:0',
        ]);

        $order->update($validated);

        $response = EncryptionHelper::encrypt(json_encode([
            'message' => 'Order updated successfully',
            'data' => $order,
        ]));

        return response()->json(['data' => $response]);
    }

    /**
     * @OA\Delete(
     *     path="/api/orders/{id}",
     *     operationId="deleteOrder",
     *     tags={"Orders"},
     *     summary="Delete order",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        $response = EncryptionHelper::encrypt(json_encode([
            'message' => 'Order deleted successfully',
            'data' => ['id' => $id],
        ]));

        return response()->json(['data' => $response]);
    }

    /**
     * @OA\Post(
     *     path="/api/orders/decrypt",
     *     operationId="decryptOrderResponse",
     *     tags={"Orders"},
     *     summary="Decrypt order response",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function decryptResponse(Request $request)
    {
        try {
            return response()->json(
                json_decode(EncryptionHelper::decrypt($request->data), true)
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Decrypt Failed',
            ], 400);
        }
    }
}
