<?php

namespace App\Http\Controllers;

use App\File;
use App\News;
use App\Tags;
use App\source;
use App\Country;
use App\Languages;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Exports\TagsExport;
use App\Imports\TagsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Google\Cloud\Translate\V3\TranslateClient;

class TagsController extends Controller
{
    public function getMoreSelect(Request $request){
        $language = $request->language;
        $country=$request->country;
        $source=$request->source;

        $type=$request->type;
        $files=File::all();



        if($request->ajax()) {
            $tags = Tags::orderBy('source_name', 'asc')->simplePaginate(400);


            if($language !=='0' && $language) {

                $tags = Tags::whereIn('source_language', $language)->orderBy('source_name', 'asc')->simplePaginate(400);


            }

            if($country !=='0' && $country) {

              //  $tags = Tags::whereIn('source_language', $language)->orderBy('source_name', 'asc')->simplePaginate(400);
                $tags = DB::table('tags')
                ->join('sources', 'sources.id', '=', 'tags.sources_id')
                ->join('countries', 'countries.country_code', '=', 'sources.source_country')
                ->whereIn('source_country', $country)
                ->select('tags.*')
                ->distinct()
                ->get()->toArray();
            }
            elseif($type !=='0' && $type )
            {

                $tags = Tags::whereIn('news_classifications', $type)->orderBy('source_name', 'asc')->simplePaginate(400);



            }
            elseif($source !=='0' && $source )
            {

                $tags = Tags::whereIn('sources_id', $source)->orderBy('source_name', 'asc')->simplePaginate(400);



            }
        }


        return view('admin.sources.select_data', compact('tags','files'))->render();
    }



    public function getMoreTags(Request $request){
    $language = $request->language;
    $country=$request->country;
    $type=$request->type;
    $source=$request->source;


    if($request->ajax()) {
        $tags = Tags::orderBy('source_name', 'asc')->simplePaginate(400);


        if($language !=='0' && $language) {

            $tags = Tags::Wherein('source_language', $language)->orderBy('source_name', 'asc')->simplePaginate(400);


        }
        elseif($type !=='0' && $type )
        {

            $tags = Tags::Wherein('news_classifications', $type)->orderBy('source_name', 'asc')->simplePaginate(400);



        }
        elseif($source !=='0' && $source )

        {
            $tags = tags::Wherein('sources_id', $source)->orderBy('id', 'asc')->simplePaginate(20);



        }

        elseif($country !=='0' && $country )
        {
          $tags = DB::table('tags')
          ->join('sources', 'sources.id', '=', 'tags.sources_id')
          ->join('countries', 'countries.country_code', '=', 'sources.source_country')
          ->whereIn('sources.source_country', $country)
          ->select('tags.*','sources.source_logo','sources.source_name')
          ->distinct()
          ->get()->toArray();
        }
    }


    return view('admin.tags.tags_data', compact('tags'))->render();
}

    // import and export excel
    public function export(){

        return Excel::download(new TagsExport,'tags4.xlsx');
    }
    public function importS(Request $request){
         $file = $request->file('file');
        Excel::import(new TagsImport, $file);
      //  $import = new SourcesIxport;
        //$import->import($file);

        return back()->withStatus('Import in queue, we will send notification after import finished.');
    }
    //
    public function create(){
        $sources=source::pluck('source_name','id');
        $types =tags::pluck('news_classifications','news_classifications');
   //     $types = tags::groupBy('news_classifications')->pluck('news_classifications','news_classifications');

        $languages=Languages::pluck('language_name','language_iso');
       // $types = DB::table('tags')->select('news_classifications')->distinct()->get();
       $success = array(
        '1' => '1',
        '0' => '0',
    );
        $someArray =[];
        session()->put('message','create it');


        return view('admin.tags.create',compact('sources','someArray','languages','types','success'));

    }
    public function confirem(){
        return view('admin.api_tags.confirem');

    }

