@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="o-card p-4 col-12">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Points</th>
                        <th>Credit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            {{$customer->invoices}}
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->points}}</td>
                            <td>{{$customer->credit}}</td>
                            <td class="">
                                <a  href="customers/{{$customer->id}}" type="submit" class="btn btn-primary">View</a>
                                <button data-toggle="modal" data-id="{{$customer->id}}" data-name="{{$customer->name}}" data-phone="{{$customer->phone}}" data-email="{{$customer->email}}" id="editMod" data-target="#myModal" type="submit" class="btn btn-warning">Edit</button>
                                <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-danger" disabled>DELETE</button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MD --}}
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
              <form method="POST" action="{{ route('customers.update',1)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="mod_name" class="form-label">Customer Name</label>
                        <input type="text" name="name" class="form-control" id="mod_name" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-6">
                        <label for="mod_phone" class="form-label">Phone #</label>
                        <input type="text" name="phone" class="form-control" id="mod_phone" >
                    </div>
                    <div class="mb-3 col-sm-12 col-lg-12">
                        <label for="mod_email" class="form-label">Email (optional)</label>
                        <input type="email" name="email" class="form-control" id="mod_email" >
                    </div>
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
        $(document).ready( function () {
    $('#table_id').DataTable();
    $('#editMod').on('click',function(){
        console.log("sdsd")
        $('#mod_name').val($(this).data('name'))
        $('#mod_email').val($(this).data('email'))
        $('#mod_phone').val($(this).data('phone'))
        $('#modid').val($(this).data('id'))
    })
} );
    </script>
@endsection
