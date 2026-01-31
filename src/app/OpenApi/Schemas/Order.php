<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     title="Order",
 *     required={"id", "nama_pemesan", "menu_id", "jumlah", "total_harga"},
 *     
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama_pemesan", type="string", example="Rina"),
 *     @OA\Property(property="menu_id", type="integer", example=3),
 *     @OA\Property(property="jumlah", type="integer", example=2),
 *     @OA\Property(property="total_harga", type="number", format="float", example=50000),
 *     @OA\Property(property="catatan", type="string", example="Tanpa sambal", nullable=true),
 *     @OA\Property(property="status", type="string", example="diproses"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 * )
 */
class Order {}
