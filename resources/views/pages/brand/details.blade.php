@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card p-4 ">
                <h5 class="card-title">Brand Details </h5>
                <form class="row">
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                        <input value="{{$brand->name}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Number of products</label>
                        <input value="{{count($brand->products)}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-4 mt-3">
                <table id="table_id" class="display table-responsive-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Barcode</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand->products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->getbrand->name}}</td>
                                <td>{{$product->getcategory->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->stock}}</td>
                                <td>{{$product->barcode}}</td>
                                <td class="">
                                    <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-primary">View</button></form>
                                    <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-warning">Edit</button></form>
                                    <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-danger">DELETE</button></form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
