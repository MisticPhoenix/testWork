<?php
    $base_url = "//" . $_SERVER['HTTP_HOST'] . '/public';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class= "container mb-3">
    <h1>Products</h1>
</div>
<div class = "container mb-3">
    <div class="row">
        <div class="col-2">
            <input type="number" class="form-control" id="product-count" placeholder="Count products" value="<?= $limit; ?>">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="limitRows(<?= $limit; ?>)">Add Product</button>
        </div>
    </div>
</div>

<div class = "container mb-3">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col" colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody id="product-table">
        <?php foreach ($products as $product): ?>
                <tr id="product-<?= $product['id'] ?>">
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['quantity'] ?></td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="remove(<?= $product['id'] ?>)">Delete</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" onclick="update()">Update</button>
                    </td>
                </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class = "container mb-3">
    <div class="row">
        <input type="hidden" id="product-id" value="<?= !empty($products) ? end($products)['id'] : 0 ?>">
        <div class="col-2">
            <input type="text" class="form-control" id="product-name" placeholder="Name">
        </div>
        <div class="col-2">
            <input type="number" class="form-control" id="product-price" placeholder="Price">
        </div>
        <div class="col-2">
            <input type="number" class="form-control" id="product-quantity" placeholder="Quantity">
        </div>
        <div class="col-2">
            <input type="number" class="form-control" id="product-visible" pattern="[01]" placeholder="Visible">
        </div>
        <button class="btn btn-success col-2" onclick="store()">Add Product</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="<?php echo $base_url; ?>/js/productScript.js"></script>
</body>
</html>