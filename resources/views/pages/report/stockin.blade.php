@extends('layouts/layone')

@section('content')
    <div class="o-card p-4">
        <div class="d-flex justify-content-between align-items-center align-self-center">
            <h4 class="mb-5">Stock IN report</h4>
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
                    <th>Date</th>
                    <th>Product</th>
                    <th>Invoice #</th>
                    <th>Supplier</th>
                    <th>Stock</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @if (count($stocks)>0)
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{$stock->id}}</td>
                        <td>{{$stock->created_at->format('d/m/Y')}}</td>
                        <td>{{$stock->getproduct->name}}</td>
                        <td>
                            @if ($stock->getinvoice)
                            {{$stock->getinvoice->invoice_no}}
                            @endif
                        </td>
                        <td>
                            @if ($stock->getinvoice)
                            {{$stock->getinvoice->getsupplier->name}}
                            @endif
                        </td>
                        <td>{{$stock->stock}}</td>
                        <td>
                            @if ( $stock->getinvoice)
                            {{ $stock->getinvoice->products->sum('total') }}
                            @else
                            {{$stock->price}}
                            @endif
                        </td>
                        <td>{{$stock->paid}}</td>
                        <td>{{$stock->balance}}</td>
                        
                    </tr>
                @endforeach    
                @endif
            </tbody>
        </table>
    </div>
    <script>
        var date = new Date();
        $(document).ready( function () {
        $('#table_id').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel',{
                    extend: 'print',
                    text: 'Print',
                    title: `<h1>Stock IN report</h1><p>${date}</p>`,
                    
                },
                {
                    extend: 'pdf',
                    title: `Billocity - Stock IN report \n ${date}`,
                    customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                }
        ]
        });
    });
    </script>
@endsection