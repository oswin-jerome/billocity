@extends('layouts/layone')

@section('content')

    <div class="o-card p-4 mb-3">
        <form  id="posform" class="row">
            <div class="row col-12">
                <div class="form-group col-sm-12 col-md-3">
                    <label for="">Invoice #</label>
                    <input autocomplete="off" type="text" name="invoice_no" id="invoice_no" class="form-control">
                    <p id="barcode_error" class="text-danger alert"></p>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="">Invoice Date</label>
                    <input autocomplete="off" type="date" name="invoice_date" id="invoice_date" class="form-control">
                    <p id="barcode_error" class="text-danger alert"></p>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="">Reference #</label>
                    <input autocomplete="off" type="text" name="ref_no" id="ref_no" class="form-control">
                    <p id="barcode_error" class="text-danger alert"></p>
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="">Supplier</label>
                    {{-- <input autocomplete="off" type="text" name="barcode" id="product_name" class="form-control"> --}}
    
                    <select name="supplier" id="supplier" class="form-control selectpicker" data-live-search="true">
                        <option selected disabled value="">No supplier selected</option>
                        @foreach ($suppliers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <livewire:productselect /> 
            <div class="form-group col-sm-12 col-md-2">
                <label for="">Discount <small>(in %)</small></label>
                <input autocomplete="off" required type="text" value="0" name="discount" id="discount" class="form-control">
            </div>
            <div class="form-group col-sm-12 col-md-2">
                <label for="">Quantity</label>
                <input autocomplete="off" required type="text" name="" id="quantity" class="form-control">
            </div>
            <div class="form-group col-sm-6 col-md-2 mt-2">
                <label for=""></label>
                <input type="submit" name="barcode" id="submit" class="form-control">
            </div>
        </form>
    </div>




    <div class="o-card p-4 mb-3">
        <table id="table_id" class="display table-striped  table-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>HSN</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>value</th>
                    <th>discount</th>
                    <th>Amount</th>
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
                    <td>Row 1 Data 2</td>
                    <td>Row 1 Data 2</td>
                </tr>
            </tbody>
        </table>
    </div>



    <div class="o-card p-4 mb-0 d-block d-md-flex justify-content-between">
        <span>
            <h4 class="m-1">Total: <span id="total"></span></h4>
            <div id="customer_point">
                
            </div>
            {{-- <h4>Discount : <span id="dis_dis"></span></h4> --}}
            {{-- <h3>Grand Total : <span id="grand_total"></span></h3> --}}
            <h4>Balance : <span id="balance"></span></h4>
        </span>
        <form id="posSendData" method="POST" action="{{ route('purchases.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div id="posData">
            </div>
            <div id="billData">
            </div>
            <div id="custData">
                
            </div>

            {{-- <a href="/pos" target="__blank" class="btn btn-warning">New Bill</a> --}}
            <div class="row">
                <div class="form-group ml-3">
                    <label for="">Amount Paid :</label>
                    <input type="text" name="paid_amount" id="paid_amount" class="form-control">
                </div>
            </div>
            <input type="submit" id="submitInvoice" value="SUBMIT" class="btn btn-primary">
        </form>
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
        var totalDiscount = 0;
        $(document).ready(function() {

            $('#product_name').selectpicker();

            $('#table_id').DataTable({
                searching: false,
                paging: false,
                info: false,
                sorting:false
            });

            buildBillables()

            // $('#barcode').keyup(_.debounce(function(){
            //     modeOfInput = 0;
            //     $('#barcode_error').html("")
            //     if($('#barcode').val()!=""){
            //         $.get('/api/barcode/'+$('#barcode').val(),function(data,status){
            //             if(data.data.length==0){
            //                 console.log("sd")
            //                 $('#barcode_error').html("No products found")
            //             }else{
            //                 var prod = data.data[0];
            //                 if(prod.stock<=0){
            //                     reset()
            //                     return alert("No stock / stock mismatch")
            //                 }
            //                 $('#product_name').val(prod.id)
            //                 $('.selectpicker').selectpicker('refresh');
            //                 $('#product_name').prop("readonly", true);
            //                 $("#quantity").focus()
            //                 currentProd = prod;
            //             }
            //         })
            //     }
            // } , 300));

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
                            // if(prod.stock<=0){
                            //     reset()
                            //     return alert("No stock / stock mismatch")
                            // }
                            $('#product_name').val(prod.id)
                            $('#barcode').val(prod.barcode)
                            $('#product_name').prop("readonly", true);
                            $("#discount").focus()
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

                // if(currentProd.stock<$('#quantity').val()){
                //     reset()
                //     return alert("Quatity is greater than stock available")
                // }

                billables.push({
                    product:currentProd,
                    quantity:$('#quantity').val(),
                    discount:$('#discount').val(),

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
            $('#discount').val("0");
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
            totalDiscount = 0;
            $("#total").html(total)

            if(billables.length>0 && $("#paid_amount").val()!=""){
                $('#submitInvoice').prop('disabled', false)
            }else{
                $('#submitInvoice').prop('disabled', true)

            }
            

            billables.forEach((item,index)=>{
                console.log(item.product,"sd")
                var dis =parseFloat(item.discount * (item.product.cost_price * item.quantity)/100).toFixed(2)
                var el = `
                <tr>
                    <td>${index+1}</td>
                    <td>${item.product.name}</td>
                    <td>${item.product.hsn_code}</td>
                    <td>${item.quantity}</td>
                    <td>${item.product.cost_price}</td>
                    <td>${(item.product.cost_price * item.quantity).toFixed(2)}</td>
                    <td>${dis} <small>(${item.discount}%)</small> </td>
                    <td>${((item.product.cost_price * item.quantity)-dis).toFixed(2)}</td>
                    <td>
                        <button class="delete-entry btn btn-danger" data-index=${index}>Remove</button>
                    </td>
                </tr>
                `
                total +=((item.product.cost_price * item.quantity) - dis);
                
                g_total = total;
                // customer point calc
                // if(g_customer!=null && g_customer.points < total && redeem_points ){ //Any condition regarding points
                //     g_total = total - g_customer.points;
                //     $('#customer_point').html(`
                //                 <p class="m-1">Customer Points: <span>${g_customer.points}</span></p>
                //             `)
                // }
                // else{
                //     $('#customer_point').html("")
                // }


                // Add form data of customers
                // if(g_customer!=null){
                //     $('#custData').html(`
                //         <input type="text" hidden name="customer" value=${g_customer.id}>
                //         <input type="text" hidden name="redeem" value=${redeem_points}>
                //     `)
                // }



                $('#list-body').append(el)
                $("#total").html(total.toFixed(2))
                // $("#dis_dis").html($("#pos_discount").val())
                // g_total = g_total - $("#pos_discount").val();
                // $('#grand_total').html(g_total)
                $('#balance').html((total - $('#paid_amount').val()).toFixed(2))


                var prd = `
                <input type="text" name="products[]" value="${item.product.id}" hidden>
                <input type="text" name="quantities[]" value="${item.quantity}" hidden>
                <input type="text" name="discount_per[]" value="${item.discount}" hidden>
                <input type="text" name="final_price[]" value="${((item.product.cost_price * item.quantity)- dis).toFixed(2)}" hidden>
                `
                $('#billData').append(prd)
            })


            // Delete
        $('.delete-entry').on('click',function(){
            // alert($(this).data('index'))
            // billables.pop()
            billables.splice($(this).data('index'), 1);

            buildBillables()
            buildBillables()
        })
        }


        $('#invoice_no').keyup(function(){
            buildPosData();
        })
        $('#ref_no').keyup(function(){
            buildPosData();
        })

        $('#invoice_date').change(function(){
            buildPosData();
        })

        $('#supplier').change(function(){
            buildPosData();
        })




        function buildPosData(){
            $('#posData').html(`
                <input type="text" hidden required name="invoice_no" value="${$('#invoice_no').val()}" />
                <input type="text" hidden required name="ref_no" value="${$('#ref_no').val()}" />
                <input type="text" hidden required name="invoice_date" value="${$('#invoice_date').val()}" />
                <input type="text" hidden required name="supplier" value="${$('#supplier').val()}" />
            `)
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
