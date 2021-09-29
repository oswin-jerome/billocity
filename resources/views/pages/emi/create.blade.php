@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class=" col-sm-12 col-lg-12">
            <div class="card p-4">
                <h5 class="card-title">Add Emi</h5>
                @livewire('create-emi')
            </div>
        </div>
    </div>
@endsection
