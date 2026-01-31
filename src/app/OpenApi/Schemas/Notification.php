<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Notification",
 *     type="object",
 *     title="Notification",
 *     required={"id", "user_id", "title", "message", "read"},
 *     
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=3),
 *     @OA\Property(property="title", type="string", example="Pesanan Baru"),
 *     @OA\Property(property="message", type="string", example="Pesanan #123 telah diterima."),
 *     @OA\Property(property="read", type="boolean", example=false),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 * )
 */
class Notification {}
