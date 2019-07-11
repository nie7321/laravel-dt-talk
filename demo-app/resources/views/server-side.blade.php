@extends('layouts.app')

@section('content')
<h1>AJAXy DataTable</h1>
<p>This page demonstrates DT.n wired up to your Eloquent models.</p>

{!! $dataTable->table(/*['class' => 'table table-striped table-bordered dataTable']*/) !!}
@endsection

@push('scripts')
{{--
<script lang="text/javascript">
// Uses form-control-sm, but the buttons are regular sized, so it looks weird by default.
// You should rightly put this in your app.js file, but I don't want to run webpack too much during the demo!
$.extend($.fn.dataTableExt.oStdClasses, {
    'sFilterInput': 'form-control',
});
</script>
--}}

{!! $dataTable->scripts() !!}
@endpush
