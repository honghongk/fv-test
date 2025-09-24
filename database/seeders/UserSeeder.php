<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => '테스트 유저 1',
            'email' => 'testUser1@example.com',
        ]);

        User::factory()->create([
            'name' => '테스트유저2',
            'email' => 'testUser2@example.com',
        ]);
    }
}
