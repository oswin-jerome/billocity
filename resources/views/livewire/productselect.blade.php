
<div class="form-group col-sm-12 col-md-4" >
    <label for="">Product Name </label>
    <select  name="product_name" id="product_name" class="form-control selectpickers" data-live-search="true">
        <option selected disabled value="">No product selected</option>
        @foreach ($products as $product)
            <option value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
    </select>
    <button class="btn"  wire:click.prevent="fetch">Refresh</button>
</div>

{{-- <div>
    <h1>{{count($products)}}</h1>
    <button wire:click.prevent="fetch">ref</button>
</div> --}}