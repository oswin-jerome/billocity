@extends('layouts/layone')

@section('content')

    <div class="row">
      <div class="col-12">
        <div class="card p-4 mb-3">
          <h4 class="mb-5">Invoices</h4>
  
  
          <table id="table_id" class="display">
              <thead>
                  <tr>
                      <th>Invoice #</th>
                      <th>Date</th>
                      <th>Customer</th>
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
                          <th>@if ($invoice->custo)
                              {{$invoice->custo->name}}
                          @endif</th>
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
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
        $('.payMod').on('click',function(){
        $('#modamount').val($(this).data('amount'))
        $('#modid').val($(this).data('id'))
    });
    </script>
@endsection
