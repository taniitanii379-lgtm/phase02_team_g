<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /** @use HasFactory<\Database\Factories\QuizFactory> */
    use HasFactory;// ★ 複数代入できるカラムを指定（フォームで受け取るもの）
    protected $fillable = [ 'title',
        'category_id',];

    // 🔹 Category モデルとのリレーションを定義
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // 🔹 カテゴリ名を安全に取得（存在しない場合は「未分類」）
    public function getCategoryNameAttribute()
    {
        return optional($this->category)->name ?? '未分類';
    }

}
