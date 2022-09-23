<?php

namespace App\Http\Controllers;

use App\News;
use App\Tags;
use RestClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JanDrda\LaravelGoogleCustomSearchEngine\LaravelGoogleCustomSearchEngine;



class CleanDateController extends Controller
{

    public function serpapi(){

       // return view('cleannews.all');
       $someArray=[];
              return view('serpapi.all',compact('someArray'));
    }
    public function dataforseo(Request $request){
        $client = new \GuzzleHttp\Client();


            $response = $client->post('http://api.dataforseo.com/v3/serp/google/news/live/advanced', [
                "language_code" => "en",
                "location_code" => 2840,
                "keyword" => mb_convert_encoding("albert einstein", "UTF-8"),

            'auth' => [
            'newssources4@gmail.com',
            '861aa8731a116ae5'
            ] ],

         );
         return       $contents = $response->getBody()->getContents();
       return   $someArray = json_decode($contents, true);




}    public function search(Request $request){
        $client = new \GuzzleHttp\Client();
        $var=$request['query'];
        $data = [
            "q" => $var,
            "tbm" => "isch",
            "Content-Type"=>"application/json",
            "apikey" =>"e581ab10-a101-11ec-b881-039ac3b8fcb1"

            ];
        $r = $client->request('GET', 'https://app.zenserp.com/api/v2/search?',
        ["json"=>$data]
          );
               $contents = $r->getBody()->getContents();
          $someArray = json_decode($contents, true);
      // $someArray['image_results'][0]['title'];
      return view('serpapi.all',compact('someArray'));




 //here second method
/*
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = [
        "q" =>  "fdg",
        "tbm" => "isch",
        ];
        curl_setopt($ch, CURLOPT_URL, "https://app.zenserp.com/api/v2/search?" . http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "apikey: e581ab10-a101-11ec-b881-039ac3b8fcb1",
        ));
        $response = curl_exec($ch);
        curl_close($ch);
     return   $json = json_decode($response);
        var_dump($json);
 */
    }

    //
    public function index(){
        //return $x=DB::table('news')->where('source_id', 27)->value('source_id');
        $news=News::all();
    // Return the search view with the resluts compacted
    return view('cleannews.all', compact('news'));

    }
    public function cleannews(Request $request){
        switch ($request->input('action')) {
            case 'clean':
               // $from=$request->fromdate;
              // $to=$request->todate;
               //$fromformat= date('Y/m/d', strtotime($from));
               //$toformat= date('Y/m/d', strtotime($to));
               $fromformat= date('Y/m/d',strtotime("-2 days"));
               $toformat=date('Y/m/d',strtotime(today()));

               //  $news= count(News::whereBetween('created_at', [$fromformat, $toformat])->orderBy('created_at', 'desc')->get());
                  $news= News::whereBetween('datetime', [$fromformat, $toformat])->update(['approve_news' => 1]);
                  return redirect()->back();
                 $news= News::whereBetween('datetime', [$fromformat, $toformat])->where('approve_news',1)->orderBy('datetime', 'desc')->get();


            break;

            case 'search':
            break;
        }



        return view('cleannews.all', compact('news'));


    }
    public function newsduplicate(){
        $news=News::all();

      return  $uniqueCollection = $news->unique('body_original');

        $newsDuplicates = $news->diff($uniqueCollection);
        foreach($newsDuplicates as $newsDuplicate){
            $newsDuplicate->delete();
        }
        return redirect()->route('admin.cleandate.index', compact('news'))
        ->with('success','تم الحذف بنجاح ');
    }
    public function tagsduplicate(){
         $tags=Tags::all();
        $news=News::all();

         $uniqueCollection = $tags->unique('news_list_url');

             $tagsDuplicates = $tags->diff($uniqueCollection);
        foreach($tagsDuplicates as $tagsDuplicate){
            $tagsDuplicate->delete();
        }
        return redirect()->route('admin.cleandate.index', compact('news'))
        ->with('success','تم الحذف بنجاح ');
    }

}
