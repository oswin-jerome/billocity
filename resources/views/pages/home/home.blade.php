@extends('layouts/layone')

@section('content')
<div class="row">
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-3">
        <div class="o-card">
            <h4 class="text-center text-secondary">Today's Sales</h4>
            <h1 class="text-center text-primary mt-4">{{$todaysSales}}</h1>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-3">
        <div class="o-card">
            <h4 class="text-center text-secondary">Today's Profit</h4>
            <h1 class="text-center text-primary mt-4">Rs.{{$todaysProfit}}</h1>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-3">
        <div class="o-card">
            <h4 class="text-center text-secondary">Products Sold Today</h4>
            <h1 class="text-center text-primary mt-4">{{$countSold}}</h1>
        </div>
    </div>
    <div class="o-cards col-sm-6 col-md-6 col-lg-3 mt-3">
        <div class="o-card">
            <h4 class="text-center text-secondary">Stock added today</h4>
            <h1 class="text-center text-primary mt-4">{{$stockAddedToday}}</h1>
        </div>
    </div>
    
</div>
@endsection