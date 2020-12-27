@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="o-card p-4 col-12">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Points</th>
                        <th>Credit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->phone}}</td>
                            <td>{{$product->email}}</td>
                            <td>{{$product->points}}</td>
                            <td>{{$product->credit}}</td>
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

    <script>
        $(document).ready( function () {
    $('#table_id').DataTable();
} );
    </script>
@endsection
