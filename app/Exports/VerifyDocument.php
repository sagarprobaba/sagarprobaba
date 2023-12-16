<?php

namespace App\Exports;

use App\Models\Verification;
use Maatwebsite\Excel\Concerns\FromCollection;

class VerifyDocument implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Verification::all();
    }
}
