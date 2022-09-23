<?php

namespace App\Imports;

use App\Tags;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TagsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tags([
            //
            'sources_id'=>2,
            'source_language'=>"en",
            'source_language_level'=>1,
            'news_classifications'=>$row['news_classifications'],
            'news_list_url'=>$row['news_list_url'],
            'base_url'=>$row['base_url'],
            'requests_method'=>$row['requests_method'],
            'cloudflare_protection'=>$row['cloudflare_protection'],
            'news_list_path'=>$row['news_list_path'],
            'article_title_path'=>$row['article_title_path'],
            'article_description_path'=>$row['article_description_path'],
            'article_media_path'=>$row['article_media_path'],
            'article_date_path'=>$row['article_date_path'],
            'datetime_format'=>$row['datetime_format'],
            'article_date_regex'=>$row['article_date_regex'],
            'article_date_attribute'=>$row['article_date_attribute'],
            'article_category_path'=>$row['article_category_path'],
            'article_category_separator'=>$row['article_category_separator'],
            'article_category_index1'=>$row['article_category_index'],
            'success'=>1,
            'created_at'=>$row['created_at'],
            'updated_at'=>$row['updated_at'],



        ]);
    }
}
