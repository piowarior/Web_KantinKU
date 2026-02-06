<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Notification",
 *     type="object",
 *     title="Notification",
 *     required={"id", "user_id", "title", "message", "is_read"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=3),
 *     @OA\Property(property="order_id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Pesanan Baru"),
 *     @OA\Property(property="message", type="string", example="Pesanan L23 telah dibuat"),
 *     @OA\Property(property="is_read", type="boolean", example=false),
 *
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Notification {}
