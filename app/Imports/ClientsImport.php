<?php

namespace App\Imports;

use App\Id;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Id([
            'name'     => $row[0],
            'number'    => $row[1],
            'local'  => $row[2],
        ]);
    }
}
