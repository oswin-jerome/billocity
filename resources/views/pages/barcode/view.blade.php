@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="o-card p-4 ">
                <h5 class="card-title">Generate Barcode</h5>
                <div id="divtoprint">
                    <img src="data:image/png;base64, {{DNS1D::getBarcodePNG($code, 'C39')}}" alt="barcode"   />
                </div>
                <button id="print" class="btn btn-primary mt-4">PRINT</button>
            </div>
        </div>
    </div>

    <script defer>
$('#print').on('click',function(){
            PrintElem(document.getElementById("divtoprint"))

        })
        function PrintElem(elem)
        {
            var mywindow = window.open('', 'PRINT');

            mywindow.document.write('<html><head>');
            mywindow.document.write("<link href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\" rel=\"stylesheet\"><link href=\"../css/core.css\" rel=\"stylesheet\"><link href=\"../css/components.css\" rel=\"stylesheet\"><link href=\"../css/icons.css\" rel=\"stylesheet\">")
            mywindow.document.write(`<style>td,th{border-color: rgba(0, 0, 0,0.7) !important;}</style>`)
            mywindow.document.write('</head><body >');
            mywindow.document.write(document.getElementById('divtoprint').innerHTML);
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
