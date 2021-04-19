@extends('layouts/layone')


@section('content')
   <div class="row">
       <div class="col-12">
        <div class="card p-4 mb-3">
            <h4 class="mb-4">Returned Products</h4>
            <table class="display" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $product->prod->name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td></td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->sold_price * $product->quantity }}</td>
                            <td>
                                <a class="btn btn-info" href="/invoices/{{$product->invoice}}">View Invoice</a>
                            </td>
                        </tr>
                    @endforeach
    
                </tbody>
            </table>
    
    
    
    
    
        </div>
       </div>
   </div>
   
   <div class="row">
       <div class="col-12">
        <div class="card p-4 mb-3">
            <h4 class="mb-4">Cancled Products</h4>
            <table class="display" id="table_id2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cancled as $key => $product)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $product->prod->name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td></td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->sold_price * $product->quantity }}</td>
                            <td>
                                <a class="btn btn-info" href="/invoices/{{$product->invoice}}">View Invoice</a>
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
    $('#table_id2').DataTable();
    
} );
    </script>
@endsection
