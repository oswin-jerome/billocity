@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="o-card p-4 ">
                <h5 class="card-title">EMI Details </h5>
                <form class="row">
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                        <input value="{{$emi->customer->name}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Invoice #</label>
                        <input value="{{$emi->invoice_id}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Invoice Amount</label>
                        <input value="{{$emi->amount}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">DownPayment</label>
                        <input value="{{$emi->down_payment}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Emi Amount</label>
                        <input value="{{$emi->amount - $emi->down_payment}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Interval</label>
                        <input value="{{$emi->interval}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Period</label>
                        <input value="{{$emi->period}}" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 col-sm-6 col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Interest Rate</label>
                        <input value="{{$emi->interest_rate}}%" readonly type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
                <div class="o-card p-4 ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Paid On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emi->emi_entries as $item)
                            <tr>
                                <td>{{$item->date}}</td>
                                <td>₹{{$item->payable}}</td>
                                <td>₹{{$item->paid}}</td>
                                <td>{{$item->paid_date}}</td>
                                <td>
                                    @if ($item->paid_date==null)
                                        Pending
                                    @else
                                        Paid
                                    @endif
                                </td>
                                <td>
                                    @if ($item->paid_date==null)
                                        
                                    <form onSubmit="return confirm('Are you sure to mark it as paid?')" action="{{route("emi_entry.update",$item)}}" method="post">
                                        @csrf
                                        @method("PUT")
                                        {{-- <input type="text" name="" id=""> --}}
                                        <input type="submit" value="Pay" class="btn btn-warning">
                                    </form>
                                    @endif
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
        });
    </script>
@endsection
