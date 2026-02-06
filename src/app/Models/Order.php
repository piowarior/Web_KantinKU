<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_code', 'order_type', 'status', 'total_price'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateOrderCode(): string
    {
        $prefix = chr(rand(65, 90)); // A-Z
        $number = rand(10, 99);

        return $prefix . $number;
    }
}
