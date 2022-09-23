<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{


    //
    public $fillable = [
        'source_name',
        'tag_id',
        'source_id',

        'timing_start',
        'timing_end',
        'time',
        'time_hum',
        'averge_time',
        'count_news',


    ];
}
