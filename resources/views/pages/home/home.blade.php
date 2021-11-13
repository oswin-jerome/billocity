@extends('layouts/layone')

@section('content')


    <div class="row">
        <div class="col-md-6 col-xl-4">
            <a href="" id="rep_today">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Today's Sales</div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>₹ {{ $todaysSales }}</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="" id="rep_profit">

                <div class="card mb-3 widget-content bg-vicious-stance">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Today's Profit</div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>₹ {{ $todaysProfit }}</span></div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-md-6 col-xl-4">
            <a href="" id="rep_stock">
                <div class="card mb-3 widget-content bg-night-sky">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Products Sold Today</div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ $countSold }}</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="" id="rep_sale">
                <div class="card mb-3 widget-content  bg-asteroid ">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Stock added today</div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{$stockAddedToday}}</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="reports/c_credit" id="">
                <div class="card mb-3 widget-content bg-royal">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Customer Credits</div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>₹ {{$credit}}</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="reports/s_debit" id="">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Supplier Debit</div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>₹ {{$debit}}</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="reports/s_debit" id="">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Stock sale value </div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>₹ {{$stockSellingValue}}</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="reports/s_debit" id="">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class=" w-100 widget-content-wrapper text-white d-flex justify-content-between">
                        <div class="widget-content-left">
                            <div class="widget-heading">Stock cost value </div>
                            {{-- <div class="widget-subheading">Last year expenses</div> --}}
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>₹ {{$stockCostValue}}</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 row p-0 m-0">
            <div class=" col-sm-6 col-md-6 col-lg-6 mt-4 ">
                <div class="card pulse" >
                    <h4 class="text-center text-secondary pt-2">Low stock</h4>
                    <div class="scroll-area-md">
                        <div class="scrollbar-container ps--active-y ps">
                            <div class="" >
                                <table class="table m-0">
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
                        <div class="ps__rail-x" style="left: 0px; bottom: -54px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                        </div></div><div class="ps__rail-y" style="top: 54px; height: 300px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 18px; height: 67px;">
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
            <div class=" col-sm-6 col-md-6 col-lg-6 mt-4 ">
                <div class="card pulse" >
                    <h4 class="text-center text-secondary pt-2">Pending Supplier Payment</h4>
                    <div class="scroll-area-md">
                        <div class="scrollbar-container ps--active-y ps">
                            <div class="" >
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
                        <div class="ps__rail-x" style="left: 0px; bottom: -54px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                        </div></div><div class="ps__rail-y" style="top: 54px; height: 300px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 18px; height: 67px;">
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
           
        </div>
        
    </div>

    <script>
        var today = new Date();
        var rep_today = document.getElementById('rep_today');
        rep_today.setAttribute('href',
            `reports/sales?from=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}&to=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}`
            )
        var rep_profit = document.getElementById('rep_profit');
        rep_profit.setAttribute('href',
            `reports/sales?from=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}&to=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}`
            )

        var rep_sale = document.getElementById('rep_sale');
        rep_sale.setAttribute('href',
            `reports/sales?from=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}&to=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}`
            )

        var rep_stock = document.getElementById('rep_stock');
        rep_stock.setAttribute('href',
            `reports/stockin?from=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}&to=${today.getFullYear()}-${pad(today.getMonth()+1,2)}-${pad(today.getDate(),2)}`
            )

        function pad(n, width, z) {
            z = z || '0';
            n = n + '';
            return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
        }

    </script>
@endsection
