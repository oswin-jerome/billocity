@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="o-card p-4 ">
                <h5 class="card-title">Add Supplier</h5>
                <form method="POST" action="{{ route('suppliers.store')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-lg-6">
                            <label for="exampleInputEmail1" class="form-label">Supplier Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="mb-3 col-sm-12 col-lg-6">
                            <label for="exampleInputEmail1" class="form-label">Phone #</label>
                            <input type="text" name="phone" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="mb-3 col-sm-12 col-lg-12">
                            <label for="exampleInputEmail1" class="form-label">Email (optional)</label>
                            <input type="email" name="mobile" class="form-control" id="exampleInputEmail1" >
                        </div>
    
                        <div class="mb-3 col-sm-12 col-lg-12">
                            <label for="exampleInputEmail1" class="form-label">Address</label>
                            <textarea name="address" id=""  class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
