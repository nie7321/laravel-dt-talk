<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploymentType;
use App\DataTables\FilterableDataTable;

class FilterableController extends Controller
{
    public function __invoke(Request $request, FilterableDataTable $dataTable)
    {
        return $dataTable->render('filterable', [
            'employment_types' => EmploymentType::orderBy('name')->get()->pluck('name', 'id'),
        ]);
    }
}
