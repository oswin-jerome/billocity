@extends('layouts/layone')

@section('content')
    <div class="o-card p-4">
        <div class="d-flex justify-content-between align-items-center align-self-center">
            <h4 class="mb-5">Supplier Debit report</h4>
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
                    <th>Supplier</th>
                    <th>Product</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    {{-- <th>Paid</th>
                    <th>Balance</th> --}}
                </tr>
            </thead>
            <tbody>
                @if (count($debits)>0)
                @foreach ($debits as $stock)
                @if (($stock->total - $stock->paid)>0)
                <tr>
                    <td>{{$stock->id}}</td>
                    <td>{{$stock->created_at->format('d/m/Y')}}</td>
                    <td><a href="/suppliers/{{$stock->getsupplier->id}}"> {{$stock->getsupplier->name}}</a></td>
                    <td>{{count($stock->products)}}</td>
                    <td>{{$stock->total}}</td>
                    <td>{{$stock->paid}}</td>
                    <td>{{ $stock->total - $stock->paid}}</td>
                    {{-- <td>{{$stock->paid}}</td> --}}
                    {{-- <td>{{}}</td> --}}
                    
                </tr>
                @endif
                    
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