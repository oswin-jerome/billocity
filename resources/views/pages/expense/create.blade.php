@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="o-card p-4">
                <h5 class="card-title">Add Expense</h5>
                <form method="POST" action="{{ route('expenses.store')}}" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="name">Amount</label>
                            <input required type="text" name="amount" class="form-control" id="name">
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="barcode">Category</label>
                            <select name="category" class="form-control selectpicker" id="category" data-live-search="true">
                                <option disabled selected>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <input type="submit" value="Add" class="btn btn-primary px-5 mt-4">
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
