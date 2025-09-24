<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('posts')->insert([
            [
                'title' => '첫 번째 게시글',
                'contents' => '테스트 내용입니다.',
                'user_id' => 1,
            ],
            [
                'title' => '두 번째 게시글',
                'contents' => 'Laravel 12 + PHP 8.1 예제입니다.',
                'user_id' => 2,
            ],
        ]);
    }
}
