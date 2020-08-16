<?php

namespace App\Http\Controllers;

use App\Repositories\UrlRepository;
use App\Url;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{
    protected $urlRepository;
    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function index(){
        return view('urls.index',[
            'urls' => $this->urlRepository->getAllUrls()
        ]);
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $url = $this->urlRepository->createUrl($request->all());
        } catch (Exception $e) {
            DB::rollback();
            if($e instanceof ValidationException)  return response()->json(['error' => 'Invalid Url']);
            return response()->json(['error' => 'Something went wrong']);
        }
        DB::commit();
        return response()->json(['success' => $url]);
    }

    public function getShortenurl($code){

        $url = Url::where('code', $code)->firstOrFail();
        return redirect($url->url);
    }
}
