<!DOCTYPE html>
<html>
<head>
    <title>New Product Created</title>
</head>
<body>
<h1>New Product Created</h1>
<p>A new product has been created:</p>
<ul>
    <li>Name: {{ $product->name }}</li>
    <li>Description: {{ $product->description }}</li>
    <li>Price: ${{ $product->price }}</li>
</ul>
</body>
</html>
