<?php

namespace App\Http\Controllers;

use App\News;
use App\source;
use App\Country;
use App\Coverage;
use App\Languages;
use App\Exports\NewsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;
use Google\Cloud\Translate\V2\TranslateClient;


class NewsController extends Controller
{


    public function getLogin()
    {
        // Is the user logged in?

        // Show the login page
        return view('login');
    }
    public function export(){

        return Excel::download(new NewsExport, 'newsData.xlsx');

    }

    //report
    public function report(){
        return view('reports.index');
    }
    //rport search
    public function searchreport(Request $request){
        $country = $request->input('country');
      $source = $request->input('source');
      $types=$request->input('types');
      $language = $request->input('language');
    if($country == "all" || $source == "all" || $language == "all"){
        $news = News::query()->orderBy('created_at', 'desc')
        ->get();
        return view('reports.result', compact('news'));

    }elseif($language !="0" ||$country !="0" || $types !="0" || $source !="0"){

        return view('reports.result', compact('news'));

    }
}
public function wordExport(Request $request)
{

    $country = $request->input('country');
    $source = $request->input('source');
    $types=$request->input('types');
    $language = $request->input('language');
  if($country == "all" || $source == "all" || $language == "all"){
    $news = DB::table('countries')
    ->join('sources', 'sources.source_country', '=', 'countries.country_code')
    ->join('news', 'news.source_id', '=', 'sources.id')
    ->select('news.*','country_name','source_name','source_logo')


    ->orderBy('created_at', 'asc')
    ->get();
      $newscount = News::query()->orderBy('created_at', 'desc')
      ->get()->count();

    $templateProcessor = new TemplateProcessor('word-template/reportnewupdate.docx');
foreach($news as $key=>$new){


    $templateProcessor->setValue('id'.$key, $new->title_original);
    $templateProcessor->setValue('body'.$key, \Illuminate\Support\Str::limit($new->body_original, 600, $end='...'));
    $templateProcessor->setValue('language'.$key, $new->language);
    $templateProcessor->setValue('type'.$key, $new->type);
    $templateProcessor->setValue('country_news'.$key, $new->country_name);
    $templateProcessor->setValue('date'.$key, $new->datetime);
    $templateProcessor->setValue('sources'.$key, $new->source_name);
    $templateProcessor->setValue('count', $newscount);
    $templateProcessor->setImageValue('newLogo'.$key, $new->img);


    $fileName = "EXport2";

}
  }elseif($language !="0" ||$country !="0" || $types !="0" || $source !="0"){
  return   $news = News::query()->orderBy('created_at', 'desc')
    ->Orwhere('country_sources', 'LIKE', "%{$country}%")
    ->where('title_original','!=',null)
    ->where('body_original','!=',null)
    ->get();
    $news_sport= $news->where('type','رياضية');
    $news_econ= $news->where('type','أقتصادية');
    $news_polit= $news->where('type','السياسية');
    // return $newsarray=utf8_encode($news_sport);
   // return json_encode($news_sport, JSON_UNESCAPED_UNICODE);
   // return json_encode($news_econ, JSON_UNESCAPED_UNICODE);
    $templateProcessor = new TemplateProcessor('word-template/reportblock.docx');
  //  $templateProcessor->cloneBlock('block_name', $counts, true, true);
   $news->toArray();
    if($news->count()==0){
        $templateProcessor = new TemplateProcessor('word-template/report11.docx');
        $fileName = "EXport";
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);

    }
      $news_econ=  $news_econ->toArray();
      $newsarray=json_decode(json_encode($news_econ), true);
      $news_econ =   $newsarray;
      $news_sport=  $news_sport->toArray();
      $news_sportarray=json_decode(json_encode($news_sport), true);
      $news_sport =   $news_sportarray;
      $news_polit=  $news_polit->toArray();
      $news_politarray=json_decode(json_encode($news_polit), true);
      $news_polit =   $news_politarray;
      $fileName = "EXport";
      $templateProcessor->cloneBlock('block_polit', count($news_polit), true, false, $news_polit);
      $templateProcessor->cloneBlock('block_sport', count($news_sport), true, false, $news_sport);
      $templateProcessor->cloneBlock('block_name', count($news_econ), true, false, $news_econ);





  }
  $templateProcessor->saveAs($fileName . '.docx');

  return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    return view('reports.result', compact('news'));



}
//resource
public function resources(){

}




    //search all news
    public function search(Request $request){

        $languages=Languages::orderBy('created_at', 'desc')->get();
        $countries=Country::orderBy('created_at', 'desc')->get();
        $sources=source::orderBy('created_at', 'desc')->get();
        $country = $request->input('country');
       $source = $request->input('source');
        $types=$request->input('types');
      $language = $request->input('language');
      $news = DB::table('countries')
      ->join('sources', 'sources.source_country', '=', 'countries.country_code')
      ->join('news', 'news.source_id', '=', 'sources.id')
      ->select('news.*','country_name')

      ->orderBy('news.created_at', 'desc')
      ->get();
    if($country == "all" || $source == "all" || $language == "all"){

        $news;
        return view('search.all', compact('news','languages','countries','sources'));

    }elseif($language !="0" ||$country !="0" || $types !="0" || $source !="0")
{


    // Search in the title and body columns from the posts table
    $news = DB::table('countries')
    ->join('sources', 'sources.source_country', '=', 'countries.country_code')
    ->join('news', 'news.source_id', '=', 'sources.id')
    ->select('news.*','country_name','source_name')

        ->Orwhere('source_id', '=',$source)
        ->OrwhereIn('type', $types)
        ->Orwhere('country_sources', '=', $country)
        ->Orwhere('language', '=', $language)
    ->orderBy('news.created_at', 'desc')
    ->get();

    // Return the search view with the resluts compacted
    return view('search.all', compact('news','languages','countries','sources'));
}
}
public function keywords(Request $request){
    $keyword_array=null;
    $news=news::get();
    return view('search.keywords',compact('news','keyword_array'));

}
   public function SearchKeywords(Request $request)
{
    $languages=Languages::orderBy('created_at', 'desc')->get();
    $countries=Country::orderBy('created_at', 'desc')->get();
    $sources=source::orderBy('created_at', 'desc')->get();
    $from=$request->fromdate;
    $to=$request->todate;
    $fromformat= date('Y/m/d', strtotime($from));
    $toformat= date('Y/m/d', strtotime($to));
// $request->Keywords;
      $keyword_array=$request->Keywords;
      $keyword_string=implode(",",$keyword_array);
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

                . " )");
             }
        })->whereBetween('datetime', [$fromformat, $toformat])->get();


        return view('search.keywords',compact('news','languages','countries','sources','keyword_array'));
   // return view('search.all',compact('news','languages','countries','sources'));


}


