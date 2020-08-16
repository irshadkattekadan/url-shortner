<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['title', 'url', 'code', 'user_id'];

    protected $casts = ['created_at' => 'datetime: d M, Y'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
