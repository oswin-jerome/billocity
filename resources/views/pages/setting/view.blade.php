@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card p-4">
                <h5 class="card-title">Setting</h5>
                <form method="POST" action="/settings/{{$setting->id}}" >
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="name">Name</label>
                            <input required value="{{$setting->name}}" type="text" name="name" class="form-control" >
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="name">Address</label>
                            <textarea name="address" class="form-control">{{$setting->address}}</textarea>
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="name">GST #</label>
                            <input required type="text" value="{{$setting->gst}}" name="gst" class="form-control" >
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="name">Phone</label>
                            <input required type="text" value="{{$setting->phone}}" name="phone" class="form-control" >
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="name">Email</label>
                            <input required type="text" value="{{$setting->email}}" name="email" class="form-control" >
                        </div>
                    </div>
    
                    <input type="submit" value="Update" class="btn btn-warning px-5 mt-4">
                </form>
            </div>
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     $('select').select2();
        // });

        //         <select class="selectpicker" multiple data-live-search="true">
        //   <option>Mustard</option>
        //   <option>Ketchup</option>
        //   <option>Relish</option>
        // </select>

    </script>
@endsection
