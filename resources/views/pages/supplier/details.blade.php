@extends('layouts/layone')

@section('content')

<div class="row">
    <div class=" pr-2 py-3 col-sm-12 col-md-8">
        <div class="o-card p-4">
            <h4>Supplier Details</h4>
            <form>
                {{-- {{ csrf_field() }} --}}

                <div class="row">
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Supplier Name</label>
                        <input disabled type="text" value="{{$supplier->name}}" name="name" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Phone #</label>
                        <input disabled type="text" value="{{$supplier->phone}}" name="phone" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-12">
                        <label for="exampleInputEmail1" class="form-label">Email (optional)</label>
                        <input disabled type="email" value="{{$supplier->email}}" name="mobile" class="form-control" id="exampleInputEmail1" >
                    </div>

                    <div class="mb-3 col-sm-12 col-lg-12">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <textarea disabled name="address" value="{{$supplier->address}}" id=""  class="form-control">{{$supplier->address}}</textarea>
                    </div>
                </div>
                
                {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
            </form>
        </div>
    </div>
    <div class=" pl-2 py-3 col-sm-12 col-md-4">
        <div class="o-card p-4">
            <div class="d-flex mb-2">
                <h4>Balance : </h4>
                <h4>{{$stocks->sum('balance')}}</h4>
            </div>
            <div class="d-flex mb-2">
                <h4>Amount Paid : </h4>
                <h4>{{$stocks->sum('paid')}}</h4>
            </div>
            <div class="d-flex mb-2">
                <h4>Total Purchase : </h4>
                <h4>{{$stocks->sum('total')}}</h4>
            </div>
        </div>
    </div>


    <div class=" pl-2 py-3 col-12">
        <div class="o-card p-4">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Stock</th>
                        <th>Amount</th>
                        <th>Paid</th>
                        <th>balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr>
                            <td>{{$stock->getproduct->name}}</td>
                            <td>{{$stock->stock}}</td>
                            <td>{{$stock->total}}</td>
                            <td>{{$stock->paid}}</td>
                            <td>{{$stock->balance}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf',{
                    extend: 'print',
                    text: 'Print',
                    title: "<h1>Supplier report (<?php echo($supplier->name) ?>) <br><br>",
                    
                }
        ]
        });
    });
</script>

@endsection
