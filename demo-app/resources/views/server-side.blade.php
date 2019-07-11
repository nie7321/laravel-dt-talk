@extends('layouts.app')

@section('content')
<h1>AJAXy DataTable</h1>
<p>This page demonstrates DT.n wired up to your Eloquent models.</p>

{!! $dataTable->table() !!}
@endsection

@push('scripts')
<script lang="text/javascript">
/*
// Uses form-control-sm, but the buttons are regular sized, so it looks weird by default.
$.extend($.fn.dataTableExt.oStdClasses, {
    'sFilterInput': 'form-control',
});
</script>
*/

{!! $dataTable->scripts() !!}
@endpush
