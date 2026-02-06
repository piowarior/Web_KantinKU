<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="OrderItem",
 *     type="object",
 *     title="Order Item",
 *     required={"id", "order_id", "menu_id", "qty", "price"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="order_id", type="integer", example=1),
 *     @OA\Property(property="menu_id", type="integer", example=3),
 *     @OA\Property(property="menu_name", type="string", example="Nasi Goreng"),
 *     @OA\Property(property="qty", type="integer", example=2),
 *     @OA\Property(property="price", type="number", example=10000),
 *     @OA\Property(property="subtotal", type="number", example=20000),
 *
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class OrderItem {}
