<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('1234qwer!'),
            'email_verified_at' => $now,
        ]);

        User::factory()->create([
            'name' => '테스트 유저 1',
            'email' => 'testUser1@example.com',
            'password' => Hash::make('1234qwer!'),
            'email_verified_at' => $now,
        ]);

        User::factory()->create([
            'name' => '테스트유저2',
            'email' => 'testUser2@example.com',
            'password' => Hash::make('1234qwer!'),
            'email_verified_at' => $now,
        ]);
    }
}
