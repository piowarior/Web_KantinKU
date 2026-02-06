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
            
        }
    }
}
