@extends('layouts/layone')

@section('content')
    <div class="o-card p-4 mb-3">
        <div class="row">
            <div class="col-3">
                <h6 class="text-primary">Invoice # : <span>{{ $invoice->invoice_no }}</span></h6>
            </div>
            <div class="col-3">
                <h6 class="text-primary">Supplier : <span>{{ $invoice->getsupplier->name }}</span></h6>
            </div>
            <div class="col-3">
                <h6 class="text-primary">Date : <span>{{ $invoice->date }}</span></h6>
            </div>
            <div class="col-3">
                <h6 class="text-primary">Total : <span>{{ $invoice->products->sum('total') }}</span></h6>
            </div>
            <div class="col-3">
                <h6 class="text-primary">Paid : <span>{{ $invoice->paid }}</span></h6>
            </div>
        </div>

        {{-- {{$invoice->products}} --}}

        <table class="table table-striped mt-4 table-responsive-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Total</th>
                    <th scope="col">Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->products as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{ $item->getproduct->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>Rs.{{$item->discount *($item->price)/100}}
                            <small>
                                ({{ $item->discount }} %)
                            </small>
                        </td>
                        <td>{{ $item->total }}</td>
                        <td>@livewire('purchase-qty',['stock'=>$item])</td>
                        <td>
                            <button data-id={{$item->id}} data-price={{$item->total}} data-stock={{$item->stock}} class="btn btn-danger del-btn">RETURN</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>



    </div>
    <div class="o-card p-4 mb-3 d-flex justify-content-between">
        <form method="POST" action="{{ route('purchases.update',$invoice->id)}}" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div id="delete">
                
            </div>
            <input type="submit" class="btn btn-danger" value="Delete">
        </form>

        <h1>Amount to return: <span id="total"></span></h1>
    </div>
    <script>

        var detetedItems = [];
        var total = 0;
        $(document).ready(function(){
            $('.del-btn').on('click',function(){
                // alert($(this).data('id'))
                var qty = prompt("Quantities to return?");
                var stock = $(this).data('stock')
                var price = $(this).data('price')
                $(this).parent().parent().hide()
                var el = `
                <input hidden type="text" name="deleted[]" value=${$(this).data('id')}>
                <input hidden type="text" name="qty[]" value=${qty}>
                `

                $('#delete').append(el);
                total += (price/stock) * qty;
                $('#total').html(total);
            })
        })

    </script>
@endsection
