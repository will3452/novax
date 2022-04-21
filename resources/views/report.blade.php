<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
</head>
<body style="padding:1em">
    <div style="color:#444">
        <h3>Cooperative: {{request()->cooperative}}</h3>
        <h3>Category: {{request()->category}}</h3>
        <h3>Date: {{request()->from}} - {{request()->to}}</h3>
    </div>
    <div style="margin: 10px 0px" >
        <button class="pure-button">Print</button>
    </div>
    @php
        $totalCost = 0;
    @endphp
    <table class="pure-table">
        <thead>
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Store
                </th>
                <th>
                    Product
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Price
                </th>
                <th>
                    Cost
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $r)
            <tr>
                <td>
                    {{$r->created_at}}
                </td>
                <td>
                    {{$r->seller->store_name}}
                </td>
                <td>
                    {{$r->product_name}}
                </td>
                <td>
                    {{$r->order_quantity}}
                </td>
                <td>
                    {{number_format($r->product_price, 2)}}
                </td>
                <td>
                    {{number_format($r->product_price * $r->order_quantity, 2)}}
                    @php
                        $totalCost += ($r->product_price * $r->order_quantity);
                    @endphp
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5">total cost</td>
                <td>
                    {{number_format($totalCost, 2)}}
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
