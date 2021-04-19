@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
            
                <h5 class="card-title">Edit Product</h5>
                <form method="POST" action="{{ route('products.update',$product->id)}}" >
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label for="name">Product Name</label>
                            <input required type="text" name="name" class="form-control" id="name" value="{{$product->name}}">
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="barcode">Barcode</label>
                            <input required type="text" name="barcode" class="form-control" id="barcode" value="{{$product->barcode}}">
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="hsn_code">HSN Code</label>
                            <input required type="text" name="hsn_code" class="form-control" id="hsn_code" value="{{$product->hsn_code}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label for="brand">Brand</label>
                            <select name="brand" class="form-control selectpicker" id="brand" data-live-search="true">
                                <option disabled selected>Select a brand</option>
                                @foreach ($brands as $brand)
                                    <option @if ($brand->id == $product->brand)
                                        selected
                                    @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label for="barcode">Category</label>
                            <select name="category" class="form-control selectpicker" id="category" data-live-search="true">
                                <option disabled selected>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option @if ($category->id == $product->category)
                                        selected
                                    @endif value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label for="barcode">Product Type:</label>
                            <select name="type" class="form-control selectpicker" id="type" data-live-search="true">
                                {{-- <option disabled selected>Select a Category</option> --}}
                                <option @if ($product->type == "product")
                                    selected
                                @endif value="product">Product</option>
                                <option @if ($product->type == "service")
                                    selected
                                @endif value="service">Service</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="CostPrice">Cost Price</label>
                            <small>(Per unit)</small>
                            <input required type="text" class="form-control" id="CostPrice"  value="{{$product->cost_price}}">
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="CostPrice">Cost Price</label>
                            <small>(with GST)</small>
                            <input tabindex="998" readonly required type="text" name="cost_price" class="form-control" id="CostPrice_ro">
                        </div>                
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="price">Selling Price</label>
                            <small>(Per unit)</small>
                            <input required type="text" class="form-control" id="price"  value="{{$product->price}}">
                            <small>Type % to calculate</small>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="price">Selling Price</label>
                            <small>(with GST)</small>
                            <input tabindex="999" readonly required type="text" name="price" class="form-control" id="price_ro">
                            <small id="er1"></small>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="gst">GST</label>
                            <input required type="number" name="gst" class="form-control" id="gst"  value="{{$product->gst}}">
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-3">
                            <label for="stock">Stock</label>
                            <input disabled required value="0" type="text" name="stock" class="form-control" id="stock">
                            <small>add stock in "stock in"</small>
                        </div>
                        
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked value="" id="gst_chk">
                        <label class="form-check-label" for="gst_chk">
                          I'm entering price with GST
                        </label>
                    </div>
    
                    <input type="submit" value="UPDATE" class="btn btn-info px-5 mt-4">
                </form>
            </div>
        </div>
    </div>
    <script>
        // $(document).ready(function() {
        //     $('select').select2();
        // });

        //         <select class="selectpicker" multiple data-live-search="true">
        //   <option>Mustard</option>
        //   <option>Ketchup</option>
        //   <option>Relish</option>
        // </select>

        var costPrice = 0;
        var costPriceGst = 0;
        var sellingPrice = 0;
        var sellingPriceGst = 0;
        var gst = 0;
        var enteringWithoutGst = true;
        var percentEntered = false;
        var percent = 0;
        $(document).ready(()=>{
            buildUi();
            $('#CostPrice').on('keyup',function(){
                buildUi()
            })
            $('#price').on('keyup',function(){
                buildUi()
            })
            $('#gst').on('keyup',function(){
                buildUi()
            })
            $('#gst_chk').on('click',function(){
                buildUi()
            })
            $('#price').on('keyup',function(e){
                if(e.key==='%'){
                    console.log("🔥",e.key)
                    let th = $(this).val();
                    th = parseFloat( th.replace('%',''))
                    percent = th;
                    let cost = parseFloat($('#CostPrice').val());
                    let n = (th/100) * cost;

                    $(this).val((cost + n).toFixed(2))
                    percentEntered = true;
                    $('#er1').html('<p class="alert alert-danger p-2 m-1">GST will not affect this field</p>')
                    buildUi();
                }
            })
        })

        


        function buildUi(){

            costPrice = parseFloat( $('#CostPrice').val());
            costPriceGst =parseFloat( $('#CostPrice_ro').val());
            sellingPrice = parseFloat($('#price').val());
            sellingPriceGst = parseFloat($('#price_ro').val());
            gst = parseFloat($('#gst').val());
            enteringWithoutGst = $("#gst_chk").is(':checked');

            if(!enteringWithoutGst){
                costPriceGst = costPrice +( costPrice * gst /100);
                if(!percentEntered){ //Only when % is not entered
                    sellingPriceGst = sellingPrice +( sellingPrice * gst /100);
                }else{
                sellingPriceGst = sellingPrice;
                }

                
                // set values to fields
                $('#CostPrice_ro').val(costPriceGst)
                $('#price_ro').val(sellingPriceGst)
                
            }else{
                costPriceGst = costPrice ;
                sellingPriceGst = sellingPrice;

                
                // set values to fields
                $('#CostPrice_ro').val(costPriceGst)
                $('#price_ro').val(sellingPriceGst)
            }
            
        }


        

    </script>
@endsection
