<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('comments')->insert([
            [
                'post_id' => 1,
                'user_id' => 2,
                'contents' => '1-2 댓글'
            ],
            [
                'post_id' => 2,
                'user_id' => 3,
                'contents' => '2-3 댓글'
            ],
        ]);
    }
}
