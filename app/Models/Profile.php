<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = ['id']; // id以外は全て一括代入を許可

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
