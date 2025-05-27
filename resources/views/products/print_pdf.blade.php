<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .product-image {
            max-width: 50px;
            /* Adjust size as needed */
            max-height: 50px;
            display: block;
            /* Helps with alignment if needed */
            margin: auto;
            /* Center image if desired */
        }

        .user-avatar {
            position: absolute;
            top: 10px;
            right: 10px;
            max-width: 60px;
            /* Adjust size as needed */
            max-height: 60px;
            border-radius: 50%;
            /* Optional: make it circular */
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <h1>Product List</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock->quantity_stock ?? 0 }}</td>
                <td>{{ $product->supplier->first_name }} {{ $product->supplier->last_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>