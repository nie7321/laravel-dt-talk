<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ServerSideDataTable;

class ServerSideController extends Controller
{
    public function __invoke(Request $request, ServerSideDataTable $dataTable)
    {
        // This is rendering a normal view, but will inject the DT.n config into it too!
        return $dataTable->render('server-side');
    }
}
