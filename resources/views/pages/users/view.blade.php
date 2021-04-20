@extends('layouts/layone')

@section('content')
    <div class="row">
        
        <div class="col-12">
            <div class="card p-4 ">
                <table id="table_id" class="display table-responsive-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="">
                                    {{-- <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-primary">View</button></form>
                                    <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-warning">Edit</button></form> --}}
                                    <form action="{{route('users.destroy',$user->id)}}" method="POST" class="m-0 p-0 d-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">DELETE</button>
                                    </form>
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
} );
    </script>
@endsection