    public function edit($tag){
        $tag=Tags::find($tag);
           $types = tags::groupBy('news_classifications')->pluck('news_classifications','news_classifications');

        $sources=source::pluck('source_name','id');

        $languages=Languages::pluck('language_name','language_iso');
      //  $types = DB::table('tags')->select('news_classifications')->distinct()->get();

        $someArray =[];
        $success = array(
            '1' => '1',
            '0' => '0',
        );


        return view('admin.tags.edit',compact('tag','sources','someArray','languages','types','success'));

    }
    public function store(Request $request){

        switch ($request->input('action')) {
            case 'save':
                // Save model
                $input = $request->all();
                $tag = Tags::create($input);
                $tag->save();
               // Flash::success('Resource saved successfully.');
               session()->put('message','upload it');
                return redirect(route('tags.all'));
                break;


        }

    }
    public function update(Request $request,$tag){

       $tr = new GoogleTranslate('ar');
       $tr1 = new GoogleTranslate('ar');

        switch ($request->input('action')) {
            case 'save':
                // Save model
                $tag = Tags::where('id',$tag)->first();
                if ($tag->update($request->all())) {
                    return redirect('tags/all')->with('success', trans('done'));
                } else {
                    return Redirect::route('tags.all')->withInput()->with('error', trans('not'));
                }
                 $tag->save();
                break;

            case 'preview':
                // update model
                $languages=Languages::pluck('language_name','language_iso');
                $types = tags::groupBy('news_classifications')->pluck('news_classifications','news_classifications');

                $sources=source::pluck('source_name','id');
                $success = array(
                    '1' => '1',
                    '0' => '0',
                );
                $client = new \GuzzleHttp\Client();
                $payload=json_encode(
                       [
                           [
                             "news_list_url" => $request->news_list_url,
                             "base_url" => $request->base_url,
                             "requests_method" => $request->requests_method,
                             "cloudflare_protection" => false,
                             "category"=>$request->news_classifications,
                             "news_list_path" => $request->news_list_path,
                             "article_elements_paths" => [
                                "article_title_path" => $request->article_title_path,
                                "article_description_path" => $request->article_description_path,
                                "article_media_path" => $request->article_media_path,
                                "article_date_attribute" =>$request->article_date_attribute,
                                "article_date_path" => $request->article_date_path,
                                "article_date_format"=>$request->datetime_format,
                                "article_date_regex"=>$request->article_date_regex,
                                "article_category_path" => $request->article_category_path,
                                "article_category_separator" => $request->article_category_separator,
                                "article_category_index" => $request->article_category_index1,
                             ]
                           ]
                          ]
               );


               $r = $client->request('POST', 'http://127.0.0.1:5000/scrap_news/password',
               ["json"=>$payload]
                 );
                 $contents = $r->getBody()->getContents();
                  $someArray = json_decode($contents, true);
                   $someArray=$someArray["success"];
                  $tag=Tags::find($tag);
                  return view('admin.tags.edit',compact('someArray','tag','sources','languages','types','success'));



                break;

                case 'pull':
                    // update
                    $client = new \GuzzleHttp\Client();

                    $payload=json_encode(
                        [
                            [
                                "news_list_url" => $request->news_list_url,
                                "base_url" => $request->base_url,
                                "requests_method" => $request->requests_method,
                                "cloudflare_protection" => false,
                                "category"=>$request->news_classifications,
                                "news_list_path" => $request->news_list_path,
                                "article_elements_paths" => [
                                   "article_title_path" => $request->article_title_path,
                                   "article_description_path" => $request->article_description_path,
                                   "article_media_path" => $request->article_media_path,
                                   "article_date_attribute" =>$request->article_date_attribute,
                                   "article_date_path" => $request->article_date_path,
                                   "article_date_format"=>$request->datetime_format,
                                   "article_date_regex"=>$request->article_date_regex,
                                   "article_category_path" => $request->article_category_path,
                                   "article_category_separator" => $request->article_category_separator,
                                   "article_category_index" => $request->article_category_index1,
                              ]
                            ]
                           ]
                );

                   $r = $client->request('POST', 'http://127.0.0.1:5000/scrap_news/password',
                   ["json"=>$payload]
                     );
                     $contents = $r->getBody()->getContents();
                      $someArray = json_decode($contents, true);
                       $someArray=$someArray["success"];
                       $success = array(
                        '1' => '1',
                        '0' => '0',
                    );
    foreach($someArray as $key=>$some){
        $data=array(


            'datetime'=>$someArray[$key]['article_date'],
            'img'=>$someArray[$key]['article_medias'],
            'link'=>$someArray[$key]['article_url'],
            'type'=>$someArray[$key]['article_category'],

            'language'=>source::find($request->sources_id)->source_main_language,
            'country_sources'=>source::find($request->sources_id)->source_country,
            'language_news'=>$request->source_language,
            'country_news'=>source::find($request->sources_id)->source_country,


            'coverage1'=>0,
            'coverage2'=>0,
            'tags_id'=>$tag,
            'source_id'=>$request->sources_id,
            'created_at'=>Carbon::now());

        if ($request->source_language == "ar"){
            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =$someArray[$key]['article_description'];
        }
        elseif($request->source_language == "pe"){

            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =$someArray[$key]['article_description'];
          //  $data['title'] = $result_title;
            //$data['body'] = $result_description;

        }  elseif($request->source_language == "en"){

            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =$someArray[$key]['article_description'];
        //  $data['title'] = $result_title;
          //$data['body'] = $result_description;

      }elseif($request->source_language == "he"){
        $data['title_original'] =$someArray[$key]['article_title'];
        $data['body_original'] =$someArray[$key]['article_description'];
       //     $data['title'] = $result_title;
         //   $data['body'] = $result_description;

        }
        elseif($request->source_language == "fr"){
            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =$someArray[$key]['article_description'];
        //    $data['title'] = $result_title;
          //  $data['body'] = $result_description;
        }
        elseif($request->source_language == "tr"){
            $data['title_original'] =$someArray[$key]['article_title'];
            $data['body_original'] =$someArray[$key]['article_description'];
      //      $data['title'] = $result_title;
        //    $data['body'] = $result_description;

        }
        //get $date varabile



//insert

        $News = new News; //create model
        $News->setConnection('mysql'); //change db1
        $News::insert($data); //insert db1
        }
    return "done";
           break;
        }

    }
    /*
    public function getModalDelete($id = null)
    {
        $error = '';
        $model = '';Cou
        $confirm_route =  route('tags.delete',['id'=>$id]);
        return View('admin.layouts/
        ', compact('error','model', 'confirm_route'));

    }*/

     public function getDelete($id = null)
     {
         $sample = Tags::destroy($id);

         // Redirect to the group management page
         return redirect(route('tags.all'))->with('success', Lang::get('message.success.delete'));

     }


    public function all(){
        $tags=Tags::all();
        $sources=source::all();
         $languages = DB::table('tags')
         ->join('languages', 'languages.language_iso', '=', 'tags.source_language')
         ->select('languages.language_name', 'languages.language_iso')
         ->distinct()
         ->get()->toArray();
         /*
          $countries = DB::table('news')
          ->join('countries', 'countries.country_code', '=', 'news.countery_news')
          ->select('countries.country_name', 'countries.country_code')
          ->distinct()
          ->get()->toArray();
          */
          $countries = DB::table('countries')
          ->get();
          $types = DB::table('tags')->select('news_classifications')->distinct()->get();

        return view('admin.tags.all',compact('tags','countries','languages','sources','types'));
    }
}
