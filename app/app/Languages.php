<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    //

    public $table = 'languages';



    public $fillable = [
        'language_name',
        'language_iso',
    ];

    /**
     * The attributes that should mkjbe casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'language_name' => 'string',
        'language_iso' => 'string',
    ];

}
