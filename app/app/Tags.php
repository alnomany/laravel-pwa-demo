<?php

namespace App;

use App\source;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{


    public $fillable = [
        'sources_id',
        'source_name',
        'source_language',
        'source_language_level',
        'news_classifications',
        'news_classifications_general',
        'requests_method',
        'cloudflare_protection',
        'news_list_url',
        'base_url',
        'news_list_path',
        'article_title_path',
        'article_description_path',
        'article_media_path',
        'article_date_attribute',
        'article_date_path',
        'article_date_regex',
        'article_category_path',
        'article_category_separator',

        'article_category_index1',
        'datetime_format',
        'success'
    ];
    //
    public function source(){
        return $this->belongsTo(source::class,'sources_id');
    }
    public function new(){
    return $this->hasOne(News::class,'tags_id');

    }
    public function files(){
        return $this->belongsToMany(File::class,'file_tag','file_id','tag_id');
      }


}
