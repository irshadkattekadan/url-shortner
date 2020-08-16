<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'total_urls' => Url::count(),
            'duplicate_url_count' => $this->getDuplicateUrlsCount()
        ]);
    }

    private function getDuplicateUrlsCount(){
        $grouped_urls = Url::select(DB::raw('count(*) as count'), 'url')->groupBy('url')->get();
        return $grouped_urls->where('count', '>', 1)->count();
    }

}
