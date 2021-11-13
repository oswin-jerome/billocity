@extends('layouts/layone')

@section('content')

<div class="row">
    <div class=" pr-2 py-3 col-sm-12 col-md-8">
        <div class="card p-4">
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
    <div class=" pl-2 py-3 col-sm-12 col-md-4 h-100" style="grid-row: 0/2 !important;gap:15px;"  >
        <div class="card p-4" style="height:100%">
            <div class="d-flex  mb-2">
                <h4>Balance : </h4>
                <h4> &nbsp;{{$purchases->sum('total') - $purchases->sum('paid')}}</h4>
            </div>
            <div class="d-flex mb-2">
                <h4>Amount Paid : </h4>
                <h4>{{$purchases->sum('paid')}}</h4>
            </div>
            <div class="d-flex mb-2">
                <h4>Total Purchase : </h4>
                <h4>{{$purchases->sum('total')}}</h4>
            </div>
        </div>
        <div class="card p-4" style="height:100%">
            <h4>Pay Supplier</h4>
            <form action="/purchases/get_pay_bulk" method="post">
                @csrf
                <input type="text" hidden name="supplier_id" value="{{$supplier->id}}" placeholder="">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" class="form-control" value="0" placeholder="" name="amount">
                </div>
                <button class="btn btn-primary">Pay</button>
            </form>
        </div>
    </div>
    


    <div class=" pl-2 py-3 col-12">
        <div class="card p-4">
            {{-- <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>Date</th>
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
                            <td>{{$stock->created_at}}</td>
                            <td>{{$stock->getproduct->name}}</td>
                            <td>{{$stock->stock}}</td>
                            <td>{{$stock->total}}</td>
                            <td>{{$stock->paid}}</td>
                            @if ($stock->balance>0)
                             <td>
                                 <button data-id={{$stock->id}} data-amount="{{$stock->balance}}" type="button" class="btn btn-info payMod" data-toggle="modal" data-target="#exampleModal">{{$stock->balance}} </button>
                             </td>
                            @else
                            <td>{{$stock->balance}} </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}

            <table class="display table-responsive-sm " id="table_id">
                <thead>
                    <tr>
                        {{-- <th scope="col"></th> --}}
                        <th scope="col">Purchase #</th>
                        <th scope="col">Date</th>
                        <th scope="col">Invoice #</th>
                        <th scope="col">ref #</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">No. of Products</th>
                        <th scope="col">Total</th>
                        <th scope="col">Amount paid</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $key=>$invoice)
                        <tr>
                            
                            {{-- <th width="100px" hidden scope="row">{{$key+1}}</th> --}}
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->date}}</td>
                            <td>{{$invoice->invoice_no}}</td>
                            <td>{{$invoice->ref_no}}</td>
                            <td>{{$invoice->getsupplier->name}}</td>
                            <td>{{count($invoice->products)}}</td>
                            <td>{{ $invoice->products->sum('total') }}</td>
                            <td>{{$invoice->paid}}</td>
                            {{-- <td>
                                @if ($invoice->paid < $invoice->total)
                                    <button class="btn btn-info">{{$invoice->total-$invoice->paid}}</button>
                                @endif
                            </td> --}}
                            @if ($invoice->total - $invoice->paid >0)
                             <td>
                                 <button data-id={{$invoice->id}} data-amount="{{$invoice->total - $invoice->paid}}" type="button" class="btn btn-info payMod" data-toggle="modal" data-target="#exampleModal">{{$invoice->total - $invoice->paid}} </button>
                             </td>
                            @else
                            <td>{{$invoice->total - $invoice->paid}} </td>
                            @endif
                            <td>
                                <a href="/purchases/{{$invoice->id}}" class="btn btn-primary">View</a>
                            </td>
                            
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
            <form method="POST" action="{{ ('/purchases/get_pay')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                    <label for="amount">Amount :</label>
                    <input name="amount" id="modamount" class="form-control">
                </div>
                
              <input type="submit" value="PAY" class="btn btn-warning">
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
                    title: "<h1>Supplier report (<?php echo($supplier->name) ?>) <br><br>",
                    
                }
        ]
        });
    });

    $('.payMod').on('click',function(){
        $('#exampleModal').appendTo("body").modal('show');

        $('#modamount').val($(this).data('amount'))
        $('#modid').val($(this).data('id'))
    });
</script>

@endsection
