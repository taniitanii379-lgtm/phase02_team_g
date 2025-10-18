<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /** @use HasFactory<\Database\Factories\QuizFactory> */
    use HasFactory;// ★ 複数代入できるカラムを指定（フォームで受け取るもの）
    protected $fillable = ['question', 'choices', 'answer','category_id',];

    // ★ choices を JSON → 配列として自動変換
    protected $casts = [
        'choices' => 'array',
    ];
}
