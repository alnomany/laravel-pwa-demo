<?php

namespace App\Exports;

use App\Tags;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TagsExport implements FromCollection, ShouldAutoSize,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tags::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'sources_id',
            'source_name',
            'source_language',
            'source_language_level',
            'news_classifications',
            'news_classifications_general',
            'news_list_url',
            'base_url',

            'requests_method',
            'cloudflare_protection',
            'news_list_path',
            'article_elements_paths',
            'article_title_path',
            'article_description_path',
            'article_media_path',
            'article_date_path',
            'datetime_format',
            'article_date_regex',
            'article_date_attribute',
            'article_category_path',
            'article_category_separator',
            'article_category_index',
            'article_category_index1',
            'success',
            'created_at',
            'updated_at',
        ];
    }


}
