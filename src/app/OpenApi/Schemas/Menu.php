<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Menu",
 *     type="object",
 *     title="Menu",
 *     required={"id", "nama_menu", "kategori", "harga"},
 *     
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama_menu", type="string", example="Nasi Goreng Spesial"),
 *     @OA\Property(property="kategori", type="string", example="Makanan"),
 *     @OA\Property(property="harga", type="number", format="float", example=25000),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 * )
 */
class Menu {}
