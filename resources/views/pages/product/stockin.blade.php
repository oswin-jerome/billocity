@extends('layouts/layone')

@section('content')
<div class="row">
    <div class="mb-3  pr-2 pl-0 py-1 col-sm-12 col-md-12 col-lg-6">
        <div class="card p-4 ">
            <h4 class="text-primary mb-3">Stock IN</h4>
            <form method="POST" action="/prods/stockin">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="product">Product</label>
                    <select name="product" class="form-control selectpicker" id="product" data-live-search="true" required>
                        <option disabled selected>Select a product</option>
                        @foreach ($products as $product)
                            <option value={{$product->id}} data-price={{$product->price}}>{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" class="form-control selectpicker" id="supplier" data-live-search="true">
                        <option disabled selected>Select a supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value={{$supplier->id}}>{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="stock">Stocks IN</label>
                        <input type="number" name="stock" id="stock" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="amount">Amount Paid</label>
                        <input type="text" name="amount" id="amount" class="form-control">
                    </div>
                </div>
        
                <div class="form-group mt-5 text-center">
                    <input type="submit" class="btn btn-warning" value="UPDATE STOCK">
                </div>
            </form>
        </div>
    </div>
    
    <div class="mb-3 pl-0 pl-lg-3  pr-2 py-1 col-sm-12 col-md-12 col-lg-6">
        <div class="o-card p-4 ">
           <div class="d-flex mt-3">
               <h4 class="text-info">Product Price : </h4>
               <h4 id="d-price"></h4>
           </div>
           <div class="d-flex mt-3">
                <h4 class="text-info">Total : </h4>
                <h4 id="d-total"></h4>
            </div>
            <div class="d-flex mt-3">
                <h4 class="text-info">Amount Paid : </h4>
                <h4 id="d-paid"></h4>
            </div>
            <div class="d-flex mt-3">
                <h4 class="text-info">Balance : </h4>
                <h4 id="d-balance"></h4>
            </div>
        </div>
    </div>
</div>
<script>
    var productPrice = 0;
    var stock = 0;
    var amount = 0;
    $(document).ready(function(){
        $('#product').on('change',function(){
            productPrice = $('#product option:selected').data('price');
            buildChanges()
        })

        $('#stock').on('keyup',function(){
            stock = $('#stock').val()
            buildChanges()
        })
        $('#amount').on('keyup',function(){
            amount = $('#amount').val()
            buildChanges()
        })
    })


    function buildChanges(){
        $('#d-price').html(productPrice);
        $('#d-total').html(`${productPrice} x ${stock} = ${productPrice*stock}`);
        $('#d-paid').html(`${amount}`);
        $('#d-balance').html(`${ (productPrice*stock)-amount }`);
    }

</script>

@endsection