@extends('layouts/layone')

@section('content')
    <div class="o-card p-4">
        <h4 class="mb-5">Stock Out report</h4>

        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Stock out</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->sold()->sum("quantity")}}</td>
                        <td>{{$product->getbrand->name}}</td>
                        <td>{{$product->getcategory->name}}</td>
                        <td class="">
                            <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-primary">View</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        var date = new Date();
        $(document).ready( function () {
        $('#table_id').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf',{
                    extend: 'print',
                    text: 'Print',
                    title: `<h1>Stock report</h1><p>${date}</p>`,
                    
                }
        ]
        });
    });
    </script>
@endsection