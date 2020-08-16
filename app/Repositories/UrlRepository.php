<?php

namespace App\Repositories;

use App\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlRepository
{
    public function getAllUrls(){
        return Url::orderBy('created_at', 'desc')->get();
    }

    public function createUrl($data){
        validator($data,[
            'title' => 'bail|required',
            'url' => 'bail|required|url'
        ])->validate();
        return Url::create(['title' => $data['title'], 'url' => $data['url'], 'code' => Str::random(8), 'user_id' => Auth::user()->id]);
    }
}
