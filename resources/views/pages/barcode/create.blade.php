@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="o-card p-4 ">
                <h5 class="card-title">Generate Barcode</h5>
                <form method="POST" action="{{ route('barcode.generate')}}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">barcode number</label>
                        <input type="text" name="code" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
