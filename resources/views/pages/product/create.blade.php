@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="o-card p-4 col-13">
            <h5 class="card-title">Add Product</h5>
            <form method="POST" action="{{ route('products.store')}}" >
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-8">
                        <label for="name">Product Name</label>
                        <input required type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label for="barcode">Barcode</label>
                        <input required type="text" name="barcode" class="form-control" id="barcode">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label for="brand">Brand</label>
                        <select name="brand" class="form-control selectpicker" id="brand" data-live-search="true">
                            <option disabled selected>Select a brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label for="barcode">Category</label>
                        <select name="category" class="form-control selectpicker" id="category" data-live-search="true">
                            <option disabled selected>Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-8">
                        <label for="price">Price</label>
                        <input required type="text" name="price" class="form-control" id="price">
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label for="stock">Stock</label>
                        <input required type="text" name="stock" class="form-control" id="stock">
                    </div>
                </div>

                <input type="submit" value="Add" class="btn btn-primary px-5 mt-4">
            </form>
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     $('select').select2();
        // });

        //         <select class="selectpicker" multiple data-live-search="true">
        //   <option>Mustard</option>
        //   <option>Ketchup</option>
        //   <option>Relish</option>
        // </select>

    </script>
@endsection
