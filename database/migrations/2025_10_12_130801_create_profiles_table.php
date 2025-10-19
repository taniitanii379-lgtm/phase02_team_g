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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->integer('level')->default(1);
            $table->integer('level_progress')->default(0);
            $table->string('theme_color')->default('#4A90E2');
            $table->integer('total_plays')->default(0);
            $table->integer('accuracy')->default(0);
            $table->bigInteger('total_score')->default(0);
            $table->string('favorite_genre')->nullable();
            $table->string('weakest_genre')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
