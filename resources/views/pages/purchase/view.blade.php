@extends('layouts/layone')

@section('content')

    <div class="o-card p-4 mb-3">
        <h4 class="mb-5">Purchases</h4>


        <table class="display  table-responsive-sm " id="table_id">
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
                        <td>
                            @if ($invoice->paid < $invoice->total)
                                <button class="btn btn-info">{{$invoice->total-$invoice->paid}}</button>
                            @endif
                        </td>
                        <td>
                            <a href="purchases/{{$invoice->id}}" class="btn btn-primary">View</a>
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
