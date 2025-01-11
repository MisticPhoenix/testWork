<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
<h1>Products</h1>

<input type="number" id="product-count" placeholder="Count products" value="<?= $limit; ?>">
<button onclick="limitRows(<?= $limit; ?>)">Add Product</button>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody id="product-table">
    <?php foreach ($products as $product): ?>
        <tr id="product-<?= $product['id'] ?>">
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['quantity']?></td>
            <td>
                <button class="delete-btn" onclick="deleteProduct(<?= $product['id'] ?>)">Delete</button>
            </td>
            <td>
                <button class="delete-btn" onclick="updateProduct()">Update</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>

<input type="hidden" id="product-id" value="<?= !empty($products) ? end($products)['id'] : 0 ?>">
<input type="text" id="product-name" placeholder="Name">
<input type="number" id="product-price" placeholder="Price">
<input type="number" id="product-quantity" placeholder="Quantity">
<input type="number" id="product-visible" pattern="[01]" placeholder="Visible">
<button onclick="storeProduct()">Add Product</button>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../public/js/script.js"></script>
</body>
</html>