<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // 代入を許可するカラムを指定
    protected $fillable = [
        'title',
        'category_id',
    ];

    // Question とのリレーション
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}