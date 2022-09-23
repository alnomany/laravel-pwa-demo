<?php

namespace App\Http\Controllers;

use App\News;
use App\Tags;
use App\Monitoring;
use App\TwitterUsers;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        CarbonInterval::setLocale('ar');

        $data = Monitoring::orderBy('id','DESC')->paginate(50);

          $avg_time = DB::table('monitorings')->avg('time');
          $time_all_time = DB::table('monitorings')->sum('time');
          $time_all= CarbonInterval::seconds($time_all_time)->cascade()->forHumans();
          $avg_time= CarbonInterval::seconds($avg_time)->cascade()->forHumans();
          $count_news = DB::table('monitorings')->sum('count_news');
        $count_news_avg = round(DB::table('monitorings')->avg('count_news'),1);


        $avg_time_per_one=CarbonInterval::seconds($time_all_time/$count_news)->cascade()->forHumans();
        $avg_time_per_one_number = $time_all_time/$count_news;

      //   $count_tags = DB::table('monitorings')->count('tag_id');
         $count_tags_uniq =   DB::table('monitorings')->distinct('source_name')->count('source_name');




        return view('admin.monitoring.index',compact('data','count_news_avg','avg_time_per_one','avg_time','count_news','avg_time_per_one_number','time_all','count_tags_uniq'));

    }
    public function issue()
    {
      //  $news=News::select('time')->get();
        $input = 'فبراير 12, 2022';
     $input = '06/10/2011 19:00:02';

        $date = strtotime($input);
        return date('D/M/Y h:i:s', $date);
        //
        CarbonInterval::setLocale('ar');
         $count_news_avg = round(DB::table('monitorings')->avg('count_news'),1);

        $avg_time_per_one_number = DB::table('monitorings')->where('tag_id',57)->avg('time')/$count_news_avg;
        $avg_time_per_one= CarbonInterval::seconds($avg_time_per_one_number)->cascade()->forHumans();
        $avg_time = DB::table('monitorings')->avg('time');
        return gettype($avg_time);

         $data = Monitoring::where('time', '>', $avg_time)->orderBy('id','DESC')->paginate(50);

          $avg_time = DB::table('monitorings')->avg('time');
          $time_all = DB::table('monitorings')->sum('time');
          $time_all= CarbonInterval::seconds($time_all)->cascade()->forHumans();


        $avg_time= CarbonInterval::seconds($avg_time)->cascade()->forHumans();

        $count_news = DB::table('monitorings')->sum('count_news');



        return view('admin.monitoring.index',compact('data','count_news_avg','avg_time_per_one','avg_time','count_news','avg_time_per_one_number','time_all'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function show(Monitoring $monitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitoring $monitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitoring $monitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitoring $monitoring)
    {
        //
    }
}
