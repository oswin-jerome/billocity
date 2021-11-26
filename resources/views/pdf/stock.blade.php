<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        table, td, th {  
          border: 1px solid #ddd;
          text-align: left;
        }
        
        table {
          border-collapse: collapse;
          width: 100%;
        }
        
        th, td {
          padding: 8px;
          font-size: 12px;
        }
        </style>
        <style>
            .page-break {
                page-break-after: always;
            }
            </style>
            
</head>
<body>
    <h3>Stock Report - <span>@php echo(now()->format("d-m-Y")) @endphp</span></h3>
    <table>
        <thead>
            <tr style="background-color: rgb(157, 191, 255);">
                <th>Stock selling value</th>
                <th>Stock cost value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>@money($stockSellingValue)</td>
                <td>@money($stockCostValue)</td>
            </tr>
        </tbody>
    </table>
    
    <table>
        <table id="table_id" style="margin-top: 50px" class="display">
            <thead>
            <tr>
                <td><img width="30px" src="https://logos-world.net/wp-content/uploads/2020/12/Lays-Logo.png"/></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
                <tr style="background-color: rgb(157, 191, 255);">
                    <th>#</th>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key=>$product)
                    {{-- @if ($key % 10 == 1)
                    @endif
                    <div class="page-break"></div> --}}
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->getbrand->name}}</td>
                        <td>{{$product->getcategory->name}}</td>
                        <td>@money($product->price)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </table>
</body>
</html>