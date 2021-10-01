@extends('layouts/layone')

@section('content')

    <div class="o-card p-4 mb-3">
        <h4 class="mb-5">Invoices</h4>


        <table class="display " id="table_id">
            <thead>
                <tr>
                    {{-- <th scope="col"></th> --}}
                    <th scope="col">Invoice #</th>
                    <th scope="col">Total</th>
                    <th scope="col">GST</th>
                    <th scope="col">Products</th>
                    <th scope="col">Discounts</th>
                    <th scope="col">Payment Mode</th>
                    <th scope="col">status</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Final Price</th>
                    <th scope="col">Profit</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $key=>$invoice)
                    <tr>
                        
                        {{-- <th width="100px" hidden scope="row">{{$key+1}}</th> --}}
                        <th>{{$invoice->id}}</th>
                        <td>{{$invoice->total}} </td>
                        <td>
                            <?php try{ ?> 
                            {{ ($invoice->total * ($invoice->products->sum('gst')/$invoice->products->count('gst'))/100)}}
                            <small>({{$invoice->products->whereIn('status',['DONE','CANCLED'])->sum('gst')/$invoice->products->whereIn('status',['DONE','CANCLED'])->count('gst')}} %)</small>
                            <?php }catch(\Exception $e){ ?>
    // show something else
<?php } ?>
                        </td>
                        <td>{{count($invoice->products)}}</td>
                        <td>{{$invoice->points_redeem + $invoice->coupon_redeem + $invoice->discount}}</td>
                        <td>{{$invoice->payment_method}}</td>
                        <td>{{$invoice->status}}</td>
                        <td>
                            @if ($invoice->custo)
                                {{$invoice->custo->name}}
                            @endif
                        </td>
                        <td>{{$invoice->final_price}}</td>
                        <td>{{$invoice->profit}}</td>
                        @if ($invoice->final_price - $invoice->paid_amount>0)
                             <td>
                                 <button data-id={{$invoice->id}} data-amount="{{$invoice->final_price - $invoice->paid_amount}}" type="button" class="btn btn-info payMod" data-toggle="modal" data-target="#exampleModal">{{$invoice->final_price - $invoice->paid_amount}} </button>
                             </td>
                            @else
                            <td>{{$invoice->final_price - $invoice->paid_amount }} </td>
                            @endif
                        <td>
                            <a href="/invoices/{{$invoice->id}}" class="btn btn-primary m-0">View</a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>

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
            $('#exampleModal').appendTo("body").modal('show');
            $('#modamount').val($(this).data('amount'))
            $('#modid').val($(this).data('id'))
        });
    </script>
@endsection
