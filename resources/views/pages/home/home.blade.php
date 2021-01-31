@extends('layouts/layone')

@section('content')

<style>
    .het{
        min-height: 120px;
        max-height: 120px;
    }

    .het h4{
        /* white-space: nowrap; */
        /* overflow: hidden; */
    }
    /* width */
    .customhandle::-webkit-scrollbar {
    width: 10px;
    
    }

    /* Track */
    .customhandle::-webkit-scrollbar-track {
    background: #f1f1f1;
    }

    /* Handle */
    .customhandle::-webkit-scrollbar-thumb {
    background: rgba(86, 131, 255, 0.322);
    border-radius: 5px;
    }

    /* Handle on hover */
    .customhandle::-webkit-scrollbar-thumb:hover {
    background: #555;
    }

    .pulse{
        animation: anim 1s infinite alternate;
    }
    @keyframes anim{
        0%{
            box-shadow: 3px 3px 12px rgba(255, 28, 28, 0.335);
            transform: scale(0.999)
        },
        100%{
            transform: scale(1)

            box-shadow: 3px 9px 12px rgba(0, 0, 0, 0.335);
        }
    }

</style>
<div class="row">
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-4">
        <div class="o-card het">
            <h4 class="text-center text-secondary">Today's Sales</h4>
            <h3 class="text-center text-primary mt-4">{{$todaysSales}}</h3>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-4">
        <div class="o-card het">
            <h4 class="text-center text-secondary">Today's Profit</h4>
            <h3 class="text-center text-primary mt-4">₹{{$todaysProfit}}</h3>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-4">
        <div class="o-card het">
            <h4 class="text-center text-secondary">Products Sold Today</h4>
            <h3 class="text-center text-primary mt-4">{{$countSold}}</h3>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-4">
        <div class="o-card het">
            <h4 class="text-center text-secondary">Stock added today</h4>
            <h3 class="text-center text-primary mt-4">{{$stockAddedToday}}</h3>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-4">
        <div class="o-card het">
            <h4 class="text-center text-secondary">Customer Credits</h4>
            <h3 class="text-center text-primary mt-4">₹{{$credit}}</h3>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-4">
        <div class="o-card het">
            <h4 class="text-center text-secondary">Supplier Debit</h4>
            <h3 class="text-center text-primary mt-4">₹{{$debit}}</h3>
        </div>
    </div>

    <div class="col-12 row p-0 m-0">
        <div class="o-cards col-sm-6 col-md-6 col-lg-6 mt-4 ">
            <div class="o-card pulse" >
                <h4 class="text-center text-secondary">Low stock</h4>
                
                <div class="list customhandle" style="height: 300px;overflow-y: scroll" >
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Stock</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          
                          @foreach ($lowstocks as $key => $item)
                          <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->getbrand->name}}</td>
                            <td>{{$item->stock}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    
                </div>
            </div>
        </div>
        <div class="o-cards col-sm-6 col-md-6 col-lg-6 mt-4 ">
            <div class="o-card pulse" >
                <h4 class="text-center text-secondary">Pending Supplier Payment</h4>
                
                <div class="list customhandle" style="height: 300px;overflow-y: scroll" >
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice #</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{-- <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr> --}}
                          
                          @foreach ($pendingsupplier as $key => $item)
                          <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->invoice_no}}</td>
                            <td>
                                <a href="suppliers/{{$item->getsupplier->id}}">{{$item->getsupplier->name}}</a>
                            </td>
                            <td>{{$item->total - $item->paid}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection