<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'choices', 
        'answer',
    ];
// choices を JSON ↔ 配列として自動変換
    protected $casts = [
        'choices' => 'array', // ここを追加
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
