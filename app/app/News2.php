<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News2 extends Model
{
    //


    public $table = 'news';
    protected $connection = 'mysql2';





    public $fillable = [

        'tags_id',
        'source_id',
        'title_original',
        'title_translated',

        'body_original',
        'body_translated',
        'draft',
        'link',
        'datetime',
        'language',
        'language_news',
        'country_news',
        'type',
        'sources',
        'country_sources',
        'coverage1',
        'coverage2'




    ];

    /**
     * The attributes that should mkjbe casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title_original' => 'string',
        'body_original' => 'string',
        'link' => 'string',
        'datetime' => 'string',
        'language' => 'string',
        'countery_news' => 'string',
        'type' => 'string',
        'sources' => 'string',
        'country_sources' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title'=>'required|min:2|max:2|unique:posts'

    ];
    public function tag(){
        return $this->belongsTo(Tags::class,'tags_id');

    }
    public function source(){
        return $this->belongsTo(source::class,'source_id');

    }

    public function country(){
        return $this->belongsTo(Country::class,'country_code');
    }
}


