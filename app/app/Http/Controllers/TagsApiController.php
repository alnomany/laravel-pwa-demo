<?php

namespace App\Http\Controllers;

use App\Tags;
use App\source;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class TagsApiController extends Controller
{
    //
  public function   getData(){
    return    $tags=Tags::all();

    }
    public function   searchData($id){
        return    $tags=Tags::find($id);

        }
        public function post($id){
            $tag=Tags::find($id);
            $sources=source::pluck('source_name','id');

            return view('admin.api_tags.post',compact('tag','sources'));
        }
        public function preview(Request $request){
            $request->news_list_url;
           $tag=new Tags;
           $client = new \GuzzleHttp\Client();
           $payload=json_encode(
                  [
                      [
                        "news_list_url" => $request->news_list_url,
                        "base_url" => $request->base_url,
                        "requests_method" => "requests",
                        "cloudflare_protection" => false,
                        "news_list_path" => $request->news_list_path,
                        "article_elements_paths" => [
                           "article_title_path" => $request->article_title_path,
                           "article_description_path" => $request->article_description_path,
                           "article_media_path" => $request->article_media_path,
                           "article_date_path" => $request->article_date_path,
                           "article_category_path" => $request->article_category_path,
                           "article_category_separator" => "",
                           "article_category_index" => -1
                        ]
                      ]
                     ]
          );


          $r = $client->request('POST', 'http://127.0.0.1:5000/scrap_news/password',
   ["json"=>$payload]
            );
            //return $r->getBody();
             $status= $r->getStatusCode();
              $contents = $r->getBody()->getContents();
            // return gettype($contents);
             $someArray = json_decode($contents, true);
            // return   var_dump($someArray); // Access Array data
            // return print_r($someArray);
            // return var_dump($someArray["success"][0]); // Johny Carson
             $someArray=$someArray["success"];
             return redirect()->back()->with(compact('someArray'));

        }
    public function add(Request $request){
         $request->news_list_url;
        $tag=new Tags;
        $client = new \GuzzleHttp\Client();

        $payload=json_encode(
               [
                   [
                     "news_list_url" => $request->news_list_url,
                     "base_url" => $request->base_url,
                     "requests_method" => $request->requests_method,
                     "cloudflare_protection" => false,
                     "news_list_path" => $request->news_list_path,
                     "article_elements_paths" => [
                        "article_title_path" => $request->article_title_path,
                        "article_description_path" => $request->article_description_path,
                        "article_media_path" => $request->article_media_path,
                        "article_date_path" => $request->article_date_path,
                        "article_category_path" => $request->article_category_path,
                        "article_category_separator" => "",
                        "article_category_index" => -1
                     ]
                   ]
                  ]
       );


       $r = $client->request('POST', 'http://127.0.0.1:5000/scrap_news/password',
["json"=>$payload]
         );
         //return $r->getBody();
          $status= $r->getStatusCode();
           $contents = $r->getBody()->getContents();
         // return gettype($contents);
          $someArray = json_decode($contents, true);
         // return   var_dump($someArray); // Access Array data
         // return print_r($someArray);
         // return var_dump($someArray["success"][0]); // Johny Carson
          $someArray=$someArray["success"];

          return redirect()->back()->with(compact('someArray'));



          if($status="success"){
              Alert::alert('سحب البيانات', 'بنجاح', 'success');
              $tags=Tags::all();
            return view('admin.tags.all',compact('tags'));

          }elseif($status="failure"){
            Alert::alert('سحب البيانات', 'غير مكتمل', 'alert');
            $tags=Tags::all();
          return view('admin.tags.all',compact('tags'));
          }









        $tag->news_list_url=$request->news_list_url;
        $tag->base_url=$request->base_url;
        $data=$request->only('article_title_path','article_description_path','article_media_path','article_date_path','article_category_path');
        $tag['article_elements_paths']=json_encode($data);

        $tag->requests_method="requests";
        $tag->cloudflare_protection="false";

        $tag->news_list_path=$request->news_list_path;
        //article_elements_paths
        /*
        $tag->article_title_path=$request->article_title_path;
        $tag->article_description_path=$request->article_description_path;
        $tag->article_media_path=$request->article_media_path;
        $tag->article_date_path=$request->article_date_path;
        $tag->article_category_path=$request->article_category_path;
        */

        $tag->article_category_separator="\n";
        $tag->article_category_index="-1";

        $tag->sources_id=$request->sources_id;
        $tag->source_language=$request->source_language;
        $tag->source_language_level=$request->source_language_level;
        $tag->news_classifications=$request->news_classifications;

        $tag->save();
       $tag= response()->json($tag, 500);
        //$tag = $tag->toJson();

// "200"
//echo $r->getHeader('content-type')[0];
// 'application/json; charset=utf8'
//echo $r->getBody();



    }
}
