<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Menu",
 *     type="object",
 *     title="Menu",
 *     required={"id", "name", "price", "category", "is_available"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Nasi Goreng Spesial"),
 *     @OA\Property(property="description", type="string", example="Nasi goreng dengan telur dan ayam"),
 *     @OA\Property(property="price", type="number", example=25000),
 *     @OA\Property(property="category", type="string", example="Makanan"),
 *     @OA\Property(property="image", type="string", example="menu/nasgor.jpg"),
 *     @OA\Property(property="is_available", type="boolean", example=true),
 *
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Menu {}
