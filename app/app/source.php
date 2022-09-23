<?php

namespace App;

use App\Tags;
use Illuminate\Database\Eloquent\Model;

class source extends Model
{
    public function tags(){
        return $this->hasMany(Tags::class);

    }
    public function news(){
        return $this->hasMany(News::class);

    }
    public function country(){
        return $this->belongsTo(Country::class,'country_code');
    }
    //
    public $table = 'sources';
    public $fillable = [
        'source_name',
        'source_link',
        'source_country',
        'source_main_language',
        'source_second_language',
        'source_thired_language',
        'source_fourth_language',
        'source_five_language',
        'source_type',
        'source_logo',


    ];

       /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

        'source_name' => 'string',
        'source_link' => 'string',
        'source_country' => 'string',
        'source_main_language' => 'string',
        'source_second_language' => 'string',
        'source_thired_language' => 'string',
        'source_fourth_language' => 'string',
        'source_five_language' => 'string',
        'source_type' => 'string',
        'source_logo' => 'string',
        'created_at' => 'datetime:Y-m-d',


    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
         /*
        'title' => 'required|max:1000',

        'centers_about' => 'required|max:1000',
        'centers_activity' => 'required|max:1000',
        'centers_goals' => 'required|max:1000',
        'centers_goals' => 'required|email',

        'phone' => 'required|regex:/(01)[0-9]{9}/',

        'phone1' => 'required|phone',
        */


    ];
}
