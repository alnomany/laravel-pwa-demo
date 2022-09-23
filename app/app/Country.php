<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'countries';
    //
    public $fillable = [
        'country_name',
        'country_code',
    ];
    public function sources(){
        return $this->hasMany(source::class);

    }
    public function news(){
        return $this->hasMany(News::class);

    }

}
