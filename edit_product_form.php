<?php
require('database.php');

$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM products
          WHERE productID = :product_id';
$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>PHP CRUD</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>PHP CRUD</h1></header>

    <main>
        <h1>Edit Product</h1>
        <form action="edit_product.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <input type="hidden" name="original_product_image" value="<?php echo $product['productImage']; ?>" />
            <input type="hidden" name="product_id"
                   value="<?php echo $product['productID']; ?>">

            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $product['categoryID']; ?>">
            <br>

            <label>Code:</label>
            <input type="input" name="code"
                   value="<?php echo $product['productCode']; ?>">
            <br>

            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $product['productName']; ?>">
            <br>

            <label>List Price:</label>
            <input type="input" name="price"
                   value="<?php echo $product['listPrice']; ?>">
            <br>

            <label>Image:</label>
            <input type="file" name="product_image" accept="image/*" />
            <br>            
            <?php if ($product['productImage'] != "") { ?>
            <p><img src="image_uploads/<?php echo $product['productImage']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> PHP CRUD, Inc.</p>
    </footer>
</body>
</html>