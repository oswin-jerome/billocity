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
                            {{ ($invoice->total * ($invoice->products->sum('gst')/$invoice->products->count('gst'))/100)}}
                            <small>({{$invoice->products->whereIn('status',['DONE','CANCLED'])->sum('gst')/$invoice->products->whereIn('status',['DONE','CANCLED'])->count('gst')}} %)</small>
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
                        <td>
                            <a href="/invoices/{{$invoice->id}}" class="btn btn-primary m-0">View</a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>

    </div>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
