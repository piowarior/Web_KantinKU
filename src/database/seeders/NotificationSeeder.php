<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@admin.com')->first();

        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Pesanan Diterima',
                'message' => 'Pesanan Anda telah diterima dan sedang diproses.',
            ]);

            Notification::create([
                'user_id' => $user->id,
                'title' => 'Pesanan Selesai',
                'message' => 'Pesanan Anda telah selesai dan siap diambil.',
            ]);
        }
    }
}
