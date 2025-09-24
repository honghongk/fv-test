<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 댓글 comment 테이블 생성
        Schema::create('comments', function (Blueprint $table) {

            // pk
            $table->unsignedBigInteger('id', true)->length(20);
            // 필요시 fk
            $table->unsignedBigInteger('post_id')->index('post_id');
            $table->unsignedBigInteger('user_id')->index('user_id');

            $table->longText('contents');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
