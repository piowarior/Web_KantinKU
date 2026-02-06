<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     title="Order",
 *     required={"id", "order_code", "status", "total_price"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="order_code", type="string", example="L23"),
 *     @OA\Property(property="source", type="string", example="online"),
 *     @OA\Property(property="status", type="string", example="pending"),
 *     @OA\Property(property="total_price", type="number", example=20000),
 *
 *     @OA\Property(
 *         property="items",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/OrderItem")
 *     ),
 *
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Order {}
