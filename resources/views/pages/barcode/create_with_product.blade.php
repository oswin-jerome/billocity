@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="o-card p-4 ">
                <h5 class="card-title">Generate Barcode</h5>
                <form method="POST" action="{{ route('barcode.generate_with_product')}}">
                    {{ csrf_field() }}

                    <select name="product" id="product" class="form-control selectpicker" data-live-search="true">
                        <option selected disabled value="">No product selected</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
