@extends('layouts/layone')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="o-card p-4 ">
                <h5 class="card-title">Generate Barcode</h5>
                <div id="divtoprint">
                    <p>{{$product->name}}</p>
                    <img src="data:image/png;base64, {{DNS1D::getBarcodePNG($product->barcode, 'C39+')}}" alt="barcode"   />
                    <p>{{$product->price}}</p>
                </div>
                {{-- <button id="print" class="btn btn-primary mt-4">PRINT</button> --}}
                <a href="billocity-barcode://copies={{$count}}&code={{$product->barcode}}&label={{$product->name.' '.$product->price}}" class="btn btn-primary">Print</a>
                {{-- <a href="billocity://\{{$count}}\{{$product->name.' '.$product->price}}\{{$product->barcode}}" class="btn btn-primary">Print</a> --}}
            </div>
        </div>
    </div>

@endsection
