<?php

namespace App\Exports;

use App\source;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SourcesExport implements FromCollection , ShouldAutoSize,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return source::all();
    }
    public function headings(): array
    {
        return [
            'id',
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

            'created_at',
            'updated_at',
        ];
    }

}
