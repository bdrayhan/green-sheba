<?php

namespace App\Imports;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
//        Log::info($row);
        return new ProductCategory([
            'pc_name' => $row['pc_name'],
            'pc_url' => $row['pc_url'],
            'pc_feature' => $row['pc_feature'],
            'pc_orderby' => $row['pc_orderby'],
            'pc_active' => $row['pc_active'],
            'pc_status' => $row['pc_status'],
            'pc_creator' => Auth::user()->id,
            'pc_slug' => uniqid(),
        ]);
    }
}
