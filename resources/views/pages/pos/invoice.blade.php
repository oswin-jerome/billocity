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

    <div id="invoice">
        <div class="d-flex justify-content-between">
            <div class="col-sm-12 col-md-6 ">
                <h4 class="text-primary ml-1">STORE NAME</h4>
                <p class="m-1">1561 some tower</p>
                <p class="m-1">Any street</p>
                <p class="m-1">India</p>
            </div>
            <div class="col-sm-12 col-md-6 text-right">
                <h5 class="text-primary ml-1">INVOICE #</h5>
                <p class="m-1">{{$invoice->id}}</p>
            </div>
        </div>

        {{-- second --}}
        <div class="d-flex mt-5">
            <div class="col-sm-6 col-md-3 ">
                <h5 class="d-inline text-primary">Date : </h5>
                <p class="d-inline">{{date('d-M-Y', strtotime($invoice->created_at))}}</p>
            </div>
            <div class="col-sm-6 col-md-3 ">
                <h5 class="d-inline text-primary">Time : </h5>
                <p class="d-inline">{{date('h:i:A', strtotime($invoice->created_at))}}</p>
            </div>
            <div class="col-sm-6 col-md-3 ">
                <h5 class="d-inline text-primary">Mode : </h5>
                <p class="d-inline">{{$invoice->payment_method}}</p>
            </div>
            @if ($invoice->custo)
            <div class="col-sm-6 col-md-3 ">
                <h5 class="d-inline text-primary">Customer : </h5>
                <p class="d-inline">{{$invoice->custo->name}}</p>
            </div>
            @endif
        </div>

        {{-- {{$invoice}} --}}
        {{-- Product list --}}
        <table class="table mt-5 table-striped">
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
                @foreach ($invoice->products as $key=>$product)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$product->prod->name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td></td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->sold_price * $product->quantity}}</td>
                    </tr>
                @endforeach
              
            </tbody>
          </table>
    
    
    
          <div class="row d-flexjustify-content-between">
              <div class="col-7"></div>
              <div class="col-5 text-right pr-5">
                <table class="table mr-4">
                    <tbody>
                      <tr>
                        <th scope="row">Total </th>
                        <td>{{$invoice->total}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Points Redeemed </th>
                        <td> - {{$invoice->points_redeem}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Coupon </th>
                        <td>{{$invoice->coupon}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Grand Total </th>
                        <td>{{$invoice->final_price}}</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
          </div>
    
    
    
    

        </div>


    <div class="print">
        <button class="btn btn-primary" id="print">Print</button>
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
           },500)
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



        // PrintElem(document.getElementById("invoice"))
        function PrintElem(elem)
        {
            var mywindow = window.open('', 'PRINT');

            mywindow.document.write('<html><head>');
            mywindow.document.write("<link href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\" rel=\"stylesheet\"><link href=\"../css/core.css\" rel=\"stylesheet\"><link href=\"../css/components.css\" rel=\"stylesheet\"><link href=\"../css/icons.css\" rel=\"stylesheet\">")
            mywindow.document.write('</head><body >');
            mywindow.document.write(document.getElementById('invoice').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/


            setTimeout(function () {
            mywindow.print();
            mywindow.close();
            }, 500)
            return true;
        }
    </script>
@endsection