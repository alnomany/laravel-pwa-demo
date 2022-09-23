<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    public $table = 'files';



    public $fillable = [
        'name',
        'user_id',
    ];
    public function user(){

    }
    public function tags(){
      return $this->belongsToMany(Tags::class,'file_tag','file_id','tag_id');
    }

}
