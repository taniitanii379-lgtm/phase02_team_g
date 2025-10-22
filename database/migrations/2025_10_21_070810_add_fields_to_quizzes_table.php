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
        Schema::table('quizzes', function (Blueprint $table) {
            if (!Schema::hasColumn('quizzes', 'question')) {
                $table->text('question')->after('title');
            }
            if (!Schema::hasColumn('quizzes', 'choices')) {
                $table->json('choices')->nullable()->after('question');
            }
            if (!Schema::hasColumn('quizzes', 'answer')) {
                $table->integer('answer')->nullable()->after('choices');
            }
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            if (Schema::hasColumn('quizzes', 'question')) {
                $table->dropColumn('question');
            }
            if (Schema::hasColumn('quizzes', 'choices')) {
                $table->dropColumn('choices');
            }
            if (Schema::hasColumn('quizzes', 'answer')) {
                $table->dropColumn('answer');
            }
        });
    }
};