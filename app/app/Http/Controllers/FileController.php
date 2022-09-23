<?php

namespace App\Http\Controllers;

use App\File;
use App\News;
use App\Tags;
use App\User;
use App\News2;
use App\source;
use App\Country;

use App\Languages;
use Carbon\Carbon;
use App\Monitoring;
use Carbon\Traits\Date;
use Carbon\CarbonInterval;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Google\Cloud\Translate\V2\TranslateClient;


class FileController extends Controller
{
    public  $count_news_tot=0;
    public  $count_source=0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // select option
    public function select_option($id){
        $id=$id;
        $tags=Tags::all();
       $users=User::all();
       $files=File::all();
       $data = File::orderBy('id','DESC')->paginate(15);

        $languages=Languages::orderBy('created_at', 'desc')->get();
         $countries=Country::orderBy('created_at', 'desc')->get();
       return view('admin.files.select_option',compact('tags','languages','users','data','id','files'));
   }
   public function replicate($id){
    $tag = Tags::find($id);
    $tag = $tag->replicate();
    $tag->created_at = Carbon::now();
    $tag->save();
    return redirect()->route('tags.all')
    ->with('success','تم اضافة بنجاح');
   }
      //select option store
      public function select_option_store(Request $request){
         // id of tag && id of file

          $file = File::find($request->file);
         $tag_id=$request->tags;
         $file->tags()->attach($tag_id);
         return redirect()->route('resource.selectSource')
         ->with('success','تم أضافة المصدر  بنجاح');




      }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /// all files and create files
    public function create(){
           $tags=Tags::all();
        $users=User::all();
        $data = File::orderBy('id','DESC')->paginate(15);
        $languages=Languages::orderBy('created_at', 'desc')->get();
        $countries=Country::orderBy('created_at', 'desc')->get();
       return view('admin.files.create',compact('tags','languages','users','countries','data'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // all store files
    public function store(Request $request)
    {


        $request->tags;
        $file = new File($request->all());
        $file->save();
        $file->tags()->attach($request->tags);
        return redirect()->route('resource.selectSource')
                        ->with('success','تم اضافة بنجاح');

    }
    public function deletenews($id){

        News::truncate();

     return $this->bluckpull($id);



    }
    public function blucktranslate(){

        //#1 get all news not translated ID
      $news=  News::get();
     // $news1=News::where('id',51)->first()->body_original;
     // return $news2=\Illuminate\Support\Str::limit($news1, 4500);
      $items=[];
     foreach ($news as $key=>$new) {
         if(News::where('id',$new->id)->first()->language_news != 'ar' and News::where('id',$new->id)->first()->title_translated == null)
         $items[] = $new->id;
     }



     //#2 prameters all data
     foreach ($items as $key=>$item) {

         if(News::where('id',$item)->first()->language_news != 'ar')
             $payload=json_encode(
                    [
                        [
                            "title" => News::where('id',$item)->first()->title_original,
                            "description" => News::where('id',$item)->first()->body_original,
                        ]
                    ]
            );



            //-----------------------------------solve issue of null descripation
             $payload_array=json_decode($payload,true);
       if($payload_array[0]['description'] ==null)
            $payload_array[0]['description']="not found";
                  $payload=  json_encode($payload_array);
            ///-----------------------------------------------
     //     return $payload_array["title"];


     //post method
     $client = new \GuzzleHttp\Client();
      $r = $client->request('POST', 'http://127.0.0.1:5002/translate/news/password',
["json"=>$payload]
  );
  //get content
   $contents = $r->getBody()->getContents();
     $someArray = json_decode($contents, true);
    foreach($someArray as $key=>$some){
        $data=array(
        'title'=>$someArray[0]['ar_title'],
        'body'=>$someArray[0]['ar_description'],
    );
    }//first foreach

         $new=News::find($item);
        $new->update([
            'title_translated'=>$data['title'],
            'body_translated'=>$data['body'],

        ]);
    }
     return redirect()->route('files.create')
     ->with('success','تم الترجمة بنجاح');

}
    public function bluckpull($id){

      $tags= File::find($id)->tags;
      $count= $tags->count();
     $count_source=0;
     $count_news_tot=0;
     $data_array = [];
      $items=[];

      foreach ($tags as $key=>$tag) {


     $items[] = $tag->id;
      }
        $client = new \GuzzleHttp\Client();
        $translate = new TranslateClient([
            'key' => 'AIzaSyByMQQCZW4DtB_GxungoNzess8FtnpxRBQ'
        ]);
        foreach ($items as $key=>$item) {
            $payload=json_encode(
                [
                    [
                        "news_list_url" => DB::table('tags')->where('id',$item)->value('news_list_url'),
                        "base_url" => DB::table('tags')->where('id',$item)->value('base_url'),
                        "requests_method" => DB::table('tags')->where('id',$item)->value('requests_method'),
                        "cloudflare_protection" => false,
                        "category"=> DB::table('tags')->where('id',$item)->value('news_classifications'),
                        "news_list_path" => DB::table('tags')->where('id',$item)->value('news_list_path'),
                        "article_elements_paths" => [
                           "article_title_path" => DB::table('tags')->where('id',$item)->value('article_title_path'),
                           "article_description_path" => DB::table('tags')->where('id',$item)->value('article_description_path'),
                           "article_media_path" => DB::table('tags')->where('id',$item)->value('article_media_path'),
                           "article_date_attribute" =>DB::table('tags')->where('id',$item)->value('article_date_attribute'),
                           "article_date_path" => DB::table('tags')->where('id',$item)->value('article_date_path'),
                           "article_date_format"=>DB::table('tags')->where('id',$item)->value('datetime_format'),
                           "article_date_regex"=>DB::table('tags')->where('id',$item)->value('article_date_regex'),
                           "article_category_path" => DB::table('tags')->where('id',$item)->value('article_category_path'),
                           "article_category_separator" =>DB::table('tags')->where('id',$item)->value('article_category_separator'),
                           "article_category_index" => DB::table('tags')->where('id',$item)->value('article_category_index1'),

                      ]

                   ]
                ]
        );
// Start Array calculate
$start=[];
$start[$key] = microtime(true);
$time_end=[];
$time=[];
$time_hum=[];
$count_news=[];
$source_name=Tags::find($item)->source->source_name;
           $r = $client->request('POST', 'http://127.0.0.1:5000/scrap_news/password',
           ["json"=>$payload]
             );
             $contents = $r->getBody()->getContents();
             $someArray = json_decode($contents, true);
             $someArray=$someArray["success"];
             //End Array =============
             $count_news[$key] =count($someArray);
             $time_end[$key] = microtime(true);
             $time[$key] = $time_end[$key] -  $start[$key];
             CarbonInterval::setLocale('ar');
              $time_hum[$key]= CarbonInterval::seconds($time[$key])->cascade()->forHumans();
             $data_array[]=[
                'tag_id' => $item,
                'source_id' => Tags::find($item)->source->id,
                'source_name' => $source_name,
                'timing_start' => $start[$key],
                'timing_end' => $time_end[$key],
                'time'=>$time[$key],
                'time_hum'=>$time_hum[$key],
                'count_news'=>$count_news[$key],
                'created_at'=>Carbon::now(),
              ];
if($someArray){
    $count_source++;
    foreach($someArray as $key=>$some){
        $data=array(
        'datetime'=>$someArray[$key]['article_date'],
        'img'=>$someArray[$key]['article_medias'],
        'link'=>$someArray[$key]['article_url'],
        'type'=>$someArray[$key]['article_category'],
        'source_id'=>  tags::find($item)->sources_id,
        //للغة المصدر
        'language'=>source::find(tags::find($item)->sources_id)->source_main_language,
        'country_sources'=>source::find(tags::find($item)->sources_id)->source_country,
        //للغة الخبر
        'language_news'=>tags::find($item)->source_language,
        'country_news'=>source::find(tags::find($item)->sources_id)->source_country,
        'tags_id'=>$item,
        'coverage1'=>0,
        'coverage2'=>0,


        'source_id'=>tags::find($item)->sources_id,
        'created_at'=>Carbon::now());

        if (tags::find($item)->source_language == "ar"){
            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] = Str::limit($someArray[$key]['article_description'], 1000);
        }
        elseif(tags::find($item)->source_language == "pe"){

            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =Str::limit($someArray[$key]['article_description'],1000);
          //  $data['title'] = $result_title;
            //$data['body'] = $result_description;

        }  elseif(tags::find($item)->source_language == "en"){

            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =Str::limit($someArray[$key]['article_description'],1000);
        //  $data['title'] = $result_title;
          //$data['body'] = $result_description;

      }elseif(tags::find($item)->source_language == "he"){
        $data['title_original'] =$someArray[$key]['article_title'];
        $data['body_original'] =Str::limit($someArray[$key]['article_description'],1000);
       //     $data['title'] = $result_title;
         //   $data['body'] = $result_description;

        }
        elseif(tags::find($item)->source_language == "fr"){
            $data['title_original'] =$someArray[$key]['article_title'];

            $data['body_original'] =Str::limit(utf8_encode($someArray[$key]['article_description']),1000);
        //    $data['title'] = $result_title;
          //  $data['body'] = $result_description;
        }
        elseif(tags::find($item)->source_language == "tr"){
            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =Str::limit($someArray[$key]['article_description'],1000);
      //      $data['title'] = $result_title;
        //    $data['body'] = $result_description;

        }


        $count_news_tot++;

        $News = new News; //create model
        $News2 = new News2; //create model
        $News->setConnection('mysql'); //change db1


        $News::insert($data); //insert db1
        /*
        $News2->setConnection('mysql2'); // change data db2
        $News2::insert($data);              //insert db2
        */

        } //first foreach

} //end if for success


}//second foreach
Monitoring::insert($data_array);

$time_total = 0;
foreach($data_array as $key=>$value){


     $time_total += $value['time'];
}


$time_hum_total= CarbonInterval::seconds($time_total)->cascade()->forHumans();



         return redirect()->route('files.create')
         ->with('success','        تم عملية الاستيراد للأخبار بنجاح لعدد'.$count_source.' موقع وعدد '.$count_news_tot.' خبر '.$time_hum_total    );

        }

           /*

*/





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
