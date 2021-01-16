@extends('layouts/layone')

@section('content')
    <div class="o-card p-4">
        <div class="d-flex justify-content-between align-items-center align-self-center">
            <h4 class="mb-5">Expense report</h4>
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
                {{-- <input type="submit" value="GET" class="btn btn-primary">
                --}}
                <button class="btn btn-primary">GET</button>
            </form>
        </div>

        <br><br>

        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Amount</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->id }}</td>
                        <td>{{ $expense->created_at->format('d/m/Y') }}</td>
                        <td>{{ $expense->getcategory->name }}</td>
                        <td>{{ $expense->amount }}</td>
                        {{-- <td class="">
                            <form action="" class="m-0 p-0 d-inline"><button type="submit"
                                    class="btn btn-primary">View</button></form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Total : </th>
                    <th>{{ $expenses->sum('amount') }}</th>
                </tr>

            </tfoot>
        </table>
    </div>
    <script src="/utils.js"></script>
    <script>
        var date = new Date();
        $(document).ready(function() {
            $('#table_id').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', {
                        extend: 'pdf',
                        className:"btn-primary",
                        title: `Billocity - Stock report \n ${date}`,
                        // customize: function(doc) {
                        //     doc.content[1].table.widths =
                        //         Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        // },
                        footer:true
                    }, {
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
