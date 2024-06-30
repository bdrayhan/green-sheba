<?php

namespace App\Exports;

use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CategoryExport implements FromView
{
    public function view(): View
    {
        return view('backend.exports.category', [
            'categories' => ProductCategory::all()
        ]);
    }
}
