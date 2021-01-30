@extends('layouts/layone')

@section('content')
    <div class="o-card p-4">
        <div class="d-flex justify-content-between align-items-center align-self-center">
            <h4 class="mb-5">Sales report</h4>
            <form action="">
                <div class="d-flex">
                    <div class="form-group mr-2">
                        <label for="">From date</label>
                        <input required type="date" name="from" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">To date</label>
                        <input required type="date" name="to" class="form-control" id="">
                    </div>
                </div>
                {{-- <input type="submit" value="GET" class="btn btn-primary"> --}}
                <button class="btn btn-primary">GET</button>
            </form>
        </div>

        <br><br>

        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>No. of Products</th>
                    <th>Total</th>
                    <th>Points</th>
                    <th>Coupon</th>
                    <th>Final price</th>
                    <th>Amount Paid</th>
                    <th>Profit</th>
                    <th>Payment Method</th>
                    <th>Invoice status</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>

                            @if ($invoice->custo)
                            {{$invoice->custo->name}}
                            @endif

                        </td>
                        <td>{{$invoice->created_at->format('d/m/Y')}}</td>
                        <td>{{count($invoice->products)}}</td>
                        <td>{{$invoice->total}}</td>
                        <td>{{$invoice->points_redeem}}</td>
                        <td>{{$invoice->coupon_redeem}}</td>
                        <td>{{$invoice->final_price}}</td>
                        <td>{{$invoice->paid_amount}}</td>
                        <td>{{$invoice->profit}}</td>
                        <td>{{$invoice->payment_method}}</td>
                        <td>{{$invoice->status}}</td>
                        {{-- <td class="">
                            <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-primary">View</button></form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th> </th>
                    <th> </th>
                    <th>Total : </th>
                    <th>{{$invoices->sum('final_price') - $invoices->sum('paid_amount')}}</th>
                </tr>
                {{-- <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th> </th>
                    <th> </th>
                    <th>Profit : </th>
                    <th>{{$invoices->sum('profit')}}</th>
                </tr> --}}
                
            </tfoot>
        </table>
    </div>
    <script>
        var date = new Date();
        $(document).ready( function () {
        $('#table_id').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf',{
                    extend: 'print',
                    text: 'Print',
                    title: `<h1>Stock report</h1><p>${date}</p>`,
                    footer: true
                }
        ]
        });
    });
    </script>
@endsection