@extends('layouts/layone')

@section('content')

<div class="row">
   <div class="col-sm-12 col-md-8">
    <div class=" pr-2 py-3 ">
        <div class="o-card p-4">
            <h4>Customer Details</h4>
            <form>
                {{-- {{ csrf_field() }} --}}

                <div class="row">
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                        <input disabled type="text" value="{{$customer->name}}" name="name" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Phone #</label>
                        <input disabled type="text" value="{{$customer->phone}}" name="phone" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-12">
                        <label for="exampleInputEmail1" class="form-label">Email (optional)</label>
                        <input disabled type="email" value="{{$customer->email}}" name="mobile" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">GST #</label>
                        <input disabled type="text" value="{{$customer->gst}}" name="name" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="exampleInputEmail1" class="form-label">Date of Birth</label>
                        <input disabled type="text" value="{{$customer->dob}}" name="phone" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-12">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <textarea disabled name="address" value="{{$customer->address}}" id=""  class="form-control">{{$customer->address}}</textarea>
                    </div>
                </div>
                
                {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
            </form>
        </div>
    </div>
   </div>
    <div class=" pl-2 py-3 col-sm-12 col-md-4 h-100" style="grid-row: 0/2 !important"  >
        {{-- <div class="o-card p-4" style="height:100%">
            <div class="d-flex  mb-2">
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
        </div> --}}
    </div>


    <div class=" pl-2 py-3 col-12">
        <div class="card p-4">
            <h3>Emi details</h3>
            <table id="table_id" class="display table-responsive-sm">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Downpayment</th>
                        <th>Intrest rate</th>
                        <th>Interval</th>
                        <th>Period</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emis as $emi)
                        <tr>
                            <th>{{$emi->invoice_id}}</th>
                            <th>{{$emi->created_at->format('d/m/Y')}}</th>
                            <td>{{$emi->amount}}</td>
                            <td>{{$emi->down_payment}}</td>
                        <td>{{$emi->interest_rate}}</td>
                        <td>{{$emi->interval}}</td>
                        <td>{{$emi->period}}</td>
                        <td>
                            <a href="{{'/emi/'.$emi->id}}" class="btn btn-primary">View</a>
                        </td>
                       
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class=" pl-2 py-3 col-12">
        <div class="card p-4">
            <table id="table_id" class="display table-responsive-sm">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Date</th>
                        <th># Products</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Payment Mode</th>
                        <th>Status</th>
                        <th>Final Price</th>
                        <th>Paid</th>
                        <th>Profit</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <th>{{$invoice->id}}</th>
                            <th>{{$invoice->created_at->format('d/m/Y')}}</th>
                            <td>{{count($invoice->products)}}</td>
                            <td>{{$invoice->total}}</td>
                        <td>{{$invoice->points_redeem + $invoice->coupon_redeem}}</td>
                        <td>{{$invoice->payment_method}}</td>
                        <td>{{$invoice->status}}</td>
                        <td>{{$invoice->final_price}}</td>
                        <td>{{$invoice->paid_amount}}</td>
                        <td>{{$invoice->profit}}</td>
                            @if ($invoice->final_price - $invoice->paid_amount>0)
                             <td>
                                 <button data-id={{$invoice->id}} data-amount="{{$invoice->final_price - $invoice->paid_amount}}" type="button" class="btn btn-info payMod" data-toggle="modal" data-target="#exampleModal">{{$invoice->final_price - $invoice->paid_amount}} </button>
                             </td>
                            @else
                            <td>{{$invoice->final_price - $invoice->paid_amount }} </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" id="modbody">
            <form method="POST" action="{{ ('/invoice/get_pay')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                    <label for="amount">Amount :</label>
                    <input name="amount" id="modamount" class="form-control">
                </div>
                
              <input type="submit" value="GET PAYMENT" class="btn btn-warning">
              <input name="pid" id="modid" class="form-control" hidden>
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
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
                    title: "<h1>Customer report (<?php echo($customer->name) ?>) <br><br>",
                    
                }
        ]
        });
    });

    $('.payMod').on('click',function(){
        $('#modamount').val($(this).data('amount'))
        $('#modid').val($(this).data('id'))
    });
</script>

@endsection