public function view($id){
      $new = DB::table('countries')
    ->join('sources', 'sources.source_country', '=', 'countries.country_code')
    ->join('news', 'news.source_id', '=', 'sources.id')
    ->where('news.id' ,$id)

    ->select('news.*','country_name','source_name')

    ->orderBy('news.created_at', 'desc')
    ->first();
    $languages=Languages::orderBy('created_at', 'desc')->get();
    $countries=Country::orderBy('created_at', 'desc')->get();
    $sources=source::orderBy('created_at', 'desc')->get();



      return view('search.view',compact('countries','languages','sources','new'));

}

//all news not arabic
public function translated($lang){

     $news = DB::table('countries')
    ->join('sources', 'sources.source_country', '=', 'countries.country_code')
    ->join('news', 'news.source_id', '=', 'sources.id')
    ->where('news.language_news' ,$lang)
    ->where('news.draft' ,0)


    ->select('news.*','country_name','source_name')

    ->orderBy('news.created_at', 'desc')
    ->get();
    $languages=Languages::orderBy('created_at', 'desc')->get();


    $countries=Country::orderBy('created_at', 'desc')->get();
    $sources=source::orderBy('created_at', 'desc')->get();

// Return the search view with the resluts compacted
return view('search.all', compact('news','languages','countries','sources'));
}
public function resource($lang){

   $news= News::where("language",$lang)->distinct()->get(['sources']);


    return view('resource.index', compact('news'));
}


public function approve(){

     $news = DB::table('countries')
    ->join('sources', 'sources.source_country', '=', 'countries.country_code')
    ->join('news', 'news.source_id', '=', 'sources.id')
    ->select('news.*','country_name','source_name')
    ->orderBy('created_at', 'asc')
    ->get();


    $languages = DB::table('news')
    ->join('languages', 'languages.language_iso', '=', 'news.language')
    ->select('languages.language_name', 'languages.language_iso')
    ->distinct()
    ->get()->toArray();
    $coverages=Coverage::all();
     // $countries=Country::orderBy('create]d_at', 'desc')->get();
     $countries = DB::table('news')
     ->join('countries', 'countries.country_code', '=', 'news.country_news')
     ->select('countries.country_name', 'countries.country_code')
     ->distinct()
     ->get()->toArray();

    $sources=source::orderBy('created_at', 'desc')->get();

// Return the search view with the resluts compacted
return view('search.approve', compact('news','languages','countries','sources','coverages'));

}
public function edit($id)
{

     $new=News::find($id);
     $languages_v2=Languages::pluck('language_name','language_iso');
     $coverages=Coverage::pluck('title','id');


     $countries=Country::orderBy('created_at', 'desc')->get();
     $sources=source::orderBy('created_at', 'desc')->get();
    return view('admin.news.edit', compact('new','languages_v2','languages_v2','countries','sources','coverages'));

}

public function update(Request $request,$new)
{

      $new = news::where('id',$new)->first();
//حفظ كالمسود
    if ($request->has('save'))
{
    $new->update($request->all());
    $new->update([
        'draft' => 1,
        'language'=>$request->language,
    ]);
    return  redirect()->route('translated',$request->language)
    ->with('success','تم حفظ كمسودة بنجاح');

}
// اذا كان حفظ
else if ($request->has('publish'))
{
    $new->update($request->all());
    $new->update([
        'draft' => 0,
        'language'=>$request->language,

    ]);
  return  redirect()->route('translated',$request->language)
    ->with('success','تم حفظ بنجاح');

}
else if($request->has('translated'))
{
    //update all
    $new->update($request->all());
    //import library of translated
    $client = new \GuzzleHttp\Client();
    $translate = new TranslateClient([
        'key' => 'AIzaSyByMQQCZW4DtB_GxungoNzess8FtnpxRBQ'
    ]);
    //translate title
    $result_title="";
    if($request->title_en){
             //#2 prameters all data

        $payload=json_encode(
            [
                [

                    "description" => $request->body_en,
                    "title" => $request->title_en
               ]
            ]
    );
    //post method
    $client3 = new \GuzzleHttp\Client();
        $r = $client3->request('POST', 'http://127.0.0.1:5002/translate/news/password',
        ["json"=>$payload]
          );

          //get content
           $contents = $r->getBody()->getContents();
           $someArray = json_decode($contents, true);
           $someArray[0]['ar_title'];
           return $someArray[0]['ar_description'];
           $new->update([

            'title'=>$contents,
            'body'=>$contents,

        ]);




        }
        return  redirect()->route('news.edit',$new)
        ->with('success','تم الترجمة  بنجاح');






}




}}
