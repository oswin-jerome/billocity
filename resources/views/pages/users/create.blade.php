@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="card p-4 ">
                <h5 class="card-title">Add User </h5>
                <form method="POST" action="{{ route('users.store')}}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Email</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Password</label>
                        <input type="text" name="password" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Password</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="pos">Pos</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
