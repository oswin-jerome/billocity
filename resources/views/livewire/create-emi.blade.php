<div>
    <form method="POST" action="{{ route('emi.store')}}">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-sm-12 col-md-3">
                <label for="">Customers </label>
                <select  wire:click="selectCustomer($event.target.value)" wire:model="customer" name="customer_id" id="supplier" class="form-control" >
                    <option  selected disabled value="">No customer selected</option>
                    @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="">Invoices </label>
                <select wire:click="selectInvoice($event.target.value)" name="invoice_id" id="supplier" class="form-control" >
                    <option selected disabled value="">No Invoice selected</option>
                    @foreach ($invoices as $invoice)
                        <option value="{{$invoice->id}}">{{$invoice->id}} | {{$invoice->created_at->format('d/M/Y')}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="">Invoice Amount</label>
                <input  wire:model="amount" type="text" class="form-control" name="amount">
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="">DownPayment Amount</label>
                <input wire:model="down_payment" type="text" class="form-control" name="down_payment">
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="">Interval </label>
                <select wire:model="interval" name="interval" id="supplier" class="form-control" >
                    <option  value="monthly">Monthly</option>
                    <option  value="weekly">Weekly</option>
                    <option  value="daily">Daily</option>
                </select>
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="">Period</label>
                <input wire:model="period" type="text" class="form-control" name="period">
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="">InterestRate</label>
                <input wire:model="interest_rate" type="text" class="form-control" name="interest_rate">
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="">Start Date</label>
                <input type="date" class="form-control" name="start_date">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <table wire:loading.remove class="table table-striped">
                    <tbody>
                        <tr>
                            <th>EMI Amount</th>
                            <td>{{$amount - $down_payment}}</td>
                        </tr>
                        <tr>
                            <th>Intrest Rate</th>
                            <td>{{$interest_rate}}%</td>
                        </tr>
                        <tr>
                            <th>Amount per installments</th>
                            @if ($period!=0)
                                
                            <td>{{$totalEmi / $period}}</td>
                            @else
                            <td>NaN</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Amount Payable</th>
                            <td>{{$totalEmi}}</td>
                        </tr>
                        <tr>
                            <th>Intrest</th>
                            <td>{{(($amount - $down_payment) * ($interest_rate / 100))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        {{-- <button wire:click.prevent="calculate" class="btn btn-warning">Calculate</button> --}}
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
