<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@admin.com')->first();

        if ($user) {
            Order::create([
                'user_id' => $user->id,
                'quantity' => 2,
                'status' => 'pending',
            ]);

            Order::create([
                'user_id' => $user->id,
                'quantity' => 1,
                'status' => 'done',
            ]);
        }
    }
}
