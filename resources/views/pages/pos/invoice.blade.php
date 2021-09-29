@extends('layouts/layone')

@section('content')
    {{-- <link rel="stylesheet" href=""> --}}
    <style>
        #invoice{
            background: #fff;
            padding: 10px;
            margin-bottom: 50px;
        }

        
    </style>


<div class="print">
    <button class="btn btn-primary" id="print">Print</button>
    @if ( $invoice->points_redeem <= 0 &&  $invoice->coupon_redeem <= 0 )
    <a href="/invoices/{{$invoice->id}}/edit" class="btn btn-warning" id="salesreturn">Return Product(s)</a>
    @else
        <p class="alert-danger mt-3 p-2 d-inline">This invoice has redeemed points/coupon thus cannot be returned</p>
    @endif
    {{-- <a href="/invoices/cancel/{{$invoice->id}}" class="btn btn-danger" id="salesreturn">Cancel Bill</a> --}}
    <form method="POST" action="/invoice/cancel" enctype="multipart/form-data" class="d-inline">
        {{ csrf_field() }}
        <input type="text" name="id" value="{{$invoice->id}}" hidden>
        <button class="btn btn-danger" type="submit">Cancel Bill</button>
    </form>
</div>
<br>
    <div id="invoice" class="o-card">
        <div class="col-sm-12 col-md-12 text-right">
            <h5 class="text-primary ml-1">INVOICE #</h5>
            <p class="m-1">{{$invoice->id}}</p>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div class="col-sm-7 col-md-7 ">
                <p class="d-none d-md-block">From</p>
                <h4 class="text-primary ml-1">{{$setting->name}}</h4>
                <pre class="m-1">{{$setting->address}}</pre>
                {{-- <p class="m-1">NEAR STATE BANK OF INDIA</p>
                <p class="m-1">SANKARANKOVIL</p> --}}
                
                <p class="m-1">CELL: {{$setting->phone}}</p>
                <p class="m-1">GST# {{$setting->gst}}</p>
            </div>
            <div class="col-sm-7 col-md-5 text-left">
                @if ($invoice->custo)
                    
                <p>To</p>
                <h4 class="text-primary ml-1">{{$invoice->custo->name}}</h4>
                <p class="m-1">{{$invoice->custo->address}}</p>
                @if ($invoice->custo->gst)
                    
                <p class="m-1">GST# {{$invoice->custo->gst}}</p>
                @endif
                @endif
            </div>
        </div>

        {{-- second --}}
        <div class="d-flex mt-1 mt-md-5 row mx-3">
            <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                <h5 class="d-inline text-primary">Date : </h5>
                <p class="d-inline">{{date('d-M-Y', strtotime($invoice->created_at))}}</p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                <h5 class="d-inline text-primary">Time : </h5>
                <p class="d-inline">{{date('h:i:A', strtotime($invoice->created_at))}}</p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                <h5 class="d-inline text-primary">Mode : </h5>
                <p class="d-inline">{{$invoice->payment_method}}</p>
            </div>
            @if ($invoice->custo)
            <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                <h5 class="d-inline text-primary">Customer : </h5>
                <p class="d-inline">{{$invoice->custo->name}}</p>
            </div>
            @endif
            @if ($invoice->status=="CANCLED")
            <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                <h5 class="d-inline text-primary">Status : </h5>
                <p class="d-inline">Cancled</p>
            </div>
            @endif
        </div>

        {{-- {{$invoice}} --}}
        {{-- Product list --}}
        <table class="table mt-1 mt-md-5 table-striped table-responsive-sm table-condensed" >
            <thead>
              <tr>
                <th scope="col" >#</th>
                <th scope="col">Product</th>
                <th scope="col" class="d-none d-md-block">HSN</th>
                <th scope="col">Price</th>
                <th scope="col">GST</th>
                <th scope="col">Discount</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <?php $totalwg = 0?>
            <tbody>
                @foreach ($invoice->products->whereIn('status',['DONE','CANCLED']) as $key=>$product)

                    
                    <tr >
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$product->prod->name}}</td>
                        <td class="d-none d-md-block">{{$product->prod->hsn_code}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->gst}}%</td>
                        <td></td>
                        <td>{{$product->quantity}}</td>
                        <?php $totalwg += ($product->sold_price * $product->quantity) ?>
                        <td>{{$product->sold_price * $product->quantity}}</td>
                    </tr>
                @endforeach
              
            </tbody>
          </table>
    
    
    
          <div class="row d-flex justify-content-md-end justify-content-sm-start">
              {{-- <div class="col-7"></div> --}}
              <div class="col-7 text-left pr-5">
                <table class="table mr-4 table-rewsponsive-sm">
                    <tbody>
                      <tr>
                        <th scope="row">Total </th>
                        <td>Rs. {{$invoice->total}}</td>
                      </tr>
                      <tr>
                        <th scope="row">GST </th>
                        <td>
                            Rs. {{ ($totalwg*($invoice->products->sum('gst')/$invoice->products->count('gst'))/100)}}
                            <small>({{$invoice->products->whereIn('status',['DONE','CANCLED'])->sum('gst')/$invoice->products->whereIn('status',['DONE','CANCLED'])->count('gst')}} %)</small>
                        </td>
                      </tr>
                      {{-- <tr>
                        <th scope="row">Points Redeemed </th>
                        <td> - {{$invoice->points_redeem}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Coupon </th>
                        <td>{{$invoice->coupon}}</td>
                      </tr> --}}
                      {{-- <tr>
                        <th scope="row">Discount</th>
                        <td> - {{$invoice->points_redeem}}</td>
                      </tr> --}}
                      <tr>
                        <th scope="row">Discount </th>
                        <td>Rs.{{$invoice->discount}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Grand Total </th>
                        <td>{{$invoice->final_price}}</td>
                      </tr>
                      
                    </tbody>
                  </table>
              </div>
          </div>
    
    
    
          <p style="font-style: italic" class="ml-3">Powered by, <span style="font-weight: bold;font-style: normal">IDEAUX Technologies</span></p>

        </div>


    {{-- <div class="print">
        <button class="btn btn-primary" id="print">Print</button>
        <button class="btn btn-warning" id="salesreturn">Return Product(s)</button>
    </div> --}}

    <div class="">
        <div class="o-card p-4 mb-3">
            <table class="table mt-5 table-striped">
                <h4>Returned Products</h4>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ret_products as $key => $product)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $product->prod->name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td></td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->sold_price * $product->quantity }}</td>
                        </tr>
                    @endforeach
    
                </tbody>
            </table>
    
    
    
    
    
        </div>
    </div>

    <script defer>
        // $(document).bind('keydown', 'ctrl + p', printDiv);
        $('#print').on('click',function(){
            PrintElem(document.getElementById("invoice"))

        })
        async function printDiv() {
            document.write('<html><head>');
            document.write("<link href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\" rel=\"stylesheet\"><link href=\"../css/core.css\" rel=\"stylesheet\"><link href=\"../css/components.css\" rel=\"stylesheet\"><link href=\"../css/icons.css\" rel=\"stylesheet\">")
            document.write('</head><body >');
            var printContents = document.getElementById("invoice").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            window.print();

           setTimeout(()=>{
            document.body.innerHTML = originalContents;
           },3000)
        }

        // define a handler
        function doc_keyUp(e) {
            console.log(e.keyCode)
            if (e.ctrlKey && e.keyCode == 32) {
                // printDiv()
                PrintElem(document.getElementById("invoice"))
            }
        }
        // register the handler 
        document.addEventListener('keyup', doc_keyUp, false);


        function PrintElem(elem)
        {
            var mywindow = window.open('', 'PRINT');

            mywindow.document.write('<html><head>');
            mywindow.document.write('<link href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\" rel=\"stylesheet\"><link href=\"../css/core.css\" rel=\"stylesheet\"><link href=\"../css/components.css\" rel=\"stylesheet\"><link href=\"../css/icons.css\" rel=\"stylesheet\">')
            mywindow.document.write(`<style>td,th{border-color: rgba(0, 0, 0,0.7) !important;font-size:0.8em}</style>`)
            mywindow.document.write('</head><body>');
            mywindow.document.write(document.getElementById('invoice').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            $(mywindow).ready(function(){
                mywindow.print();
            // mywindow.close();
            })
            setTimeout(function () {
            // mywindow.print();
            mywindow.close();
            }, 3000)
            return true;
        }
    </script>
@endsection