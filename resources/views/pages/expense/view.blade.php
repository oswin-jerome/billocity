@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="o-card p-4 ">
                <table id="table_id" class="display table-responsive-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->getcategory->name }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->created_at }}</td>
                                <td class="">
                                    <a href="categories/{{ $expense->id }}" class="btn btn-primary">View</a>
                                    {{-- <form action="" class="m-0 p-0 d-inline"><button
                                            type="submit" class="btn btn-primary">View</button></form>
                                    --}}
                                    {{-- <form action="" class="m-0 p-0 d-inline"><button
                                            type="submit" class="btn btn-warning">Edit</button></form>
                                    --}}
                                    <button data-toggle="modal" data-id={{ $expense->id }} data-category={{ $expense->category }} data-amount={{ $expense->amount }}
                                        id="editMod" data-target="#myModal" class="btn btn-warning">EDIT</button>
                                    <form action="" class="m-0 p-0 d-inline"><button type="submit"
                                            class="btn btn-danger">DELETE</button></form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modbody">
                    <form method="POST" action="{{ route('expenses.update', 1) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="Name">Amount :</label>
                            <input name="amount" id="modamount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Name">Amount :</label>
                            <select name="category" class="form-control selectpickers" id="modcategory" data-live-search="true">
                                <option disabled selected>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="UPDATE" class="btn btn-warning">
                        <input name="pid" id="modid" class="form-control" hidden>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();


            $('#editMod').on('click', function() {
            $('#myModal').appendTo("body").modal('show');

                $('#modamount').val($(this).data('amount'))
                $('#modcategory').val($(this).data('category'))
                $('#modid').val($(this).data('id'))
            })
        });

    </script>
@endsection
