@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="o-card p-4 col-12">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>HSN</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>GST</th>
                        <th>Stock</th>
                        <th>Barcode</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->getbrand->name}}</td>
                            <td>{{$product->getcategory->name}}</td>
                            <td>{{$product->hsn_code}}</td>
                            <td>{{$product->cost_price}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->gst}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->barcode}}</td>
                            <td class="">
                                <form action="" class="m-0 p-0 d-inline"><button disabled type="submit" class="btn btn-primary">View</button></form>
                                <form action="" class="m-0 p-0 d-inline"><a href="/products/{{$product->id}}/edit" class="btn btn-warning">Edit</a></form>
                                <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-danger" disabled>DELETE</button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
