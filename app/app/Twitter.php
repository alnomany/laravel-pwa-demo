<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    //
    public $fillable = [
        'url',
        'user_id',
        'time',
        'text',
        'text_en',
        'text_fr',
        'text_he',
        'text_pe',
        'text_tr',
        'language',




        'photos',

        'hashtags',
        'number_of_likes',
        'number_of_replies',
        'number_of_retweets',
        'tweet_urls',
    ];
}
