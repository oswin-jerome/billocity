@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="o-card p-4 col-12">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->created_at}}</td>
                            <td class="">
                                <a href="brands/{{$brand->id}}" class="btn btn-primary">View</a>
                                {{-- <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-primary">View</button></form> --}}
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
