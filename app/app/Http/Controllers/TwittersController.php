<?php

namespace App\Http\Controllers;

use App\Twitter;
use App\Languages;
use Carbon\Carbon;
use App\TwitterUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TwittersController extends Controller
{
    //
    public function index(){


        $twitterusers=TwitterUsers::pluck('name','id');
        $languages=Languages::pluck('language_name','language_iso');

        $data = Twitter::orderBy('id','asc')->paginate(15);
        return view('admin.twitter.index',compact('data','twitterusers','languages'));
    }
    public function show(Request $request,$id){
       //  $user = Twitter::find($id);
        // return view('admin.twitter.show',compact('user'));
    }
    public function store(Request $request){



        $client = new \GuzzleHttp\Client();
        $url='http://127.0.0.1:5001/scrap_twitter/password/tweets/'.$request->name;
           $res = $client->request('GET',$url);
           $contents = $res->getBody()->getContents();
           $contents = json_decode($contents, true);

 foreach($contents as $key=>$content){
   $data=array(
    'url'=>  $contents[$key]['url'],
    'user_id'=>$request->user_id,
    'time'=>   $contents[$key]['time'],
    'tweet_urls'=>    serialize($contents[$key]['tweet_urls']),
    'photos'=>    serialize($contents[$key]['photos']),
    'hashtags'=>    serialize($contents[$key]['hashtags']),

    'number_of_likes'=>     $contents[$key]['number_of_likes'],
    'number_of_replies'=>    $contents[$key]['number_of_replies'],
    'number_of_retweets'=>   $contents[$key]['number_of_retweets'],
    'created_at'=>Carbon::now(),

        );

        if ($request->language == "ar"){
            $data['text'] =$contents[$key]['text'];
        }
        elseif($request->language == "pe"){

            $data['text_pe'] =$contents[$key]['text'];

        }  elseif($request->language == "en"){

          $data['text_en'] =$contents[$key]['text'];
      }elseif($request->language == "he"){
            $data['text_he'] =$contents[$key]['text'];
        }
        elseif($request->language == "fr"){
            $data['text_fr'] =$contents[$key]['text'];
        }
        elseif($request->language == "tr"){
            $data['text_tr'] =$contents[$key]['text'];
        }
        Twitter::insert($data);
    }
        return redirect()->route('admin.twitter.index')
        ->with('success','تم أضافة بنجاح');





 }
public function blucktranslatetwitter(Request $request){
            //#1 get all news not translated ID
         $twitters=  Twitter::get();
            $items=[];
           foreach ($twitters as $key=>$twitter) {
               if(Twitter::where('id',$twitter->id)->first()->text == null)
               $items[] = $twitter->id;
           }

     //#2 prameters all data
     foreach ($items as $key=>$item) {

        if(Twitter::where('id',$item)->first()->text_en)
           $payload=json_encode(
                   [

                            Twitter::where('id',$item)->first()->text_en,

                   ]
           );
           elseif(Twitter::where('id',$item)->first()->text_fr)

           $payload=json_encode(
                   [

                            Twitter::where('id',$item)->first()->text_fr,

                   ]
           );
           elseif(Twitter::where('id',$item)->first()->text_tr)

           $payload=json_encode(
               [

                      Twitter::where('id',$item)->first()->text_tr,

               ]
           );
           elseif(Twitter::where('id',$item)->first()->text_he)

           $payload=json_encode(
               [

                       Twitter::where('id',$item)->first()->text_he,

               ]
           );
           elseif(Twitter::where('id',$item)->first()->text_pe)
           $payload=json_encode(
               [

                       Twitter::where('id',$item)->first()->text_pe,



               ]
           );
               //-----------------------------------solve issue of null descripation
               /*
       $payload_array=json_decode($payload,true);
       if($payload_array[0]['tweet'] ==null)
            $payload_array[0]['tweet']="not found";
            $payload=  json_encode($payload_array);
            */
                 //post method
            $client = new \GuzzleHttp\Client();
            $r = $client->request('POST', 'http://127.0.0.1:5002/translate/tweets/password',
            ["json"=>$payload]
            );
            //get content
             $contents = $r->getBody()->getContents();
            $someArray = json_decode($contents, true);
                foreach($someArray as $key=>$some){
                    $data=array(
                    'text'=>$someArray[0]['ar_tweet'],

                );
            }//first foreach;

            $twitter=Twitter::find($item);
            $twitter->update([
                'text'=>$data['text'],


            ]);
}
return redirect()->route('admin.twitter.index')
->with('success','تم الترجمة بنجاح');
}

public function edit(Request $request ,$id){
     $twitter=Twitter::find($id);
    $languages_v2=Languages::pluck('language_name','language_iso');

    return view('admin.twitter.edit', compact('twitter','languages_v2'));


}
public function translated($lang){
return $lang;
}
}
