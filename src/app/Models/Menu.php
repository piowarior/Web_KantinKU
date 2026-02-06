<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category', 'image', 'is_available'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
