@extends('layouts/layone')

@section('content')
    <div class="o-card p-4">
        <h4 class="mb-5">Emi report</h4>

        <table id="table_id" class="display table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Invoice #</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Interval</th>
                    <th>Amount</th>
                    <th>Monthly Due</th>
                    <th>Closing date</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($emis as $key=>$emi)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$emi->invoice_id}}</td>
                <td>{{$emi->customer->name}}</td>
                <td>
                    @if (count($emi->emi_entries()->where("paid_date","<>",null)->get()) == count($emi->emi_entries))
                        Closed
                    @else
                        Pending
                    @endif
                </td>
                <td>{{$emi->interval}}</td>
                <td>sds</td>
                <td>Montdly Due</td>
                <td>Closing date</td>
            </tr>
              @endforeach
            </tbody>
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
                    title: `<h1>Emi report</h1><p>${date}</p>`,
                    
                }
        ]
        });
    });
    </script>
@endsection