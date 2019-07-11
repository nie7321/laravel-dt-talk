<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class FilterableDataTable extends DataTable
{
    const CLERICAL_NAME = "TRIM(employees.last_name || ', ' || employees.first_name || ' ' || LEFT(COALESCE(employees.middle_name, ''), 1))";

    public function query(Employee $model)
    {
        return $model->newQuery()
            // This will add a calculated field to our AJAX response -- in this case, "LastName, FirstName MiddleInitial" as the clerical_name field.
            // We *could* do this in DT.n with a render function too, but eh, demo!
            ->select('employees.*') // needed when we addSelect
            ->addSelect(DB::raw(self::CLERICAL_NAME . ' AS clerical_name'))

            // Loads the model relationships & they will be included in the AJAX response.
            ->with('employment_type', 'job_description');
    }

    protected function getColumns()
    {
        return [
            ['title' => 'Full Name', 'data' => 'clerical_name', 'name' => 'clerical_name'],
            ['title' => 'Position', 'data' => 'job_description.title', 'name' => 'job_description.title'],
            ['title' => 'Employee ID', 'data' => 'employee_id', 'name' => 'employee_id'],
            ['title' => 'Salary', 'data' => 'salary', 'name' => 'salary', 'visible' => false],
            ['title' => 'Type', 'data' => 'employment_type.name', 'name' => 'employment_type.name'],
            ['title' => 'Tax Code', 'data' => 'employment_type.tax_code', 'name' => 'employment_type.tax_code', 'visible' => false],
            [
                'title' => 'Onboarding',
                'data' => 'onboarding_in_progress',
                'name' => 'onboarding_in_progress',
                'render' => "data == true ? '<span class=\'text-info\'>Yes</span>' : 'No'",
            ],

            /*
            // Special filters only
            ['title' => 'Employment Type ID (no show)', 'data' => 'employment_type.id', 'name' => 'employment_type.id', 'visible' => false, 'class' => 'never-show-column'],
            */
        ];
    }

    public function dataTable($query)
    {
        return datatables($query)
            ->filterColumn('clerical_name', function ($query, $keyword) {
                $query->where(DB::raw(self::CLERICAL_NAME), 'ilike', "%${keyword}%");
            })
            /*
            ->filterColumn('employment_type.id', function ($query, $keyword) {
                $keyword = json_decode($keyword, true) ?? [];

                if (sizeof($keyword) > 0) {
                    $query->whereIn('employees.employment_type_id', $keyword);
                }
            })
            */
            ;
    }

    public function getBuilderParameters()
    {
        $params = parent::getBuilderParameters();

        $params['pageLength'] = 25;

        // $params['dom'] = '<"row"<"col-md-2"B><"col-md-4 ml-auto"f>>rtp';

        /*
        // Note the <"#type-filter"> -- this adds an empty <div id="type-filter">so we can put some extra filters on top!
        $params['dom'] = '<"row"<"col-md-2"B><"col-md-2 ml-auto"f><"#type-filter.col-md-3">>rtp';
        */

        $params['language']['search'] = '';
        $params['language']['searchPlaceholder'] = 'Search...';

        $params['buttons'] = [
            'reload',
            'csv',
            [
                'extend' => 'colvis',
                'text' => 'Columns',
                // 'columns' => ':not(.never-show-column)',
            ],
        ];

        return $params;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ServerSide_' . date('YmdHis');
    }
}
