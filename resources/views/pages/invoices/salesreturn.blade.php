@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card p-4 mb-3">
                <div class="row">
                    <div class="col-2">
                        <h4 class="text-primary">Invoice # : <span>{{ $invoice->id }}</span></h4>
                    </div>
                </div>
        
        
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Sold price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->products as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{ $item->prod->name }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->sold_price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->sold_price * $item->quantity }}</td>
                                <td>
                                    <button data-id={{$item->id}} data-price={{$item->sold_price}} class="btn btn-danger del-btn">RETURN</button>
                                </td>
                            </tr>
                        @endforeach
        
                    </tbody>
        
                </table>
        
        
        
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card p-4 mb-3 d-flex justify-content-between">
                <form method="POST" action="{{ route('invoices.update',$invoice->id)}}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div id="delete">
                        
                    </div>
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
        
                <h1>Amount to return: <span id="total"></span></h1>
            </div>
        </div>
    </div>
    <script>

        var detetedItems = [];
        var total = 0;
        $(document).ready(function(){
            $('.del-btn').on('click',function(){
                // alert($(this).data('id'))
                var quantity = prompt("Quantities to return");

                var domQty = $(this).parent().parent()[0].querySelector('td:nth-child(5)');
                var domTotal = $(this).parent().parent()[0].querySelector('td:nth-child(6)');
                var domQtyVal = domQty.innerHTML;
                var domTotalVal = domTotal.innerHTML;
                
                domQty.innerHTML = domQtyVal - quantity;
                domTotal.innerHTML = domTotalVal - $(this).data('price') * quantity;
                // $(this).parent().parent().hide()
                var el = `
                <input hidden type="text" name="deleted[]" value=${$(this).data('id')}>
                <input hidden type="text" name="qty[]" value=${quantity}>
                `

                $('#delete').append(el);
                total += $(this).data('price') * quantity;
                $('#total').html(total);
            })
        })

    </script>
@endsection
