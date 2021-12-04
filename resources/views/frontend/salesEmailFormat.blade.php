<!DOCTYPE html>
<html>
<head>
</head>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
<p>
    Dear, {{$userName}}
</p>
<p>
    Greetings from <a href="Under-Garments.Xyz">Under-Garments.Xyz.</a> Hope you are well!!
</p>
<h4> Your order transaction ID: {{$tx_id}}</h4>
<h4> Your marketing list are following. Please check.</h4>
<table style="width:100%">
    <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    @foreach($data as  $products)
    <tr>
        <td>{{$products->name}}</td>
        <td>{{$products->quantity. $products->unit}}</td>
        <td>{{$products->discount_price}}</td>
    </tr>
    @endforeach
</table>

<p>Best Regards, </p>
<p>Under-Garments.Xyz </p>
</body>
</html>
