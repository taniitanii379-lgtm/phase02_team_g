<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score',
        'quiz_id',
    ];

    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // クイズとのリレーション(実装されたらコメントアウトを解除)
   /* public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }*/
}
