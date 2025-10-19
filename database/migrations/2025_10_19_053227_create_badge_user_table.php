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
        Schema::create('badge_user', function (Blueprint $table) {
            // usersテーブルのIDに紐づく外部キー
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // badgesテーブルのIDに紐づく外部キー
            $table->foreignId('badge_id')->constrained()->onDelete('cascade');

            // user_idとbadge_idの組み合わせでユニークにする（同じバッジを2回取得させないため）
            $table->primary(['user_id', 'badge_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badge_user');
    }
};