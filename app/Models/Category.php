<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 複数代入可能なカラム
    protected $fillable = ['name'];

    // Quiz とのリレーション（1対多）
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
