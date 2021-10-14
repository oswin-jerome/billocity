@extends('layouts/layone')

@section('content')
    <div class="o-card p-4">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="mb-5">Emi Payment report</h4>
            <form action="">
                <div class="d-flex" style="gap: 10px">
                    <div class="form-group">
                        <label for="#">From</label>
                        <input value="{{$from}}" type="date" class="form-control" name="from" id="">
                    </div>
                    <div class="form-group">
                        <label for="#">To</label>
                        <input type="date" value="{{$to}}" class="form-control" name="to" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" value="{{$status}}" class="form-control">
                            <option @if($status =="not_paid") selected @endif value="not_paid">NotPaid</option>
                            <option @if($status =="all") selected @endif value="all">All</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary btn-sm" type="submit">GET</button>
                </div>
            </form>
        </div>

        <table id="table_id" class="display table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Invoice #</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Amount</th></th>
                    <th>Due date</th></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($entries as $key=>$entry)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$entry->emi->invoice_id}}</td>
                    <td>{{$entry->emi->customer->name}}</td>
                    <td>{{$entry->paid_date == null ? "Not paid":"Paid"}}</td>
                    <td>{{$entry->payable}}</td>
                    <td>{{\Carbon\Carbon::parse($entry->date)->format('d-m-Y') }}</td>
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