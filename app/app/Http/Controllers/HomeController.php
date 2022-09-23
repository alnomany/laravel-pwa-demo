<?php

namespace App\Http\Controllers;

use App\source;
use App\Country;
use App\Languages;
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
        $news = DB::table('countries')
        ->join('sources', 'sources.source_country', '=', 'countries.country_code')
        ->join('news', 'news.source_id', '=', 'sources.id')
        ->select('news.*','country_name','source_name')

        ->orderBy('datetime', 'desc')
        ->get();
        $languages=Languages::orderBy('created_at', 'desc')->get();
        $countries=Country::orderBy('created_at', 'desc')->get();
        $sources=source::orderBy('created_at', 'desc')->get();
        return view('search.approve',compact('news','languages','countries','sources'));
    }
}
