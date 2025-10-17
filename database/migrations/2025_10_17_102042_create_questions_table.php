<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 実行時にquestionsテーブルを作成
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            // quizzesテーブルのcategory_idを参照する（クイズのまとまり）
            $table->unsignedBigInteger('quiz_id');

            // 問題文
            $table->text('question');

            // 正解（〇＝1、×＝0）
            $table->boolean('answer');

            // 作成日時・更新日時
            $table->timestamps();

            // 外部キー制約（クイズ削除時に問題も削除）
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * ロールバック時に削除
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
