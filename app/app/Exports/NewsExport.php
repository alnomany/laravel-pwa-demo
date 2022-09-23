<?php

namespace App\Exports;

use App\News;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewsExport implements WithHeadings,WithMapping,FromQuery
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function forYear($book)
    {
        $this->book = $book;

        return $this;
    }


    public function query()

    {
        $book=$this->book;
        return News::query()->Where(function ($query) use($book) {


                    for ($i = 0; $i < count($book); $i++){
                       $query->orwhereRaw("(REPLACE(REPLACE(REPLACE(body_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                       . "REPLACE(REPLACE(REPLACE(body_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                       . " )")->orwhereRaw("(REPLACE(REPLACE(REPLACE(title_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                       . "REPLACE(REPLACE(REPLACE(title_original, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                       . " )")->orwhereRaw("(REPLACE(REPLACE(REPLACE(body_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                       . "REPLACE(REPLACE(REPLACE(body_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                       . " )")->orwhereRaw("(REPLACE(REPLACE(REPLACE(title_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%' OR "
                       . "REPLACE(REPLACE(REPLACE(title_translated, 'ة', 'ه'), 'أ', 'ا'), 'إ', 'ا') like '%" . $book[$i] . "%'"

                       . " )");
                    }
               })->get();


    }
    public function collection()
    {
        return News::all();
    }
    public function headings(): array
    {
        return [
            'Id',
            'name',
            'link',

            'dateincident ',

        ];
    }
    public function map($news): array
    {
        return [
            $news->id,
            $news->title_original,
            $news->link,
            $news->datetime,



        ];
    }
}
