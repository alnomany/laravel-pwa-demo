<?php

namespace App\Imports;

use App\source;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SourcesIxport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new source([
            //
            'source_name'=>$row['source_name'],
            'source_link'=>$row['source_link'],
            'source_country'=>$row['source_country'],
            'source_main_language'=>$row['source_main_language'],
            'source_second_language'=>$row['source_second_language'],
            'source_thired_language'=>$row['source_thired_language'],
            'source_fourth_language'=>$row['source_fourth_language'],
            'source_five_language'=>$row['source_five_language'],
            'source_type'=>$row['source_type'],
            'source_logo'=>$row['source_logo'],
            'created_at'=>$row['created_at'],
            'updated_at'=>$row['updated_at'],
        ]);
    }
}
