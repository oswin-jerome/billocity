@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-12">
          <div class="card p-4 ">
            <table id="table_id" class="display table-responsive-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->created_at}}</td>
                            <td class="">
                                <a href="brands/{{$brand->id}}" class="btn btn-primary">View</a>
                                {{-- <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-primary">View</button></form> --}}
                                {{-- <form action="" class="m-0 p-0 d-inline"><button type="submit" class="btn btn-warning">Edit</button></form> --}}
                                <button data-toggle="modal" data-id="{{$brand->id}}" data-name="{{$brand->name}}" id="editMod" data-target="#myModal" class="btn btn-warning editMod">EDIT</button>
                                
                                <form action="{{route('brands.destroy',$brand->id)}}" method="POST" class="m-0 p-0 d-inline">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">DELETE</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>


    <div class="modal" id="myModal" style="">
        <div class="modal-dialog">
          <div class="modal-content" style="z-index: 9999;">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Category</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body" id="modbody">
              <form method="POST" action="{{ route('brands.update',1)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                  <div class="form-group">
                      <label for="Name">Name :</label>
                    <input name="name" id="modname" class="form-control">
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

    $('.editMod').on('click',function(){
      $('#myModal').appendTo("body").modal('show');
        $('#modname').val($(this).data('name'))
        $('#modid').val($(this).data('id'))
    })
} );
    </script>
@endsection
