<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Helper\EncryptionHelper;

class NotificationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/notifications",
     *     operationId="getNotifications",
     *     tags={"Notifications"},
     *     summary="Get all notifications (by user)",
     *     description="Returns notifications for authenticated user.",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Notification")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $data = Notification::where('user_id', auth()->id())->get();

        $responseData = [
            'message' => 'success',
            'data' => $data,
        ];

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode($responseData)),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/notifications",
     *     operationId="storeNotification",
     *     tags={"Notifications"},
     *     summary="Create a new notification",
     *     description="Stores a new notification for authenticated user.",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "message"},
     *             @OA\Property(property="title", type="string", example="Order Update"),
     *             @OA\Property(property="message", type="string", example="Pesanan kamu sedang diproses")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Notification created"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $notif = Notification::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'message' => $validated['message'],
            'read' => false,
        ]);

        $responseData = [
            'message' => 'Notification created successfully',
            'data' => $notif,
        ];

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode($responseData)),
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/notifications/{id}",
     *     operationId="getNotificationById",
     *     tags={"Notifications"},
     *     summary="Get notification by ID",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function show($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$notif) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode([
                'message' => 'success',
                'data' => $notif,
            ]))
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/notifications/{id}",
     *     operationId="updateNotification",
     *     tags={"Notifications"},
     *     summary="Update notification (title, message, read)",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$notif) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'message' => 'sometimes|string',
            'read' => 'sometimes|boolean',
        ]);

        $notif->update($validated);

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode([
                'message' => 'Notification updated successfully',
                'data' => $notif,
            ]))
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/notifications/{id}",
     *     operationId="deleteNotification",
     *     tags={"Notifications"},
     *     summary="Delete notification",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function destroy($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$notif) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notif->delete();

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode([
                'message' => 'Notification deleted successfully',
                'data' => ['id' => $id],
            ]))
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/notifications/mark-read/{id}",
     *     operationId="markNotificationRead",
     *     tags={"Notifications"},
     *     summary="Mark notification as read",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function markAsRead($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$notif) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notif->update(['read' => true]);

        return response()->json([
            'data' => EncryptionHelper::encrypt(json_encode([
                'message' => 'Notification marked as read',
                'data' => $notif,
            ]))
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/notifications/decrypt",
     *     operationId="decryptNotificationResponse",
     *     tags={"Notifications"},
     *     summary="Decrypt encrypted notification data",
     *     security={{"ApiKeyAuth":{}}}
     * )
     */
    public function decryptResponse(Request $request)
    {
        try {
            $decryptedJson = EncryptionHelper::decrypt($request->data);
            return response()->json(json_decode($decryptedJson, true));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Decrypt Failed',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
