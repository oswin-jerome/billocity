@extends('layouts/layone')

@section('content')
    <div class="row">
       <div class="col-12">
        <div class="card p-4">
            {!! $dataTable->table(['class' => 'table-responsive-sm display','width' => '100%']) !!}
        </div>
       </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endsection
