@extends('layouts.app')

@section('content')
<h1>Filterable DataTable</h1>
<p>This page add a filter UI element to what we previously had. Same data &amp; same table (to start).</p>

{!! $dataTable->table(['class' => 'table table-striped table-bordered dataTable']) !!}

{{--
-- Will be moved into the proper spot above the DataTable, but doing it here
-- as normal HTML makes it a bit more readable than trying to jam it in the JS.
--}}
<div id="filter-control-template" class="d-none">
    <select id="employment-type-filter" multiple class="selectpicker" title="Employement Type" data-style="btn-secondary w-100">
        @foreach ($employment_types as $id => $label)
            <option value="{{ $id }}">{{ $label }}</option>
        @endforeach
    </select>
</div>
@endsection

@push('scripts')
{{-- You'd want to load these via yarn & use webpack, but again, trying to minimize webpack builds during the demo! --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script lang="text/javascript">
$.extend($.fn.dataTableExt.oStdClasses, {
    'sFilterInput': 'form-control',
});

$(document).ready(function () {
    var controls = $('#filter-control-template').html();
    $('#filter-control-template').remove();
    $('#type-filter').html(controls);

    /*
    $('#employment-type-filter').change(function () {
        var api = $('#dataTableBuilder').DataTable(); // gets us access to the DT.n object
        var employment_type_id_list = $('#employment-type-filter').val(); // get the IDs from the <select>

        api.column('employment_type.id:name').search(JSON.stringify(employment_type_id_list), false, false, false).draw();
    });
    */
});
</script>

{!! $dataTable->scripts() !!}
@endpush
