<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Helper\EncryptionHelper;

class OrderItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/order-items/{order_id}",
     *     operationId="getOrderItems",
     *     tags={"Order Items"},
     *     summary="Get items by order ID",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="order_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function index($order_id)
    {
        $items = OrderItem::where('order_id', $order_id)->with('menu')->get();

        $responseData = [
            'message' => 'success',
            'data' => $items,
        ];

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode($responseData)),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/order-items",
     *     operationId="storeOrderItem",
     *     tags={"Order Items"},
     *     summary="Add item to order",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"order_id","menu_id","quantity"},
     *             @OA\Property(property="order_id", type="integer", example=1),
     *             @OA\Property(property="menu_id", type="integer", example=2),
     *             @OA\Property(property="quantity", type="integer", example=2)
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($validated['menu_id']);

        $subtotal = $menu->price * $validated['quantity'];

        $item = OrderItem::create([
            'order_id' => $validated['order_id'],
            'menu_id' => $validated['menu_id'],
            'quantity' => $validated['quantity'],
            'price' => $menu->price,
            'subtotal' => $subtotal,
        ]);

        // update total order
        $order = Order::find($validated['order_id']);
        $order->increment('total_price', $subtotal);

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode([
                'message' => 'Order item added',
                'data' => $item,
            ]))
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/order-items/{id}",
     *     operationId="updateOrderItem",
     *     tags={"Order Items"},
     *     summary="Update order item quantity",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $item = OrderItem::find($id);

        if (!$item) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $oldSubtotal = $item->subtotal;
        $newSubtotal = $item->price * $validated['quantity'];

        $item->update([
            'quantity' => $validated['quantity'],
            'subtotal' => $newSubtotal,
        ]);

        // update order total
        $order = Order::find($item->order_id);
        $order->update([
            'total_price' => $order->total_price - $oldSubtotal + $newSubtotal
        ]);

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode([
                'message' => 'Order item updated',
                'data' => $item,
            ]))
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/order-items/{id}",
     *     operationId="deleteOrderItem",
     *     tags={"Order Items"},
     *     summary="Delete order item",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function destroy($id)
    {
        $item = OrderItem::find($id);

        if (!$item) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $order = Order::find($item->order_id);
        $order->decrement('total_price', $item->subtotal);

        $item->delete();

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode([
                'message' => 'Order item deleted',
                'data' => ['id' => $id],
            ]))
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/order-items/decrypt",
     *     operationId="decryptOrderItemResponse",
     *     tags={"Order Items"},
     *     summary="Decrypt encrypted order item data",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function decryptResponse(Request $request)
    {
        try {
            $json = EncryptionHelper::decrypt($request->data);
            return response()->json(json_decode($json, true));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Decrypt Failed',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
