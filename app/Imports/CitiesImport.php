<?php

namespace App\Imports;

use App\City;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

//class CitiesImport implements ToModel
//{
//    /**
//    * @param array $row
//    *
//    * @return \Illuminate\Database\Eloquent\Model|null
//    */
//    public function model(array $row)
//    {
//        $a=$row;
//        dd($row);
//        return new City([
//            'name' => ''
//        ]);
//    }
//}

class CitiesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        for ($i = 0; $i < count($rows); $i++)
        {
            if ($i == 0) {
                continue;
            }

            Table::create([
                'city_name'     => $rows[$i][0],
                'city_id'       => $rows[$i][1],
                'district_name' => $rows[$i][2],
                'district_id'   => $rows[$i][3],
                'ward_name'     => $rows[$i][4],
                'ward_id'       => $rows[$i][5],
            ]);
        }
    }
}
