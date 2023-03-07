@extends('layouts/layone')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card p-4 mb-3">
                <form  id="posform" class="row">
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="">Barcode</label>
                        <input autocomplete="off" type="text" name="barcode" id="barcode" class="form-control">
                        <p id="barcode_error" class="text-danger alert"></p>
                    </div>
                    {{-- <div class="form-group col-sm-12 col-md-4">
                        <label for="">Product Name</label>
                        <input autocomplete="off" type="text" name="barcode" id="product_name" class="form-control">
                    </div> --}}
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="">Product Name</label>
                        {{-- <input autocomplete="off" type="text" name="barcode" id="product_name" class="form-control"> --}}
                        <select name="product_name" id="product_name" class="form-control selectpicker" data-live-search="true">
                            <option selected disabled value="">No product selected</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="">Employee name</label>
                        {{-- <input autocomplete="off" type="text" name="barcode" id="product_name" class="form-control"> --}}
                        <select name="user" id="user" class="form-control selectpicker" data-live-search="true">
                            <option selected disabled value="">Default</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}"> {{$user->id}} - {{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-2">
                        <label for="">Quantity</label>
                        <input autocomplete="off" required type="text" name="barcode" id="quantity" class="form-control">
                    </div>
                    
                    <div class="form-group col-sm-6 col-md-2 mt-2">
                        <label for=""></label>
                        <input type="submit" name="barcode" id="submit" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-12">
            <div class="card p-4 mb-3">
                <table id="table_id" class="display table-striped  table-responsive-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Employee ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="list-body">
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                            <td>Row 1 Data 2</td>
                            <td>Row 1 Data 2</td>
                            <td>Row 1 Data 2</td>
                            <td>Row 1 Data 2</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="o-card p-4 mb-0 d-flex justify-content-between">
        <span>
            <p class="m-1">Total: <span id="total"></span></p>
            <div id="customer_point">
                
            </div>
            <h4>Discount : <span id="dis_dis"></span></h4>
            <h3>Grand Total : <span id="grand_total"></span></h3>
            <h4>Balance : <span id="balance"></span></h4>
        </span>
        <form id="posSendData" method="POST" action="{{ route('invoices.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div id="posData">
            </div>
            <div id="billData">
            </div>
            <div id="custData">
                
            </div>

            {{-- <a href="/pos" target="__blank" class="btn btn-warning">New Bill</a> --}}
            <div class="row">
                <div class="form-group">
                    <label for="">Discount :</label>
                    <input type="text" value="0" name="pos_discount" id="pos_discount" class="form-control">
                </div>
                <div class="form-group ml-3">
                    <label for="">Amount recived :</label>
                    <input type="text" name="paid_amount" id="paid_amount" class="form-control">
                </div>
            </div>
            <input type="submit" id="submitInvoice" value="SUBMIT" class="btn btn-primary">
        </form>
    </div>
        </div>
    </div>

    <div class="row">
        <div class=" pr-2 py-3 col-6">
            <div class="card p-4">
                <h4 class="card-title">Customer</h4>
                <div class="form-group col-12">
                    <label for="">Customer Phone #</label>
                    {{-- <input autocomplete="off" type="text" name="barcode" id="product_name" class="form-control"> --}}
    
                    <select name="customer_name_select" id="customer_name_select" class="form-control selectpicker" data-live-search="true">
                        <option selected disabled value="">No customer selected</option>
                        @foreach ($customers as $customer)
                            <option value="{{$customer->phone}}">{{$customer->phone}}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="form-check ml-3 d-none">
                    <input type="checkbox" class="form-check-input" id="redeem_points" disabled>
                    <label class="form-check-label" for="exampleCheck1">Redeem points</label>
                </div>
                <p class="mt-3" id="customer_name"></p>
                
            </div>
        </div>
        <div class=" pl-2 py-3 col-6">
            <div class="card p-4">
                <h4 class="card-title">Cupons</h4>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/underscore@1.12.0/underscore-min.js"></script>
    <script>

        var billables = []
        var currentProd = null;
        var total = 0;
        var modeOfInput = 0;
        var g_customer = null;
        var redeem_points = false;
        var discount = 0;
        $(document).ready(function() {

            // $('#product_name').selectpicker();

            $('#table_id').DataTable({
                searching: false,
                paging: false,
                info: false,
                sorting:false
            });

            buildBillables()

            $('#barcode').keyup(_.debounce(function(){
                modeOfInput = 0;
                $('#barcode_error').html("")
                if($('#barcode').val()!=""){
                    $.get('/api/barcode/'+$('#barcode').val(),function(data,status){
                        if(data.data.length==0){
                            console.log("sd")
                            $('#barcode_error').html("No products found")
                        }else{
                            var prod = data.data[0];
                            if(prod.stock<=0 && prod.type=="product"){
                                reset()
                                return alert("No stock / stock mismatch")
                            }
                            $('#product_name').val(prod.id)
                            $('.selectpicker').selectpicker('refresh');
                            $('#product_name').prop("readonly", true);
                            $("#quantity").focus()
                            currentProd = prod;
                        }
                    })
                }
            } , 300));

            $('#product_name').change(function(){
                modeOfInput = 1;
                // alert($(this).val())
                $('#barcode_error').html("")
                $.get('/api/product/'+$(this).val(),function(data,status){
                        console.log(data.data)
                        
                        if(data.data.length==0){
                            console.log("sd")
                            $('#barcode_error').html("No products found")
                        }else{
                            var prod = data.data[0];
                            if(prod.stock<=0 && prod.type=="product"){
                                reset()
                                return alert("No stock / stock mismatch")
                            }
                            $('#product_name').val(prod.id)
                            $('#barcode').val(prod.barcode)
                            $('#product_name').prop("readonly", true);
                            // $("#quantity").focus()
                            $('#user').data('selectpicker').$button.focus();
                            $('#user').data('selectpicker').$button.click();
                            currentProd = prod;
                        }
                    })
            })

            $('#customer_name_select').change(function(){

                $.get('/api/customer/'+$(this).val(),function(data,status){
                        if(data.data.length==0){
                            console.log("sd")
                            $('#barcode_error').html("No customer found")
                        }else{
                            var customer = data.data[0];
                            $('#customer_name').html(
                                `
                                <p><b>Name :</b> <span>${customer.name}</span></p>
                                <p><b>Credits :</b> <span>${customer.credit}</span></p>
                                `
                            )
                            // <p><b>Points :</b> <span>${customer.points}</span></p>

                            g_customer = customer;

                            buildBillables()
                        }
                    })
            })


            $('#posform').on('submit',function(e){
                e.preventDefault();

                if(currentProd.stock<$('#quantity').val() && currentProd.type=="product"){
                    reset()
                    return alert("Quatity is greater than stock available")
                }

                billables.push({
                    product:currentProd,
                    quantity:$('#quantity').val(),
                    user:$('#user').val(),

                });
                buildBillables()

                reset()

            })
        });

        $('#redeem_points').change(function(){
            // alert($(this).prop('checked'))
            redeem_points = $(this).prop('checked');
            buildBillables()
        })
        $('#paid_amount').keyup(function(){
            buildBillables()
        })

        $('#pos_discount').keyup(function(){
            buildBillables()
        })
        function reset(){
            currentProd = null;
            $('#quantity').val("");
            $('#barcode').val("");
            $('#product_name').val("");
            $('#product_name').prop("readonly", false);
            $('#product_name').selectpicker('refresh');
            $('#barcode_error').html("")
            if(modeOfInput==0){
                $('#barcode').focus()
            }else{
                $('#product_name').data('selectpicker').$button.focus();
                $('#product_name').data('selectpicker').$button.click();
                // $('.selectpicker').selectpicker().data("selectpicker").$searchbox.focus();                
            }


        }


        function buildBillables(){
            $('#list-body').html("")
            $('#billData').html("")
            total = 0;
            g_total = 0;
            $("#total").html(total)

            if(billables.length>0 && $("#paid_amount").val()!=""){
                $('#submitInvoice').prop('disabled', false)
            }else{
                $('#submitInvoice').prop('disabled', true)

            }
            
            

            billables.forEach((item,index)=>{

                var el = `
                <tr>
                    <td>${index+1}</td>
                    <td>${item.product.name}</td>
                    <td>${item.user}</td>
                    <td>${item.quantity}</td>
                    <td>${item.product.price}</td>
                    <td>${item.product.price * item.quantity}</td>
                    <td>
                        <button class="delete-entry btn btn-danger" data-index=${index}>Remove</button>
                    </td>
                </tr>
                `
                total +=item.product.price * item.quantity;
                
                g_total = total;
                // customer point calc
                if(g_customer!=null && g_customer.points < total && redeem_points ){ //Any condition regarding points
                    g_total = total - g_customer.points;
                    $('#customer_point').html(`
                                <p class="m-1">Customer Points: <span>${g_customer.points}</span></p>
                            `)
                }
                else{
                    $('#customer_point').html("")
                }


                // Add form data of customers
                if(g_customer!=null){
                    $('#custData').html(`
                        <input type="text" hidden name="customer" value=${g_customer.id}>
                        <input type="text" hidden name="redeem" value=${redeem_points}>
                    `)
                }



                $('#list-body').append(el)
                $("#total").html(total)
                $("#dis_dis").html($("#pos_discount").val())
                g_total = g_total - $("#pos_discount").val();
                $('#grand_total').html(g_total)
                $('#balance').html(g_total - $('#paid_amount').val())


                var prd = `
                <input type="text" name="products[]" value="${item.product.id}" hidden>
                <input type="text" name="quantities[]" value="${item.quantity}" hidden>
                <input type="text" name="users[]" value="${item.user}" hidden>
                `
                $('#billData').append(prd)
            })

            if(g_customer==null && $("#paid_amount").val() < g_total ){
                $('#submitInvoice').prop('disabled', true)
            }


            // Delete
        $('.delete-entry').on('click',function(){
            // alert($(this).data('index'))
            // billables.pop()
            billables.splice($(this).data('index'), 1);

            buildBillables()
            buildBillables()
        })
        }
    </script>
@endsection








{{-- 


name = "s"
            $('#table_id').DataTable({
                searching: false,
                paging: false,
                info: false
            });

            $('#table_id2').DataTable({
                searching: false,
                paging: false,
                info: false
            });

            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });

            var countries = [
                { value: 'Andorra', data: 'AD' },
                { value: 'Zimbabwe', data: 'ZZ' }
                ];

            $('.s').autocomplete({
                source: countries,
                select: function (suggestion) {
                    alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                }
            });

            $('#posform').on('submit',function(e){
                e.preventDefault()
                var values = $(this).serialize();
                console.log(values)
            }) --}}
