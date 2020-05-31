<?php

namespace App\Imports;

use App\City;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Row;

class CitiesImport implements OnEachRow, WithChunkReading
{
    /**
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        if ($row->getIndex() !== 1) {
            $row = $row->toArray();

            $city = City::updateOrCreate(
                ['city_id' => (int) $row[1]],
                ['name' => $row[0]]
            );

            $district = $city->districts()->updateOrCreate(
                ['district_id' => (int) $row[3]],
                ['name' => $row[2]]
            );

            if ($row[4]) {
                $district->wards()->updateOrCreate(
                    ['ward_id' => (int) $row[5]],
                    ['name' => $row[4]]
                );
            }
        }
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
