@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class=" col-sm-12 col-lg-12">
            <div class="card p-4">
                <h5 class="card-title">Add Customer</h5>
                <form method="POST" action="{{ route('customers.store')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-lg-6">
                            <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                            <input type="text" name="name" class="form-control"  >
                        </div>
                        <div class="mb-3 col-sm-12 col-lg-6">
                            <label for="exampleInputEmail1" class="form-label">Phone #</label>
                            <input type="number"  name="phone" class="form-control"  >
                        </div>
                        <div class="mb-3 col-sm-12 col-lg-4">
                            <label for="exampleInputEmail1" class="form-label">Email (optional)</label>
                            <input type="email" name="email" class="form-control"  >
                        </div>
                        <div class="mb-3 col-sm-12 col-lg-4">
                            <label for="exampleInputEmail1" class="form-label">GST # (optional)</label>
                            <input type="text" name="gst" class="form-control"  >
                        </div>
                        <div class="mb-3 col-sm-12 col-lg-4">
                            <label for="exampleInputEmail1" class="form-label">Date of birth # (optional)</label>
                            <input type="date" name="dob" class="form-control"  >
                        </div>
                        <div class="mb-3 col-sm-12 col-lg-12">
                            <label for="exampleInputEmail1" class="form-label">Address (optional)</label>
                            <textarea name="address" class="form-control "></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
