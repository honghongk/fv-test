<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // 모델로 직접 생성
        Comment::create([
            'post_id'  => 1,
            'user_id'  => 2,
            'contents' => '1-2 댓글',
        ]);

        Comment::create([
            'post_id'  => 2,
            'user_id'  => 3,
            'contents' => '2-3 댓글',
        ]);
    }
}
