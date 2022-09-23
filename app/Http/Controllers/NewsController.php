<?php

namespace App\Http\Controllers;

use App\News;
use stdClass;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    //

  public function TestApi(){
    $client = new \GuzzleHttp\Client();
    $r= $client->request('GET', 'https://wonderful-mendel.157-245-151-217.plesk.page/api/getApi');
     $news = $r->getBody()->getContents(); //return string format
    $news = json_decode($news, true); //return array format
    $news = $this->paginate($news);
    return view('TestApi.welcome1', compact('news'));
}

public function index(){
    /*
    $users=User::all e();
    // $news=News::all();
     $news = DB::table('countries')
     ->join('sources', 'sources.source_country', '=', 'countries.country_code')
     ->join('news', 'news.source_id', '=', 'sources.id')
     ->select('news.*','country_name','source_name')
     ->orderBy('datetime', 'desc')
     ->get();
     return view('welcome', compact('users','news'));
     */
    $client = new \GuzzleHttp\Client();
    $r= $client->request('GET', 'https://wonderful-mendel.157-245-151-217.plesk.page/api/getApi');
     $news = $r->getBody()->getContents(); //return string format
    $news = json_encode($news, true); //return array format
    $news = $this->paginate($news);
    return view('TestApi.welcome1', compact('news'));
}
  public function view($id){
    $new=News::find($id);
    return view('news-view', compact('new'));

  }
  /*
  public function paginate($items, $perPage = 10, $page = null)
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $total = count($items);
    $currentpage = $page;
    $offset = ($currentpage * $perPage) - $perPage ;
    $itemstoshow = array_slice($items , $offset , $perPage);
    return new LengthAwarePaginator($itemstoshow ,$total ,$perPage);
}
*/

  public function paginate($items, $perPage = 15, $page = null, $options = [])
  {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
     // return dd($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
  }

  /*
  public function getMoreTags(Request $request){

    $news = News::orderBy('title_original', 'asc')->simplePaginate(400);
    if($request->ajax()) {

       $news= News::query()->where('title_original', 'LIKE', "{$request->search}")->simplePaginate(400);
    }

    return view('news.news_data', compact('news'))->render();
}
*/
public function keywords(Request $request){
    $keyword_array=null;
    $news=news::get();
    return view('news.keywords',compact('news','keyword_array'));
}
public function SearchKeywords(Request $request){
      $keyword_array=$request->Keywords;

                $keyword_string=implode(',',$keyword_array);
          $book = explode(',', $keyword_string);
          $book = str_replace('أ', 'ا', $book);
          $book = str_replace('إ', 'ا', $book);
          $book = str_replace('ة', 'ه', $book);




          $news = DB::table('countries')
          ->join('sources', 'sources.source_country', '=', 'countries.country_code')
          ->join('news', 'news.source_id', '=', 'sources.id')
          ->select('news.*','country_name','source_name')

             ->Where(function ($query) use($book) {

                  for ($i = 0; $i < count($book); $i++){
                     $query->orwhereRaw("(REPLACE(REPLACE(REPLACE(body_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                     . "REPLACE(REPLACE(REPLACE(body_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                     . " )")->orwhereRaw("(REPLACE(REPLACE(REPLACE(title_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                     . "REPLACE(REPLACE(REPLACE(title_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                     . " )")->orwhereRaw("(REPLACE(REPLACE(REPLACE(body_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                     . "REPLACE(REPLACE(REPLACE(body_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                     . " )")->orwhereRaw("(REPLACE(REPLACE(REPLACE(title_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                     . "REPLACE(REPLACE(REPLACE(title_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                     . " )");
                  }
             })->get(); //->whereBetween('datetime', [$fromformat, $toformat])->get();
             return view('welcome',compact('news','keyword_array'));


            }
public function all(){
    return view('search');
}



}
