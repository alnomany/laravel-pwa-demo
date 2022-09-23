<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwitterUsers extends Model
{
    //
        //
        public $table = 'user_twitters';

        public $fillable = [
            'name',
            'bio',
            'private',
            'user_url',
            'location',
            'join_date',
            'verified',
            'number_of_followers',
            'number_of_followings',
            'user_liked',
            'number_of_media',
            'number_of_tweets',
            'profile_picture',

        ];
}
