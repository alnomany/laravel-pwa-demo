<?php

namespace App\Http\Controllers;

use App\Tags;
use App\User;
use App\source;
use App\Country;

use App\File;
use App\Languages;
use Illuminate\Http\Request;

use App\Exports\SourcesExport;
use App\Imports\SourcesIxport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;



class ResourcesAllController extends Controller
{

    public function getsource(Request $request){
        $cid=$request->post('cid');
        $cid= explode(",",$cid);

        $sources = DB::table('sources')
        ->whereIn('source_country',$cid)

       ->get()->toArray();
       $html='<option value="">Select State</option>';

       foreach($sources as $list){
           $html.='<option value="'.$list->id.'">'.$list->source_name.'</option>';
       }




       echo $html;

       }
    public function getcountry(Request $request){
     $cid=$request->post('cid');
     $cid= explode(",",$cid);

      $countries = DB::table('sources')
    ->join('countries', 'countries.country_code', '=', 'sources.source_country')
    ->whereIn('sources.source_main_language', $cid)
    ->select('countries.country_name', 'countries.country_code')
    ->distinct()
    ->get()->toArray();
    $html='<option value="">Select State</option>';

    foreach($countries as $list){
        $html.='<option value="'.$list->country_code.'">'.$list->country_name.'</option>';
    }




    echo $html;

    }
public function getlang(Request $request){
     $cid=$request->post('cid');
     $cid= explode(",",$cid);

      $languages = DB::table('sources')
    ->join('languages', 'languages.language_iso', '=', 'sources.source_main_language')
    ->whereIn('sources.source_country', $cid)
    ->select('languages.language_name', 'languages.language_iso')
    ->distinct()
    ->get()->toArray();
    $html='<option value="">Select State</option>';

    foreach($languages as $list){
        $html.='<option value="'.$list->language_iso.'">'.$list->language_name.'</option>';
    }




    echo $html;
}
    public function   getMoreSourcesSelect(Request $request){

        $language = $request->language;
        $country=$request->country;
        $source=$request->source;
        $type=$request->type;
        $files=File::all();

        $news_count = count(DB::table('news')->get());

        if($request->ajax()) {
            $sources = tags::orderBy('source_name', 'asc')->simplePaginate(500);
            if($source && $language && $country){
                $sources = tags::Wherein('id', $source)->Wherein('source_country', $country)->Wherein('source_main_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();

            }
            elseif($source && $language)
            {

                $sources = source::Wherein('id', $source)->Wherein('source_main_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();
            }
            elseif($country && $language)
            {

                $sources = source::Wherein('source_country', $country)->Wherein('source_main_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();
            }


            elseif($language !=='0' && $language) {

                $tags = tags::Wherein('source_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);


            }
            elseif($source !=='0' && $source )

            {
                $tags = tags::Wherein('sources_id', $source)->orderBy('id', 'asc')->simplePaginate(500);



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

                $news_count=$sources->count();
            }
            elseif($type !=='0' && $type )
            {

                $tags = tags::Wherein('news_classifications', $type)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();



            }

        }


        return view('admin.sources.select_data', compact('tags','files'))->render();


    }

    public function getMoreSources(Request $request){
         $language = $request->language;
        $country=$request->country;
         $source=$request->source;
        $news_count = count(DB::table('news')->get());

        if($request->ajax()) {
            $sources = source::orderBy('source_name', 'asc')->simplePaginate(500);
            if($source && $language && $country){
                $sources = source::Wherein('id', $source)->Wherein('source_country', $country)->Wherein('source_main_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();

            }
            elseif($source && $language)
            {

                $sources = source::Wherein('id', $source)->Wherein('source_main_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();
            }
            elseif($country && $language)
            {

                $sources = source::Wherein('source_country', $country)->Wherein('source_main_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();
            }


            elseif($language !=='0' && $language) {

                $sources = source::Wherein('source_main_language', $language)->orderBy('source_name', 'asc')->simplePaginate(500);


            }
            elseif($source !=='0' && $source )
            {

                $sources = source::Wherein('id', $source)->orderBy('source_name', 'asc')->simplePaginate(500);
                $news_count=$sources->count();



            }

            elseif($country !=='0' && $country )
            {

                $sources = source::Wherein('source_country', $country)->orderBy('source_name', 'asc')->simplePaginate(500);

                $news_count=$sources->count();



            }
        }


        return view('admin.sources.source_data', compact('sources','news_count'))->render();
    }
    public function getMoreNews(Request $request){

        return $request->keywords;

    }
      public function getDelete($id)
    {

        $sample = source::destroy($id);

        // Redirect to the group management page
        return redirect(route('resource.all'))->with('success','تم بحذف بنجاح');

    }
    public function export(){
        return Excel::download(new SourcesExport,'sources.xlsx');
    }
    public function importS(Request $request){
        $file = $request->file('file');
        Excel::import(new SourcesIxport, $file);
      //  $import = new SourcesIxport;
        //$import->import($file);

        return back()->withStatus('Import in queue, we will send notification after import finished.');
    }
    //
    public function create(){

        $languages=Languages::pluck('language_name','language_iso');
        $countries=Country::pluck('country_name','country_code');

        return view('admin.sources.create',compact('languages','countries'));

    }
    public function all(){
        $sources=source::all();
      //  $sources = DB::table('sources')->get();
      //$news_count = DB::table('news')->get();
      $news_count = count(DB::table('news')->get());


       //$languages=Languages::orderBy('created_at', 'desc')->get();
       $languages = DB::table('news')
       ->join('languages', 'languages.language_iso', '=', 'news.language_news')
       ->select('languages.language_name', 'languages.language_iso')
       ->distinct()
       ->get()->toArray();
        // $countries=Country::orderBy('created_at', 'desc')->get();
       /* $countries = DB::table('news')
        ->join('countries', 'countries.country_code', '=', 'news.countery_news')
        ->select('countries.country_name', 'countries.country_code')
        ->distinct()
        ->get()->toArray();

        */
        $countries = DB::table('countries')
        ->get();

        //$languages=Languages::pluck('language_name','language_iso');
        //$countries=Country::pluck('country_name','country_code');

        return view('admin.sources.all',compact('sources','languages','countries','news_count'));
    }
    public function store(Request $request){
        $input = $request->all();
       // $source = source::create($input);
        $source = new source($request->except('source_logo'));

        if( $file = $request->file('source_logo')){

            $extension = $file->extension()?: 'png';
            $folderName = '/uploads/sources/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            $source->source_logo =$safeName;

        }
        $source->save();

      //  Flash::success('Resource saved successfully.');
        return redirect(route('resource.create'));
    }
    public function edit($source){

        $source = source::find($source);
        $languages=Languages::pluck('language_name','language_iso');
        $countries=Country::pluck('country_name','country_code');
        return view('admin.sources.edit',compact('languages','source','countries'));
    }

public function selectSource(){

         $tags=Tags::all();
        $files=File::all();
        $sources=source::all();
        $languages = DB::table('tags')
        ->join('languages', 'languages.language_iso', '=', 'tags.source_language')
        ->select('languages.language_name', 'languages.language_iso')
        ->distinct()
        ->get()->toArray();
          $countries = DB::table('news')
          ->join('countries', 'countries.country_code', '=', 'news.country_news')
          ->select('countries.country_name', 'countries.country_code')
          ->distinct()
          ->get()->toArray();
          $countries = DB::table('countries')
          ->get();
          $types = DB::table('tags')->select('news_classifications')->distinct()->get();

        return view('admin.sources.select',compact('tags','countries','languages','sources','types','files'));

}




    public function update($source,Request $request){
         $source = source::where('id',$source)->first();
         if($file = $request->file('source_logo')){
            $extension = $file->extension()?: 'png';
            $folderName = '/uploads/sources/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            //delete old pic if exists
            /*
            if (File::exists(public_path() . $folderName . $source->source_logo)) {
                File::delete(public_path() . $folderName . $source->source_logo);
            }
            */
             $source->source_logo =$safeName;
        }
        if ($source->update($request->except( 'source_logo'))) {
            return redirect('resource/all')->with('success', trans('done'));
        } else {
            return Redirect::route('resource.all')->withInput()->with('error', trans('not'));
        }
         $source->save();
    }
}
