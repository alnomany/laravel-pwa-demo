<?php

namespace App\Http\Controllers;

use App\Tags;
use App\source;
use App\Country;
use App\Languages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function Report(){

          $array = ['all' => 'all'];
        $languages=Languages::pluck('language_name','language_iso');
       $languages=$languages->merge(['all' => 'all']);
        $countries=Country::pluck('country_name','country_code');
        $countries=$countries->merge(['all' => 'all']);
        $tags_success=DB::table('tags')->select("sources_id")
        ->join('sources','sources.id','=','tags.sources_id')
        ->where('success',1)
        ->count();
        $sources= source::select("*")->get()->count();
        $tags=Tags::select("sources_id")->get()->count();
        $tags_all=Tags::count();
        $lastmonths=['lastmonths'=>'آخر شهر'];
           $sourcearray = source::select([
            // This aggregates the data and makes available a 'count' attribute
            DB::raw('count(id) as `count`'),
            // This throws away the timestamp portion of the date
            DB::raw('DATE(created_at) as day'),
          // Group these records according to that day
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->where('created_at', '>=', Carbon::now()->subMonths(1))
          ->get();
          ///////////////////////////////

          $tagsarray = Tags::select([
            // This aggregates the data and makes available a 'count' attribute
            DB::raw('count(id) as `count`'),
            DB::raw('sum(success) as `countsuccess`'),
            // This throws away the timestamp portion of the date
            DB::raw('DATE(created_at) as day'),
          // Group these records according to that day
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->where('created_at', '>=', Carbon::now()->subMonths(1))
          ->get();

        return view('reports.automatic',compact('countries','languages','sources','tags','tags_success','tags_all','lastmonths','tagsarray','sourcearray'));
    }
    public function reportsource(Request $request){
        $lastmonths=['lastmonths'=>'آخر شهر'];
        $tagsarray=Tags::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get(['id','created_at']);
        $sourcearray = source::select([
            // This aggregates the data and makes available a 'count' attribute
            DB::raw('count(id) as `count`'),
            // This throws away the timestamp portion of the date
            DB::raw('DATE(created_at) as day'),
          // Group these records according to that day
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->where('created_at', '>=', Carbon::now()->subMonths(1))
          ->get();        $tagsarray = Tags::select([
            // This aggregates the data and makes available a 'count' attribute
            DB::raw('count(id) as `count`'),
            DB::raw('sum(success) as `countsuccess`'),
            // This throws away the timestamp portion of the date
            DB::raw('DATE(created_at) as day'),
          // Group these records according to that day
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->where('created_at', '>=', Carbon::now()->subMonths(1))
          ->get();
         $request->lastmonths;
        $from=$request->from;
        $to=$request->to;
      //   $request->languages;
        $array = ['all' => 'all'];
        $languages=Languages::pluck('language_name','language_iso');
       $languages=$languages->merge(['all' => 'all']);

        $countries=Country::pluck('country_name','country_code');
        $countries=$countries->merge(['all' => 'all']);
        if($request->countries == 'all' && $request->languages == 'all'){
            $sources= source::select("*")->whereBetween('created_at',[$from,$to])->count();
            $tags=Tags::select("sources_id")->whereBetween('created_at',[$from,$to])->count();
            $tags_all=Tags::count();
            $tags_success=DB::table('tags')->select("sources_id")
            ->join('sources','sources.id','=','tags.sources_id')
            ->whereBetween('tags.created_at',[$from,$to])->where('success',1)
            ->count();


          }

        if(($request->countries != 'all') && ($request->languages != 'all')){
            $count= $request->countries;
            $lang= $request->languages;
            $sources= source::select("*")->where('source_main_language',$lang)->where('source_country',$count)->whereBetween('created_at',[$from,$to])->count();
            $tags=DB::table('tags')->select("sources_id")
            ->join('sources','sources.id','=','tags.sources_id')
            ->whereBetween('tags.created_at',[$from,$to])->where('sources.source_country',$count)->where('tags.source_language',$lang)
            ->count();
            $tags_all=Tags::all();
            $tags_all=Tags::count();
            $tags_success=DB::table('tags')->select("sources_id")
            ->join('sources','sources.id','=','tags.sources_id')
            ->whereBetween('tags.created_at',[$from,$to])->where('sources.source_country',$count)->where('tags.source_language',$lang)->where('success',1)
            ->count();


          }
        elseif($request->languages != 'all'){
          $lang= $request->languages;
            $sources= source::select("*")->where('source_main_language',$lang)->whereBetween('created_at',[$from,$to])->count();
            $tags=Tags::select("sources_id")->where('source_language',$lang)->whereBetween('created_at',[$from,$to])->count();
            $tags_all=Tags::count();
            $tags_success=DB::table('tags')->select("sources_id")
            ->join('sources','sources.id','=','tags.sources_id')
            ->whereBetween('tags.created_at',[$from,$to])->where('source_main_language',$lang)->where('success',1)
            ->count();

        }
        elseif($request->countries != 'all'){
              $count= $request->countries;
              $sources= source::select("*")->where('source_country',$count)->whereBetween('created_at',[$from,$to])->count();
               $tags=DB::table('tags')->select("sources_id")
              ->join('sources','sources.id','=','tags.sources_id')
              ->whereBetween('tags.created_at',[$from,$to])->where('sources.source_country',$count)
              ->count();
              $tags_success=DB::table('tags')->select("sources_id")
              ->join('sources','sources.id','=','tags.sources_id')
              ->whereBetween('tags.created_at',[$from,$to])->where('sources.source_country',$count)->where('success',1)
              ->count();
              $tags_all=Tags::count();

          }

        //uniqu
       // $tags=  Tags::select("sources_id")->whereBetween('created_at',[$from,$to])->groupby('sources_id')->distinct()->count();
      return view('reports.automatic',compact('countries','languages','tags','tags_all','tags_success','lastmonths','sources','tagsarray','sourcearray'));

    }
}
