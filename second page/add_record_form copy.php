<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Add a Record</title>
    <link rel="stylesheet" type="text/css" href="./sass/main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>Add a Record</h1></header>

    <main>
        <h1>Add Record</h1>
        <form action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Code:</label>
            <input type="input" name="code" required>
            <br>

            <label>Name:</label>
            <input type="input" name="name" required>
            <br>

            <label>Size:</label>
            <input type="input" name="size" required>
            <br>

            <label>Price:</label>
            <input type="input" name="price" required>
            <br>

            <label>Colour:</label>
            <input type="input" name="colour" required>
            <br>

            <label>Stock Quantity:</label>
            <input type="input" name="stockQuantity" required>
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <label>&nbsp;</label>
            <input type="submit" value="Add Record">
            <br>
        </form>
        <p><a href="index.php">Homepage</a></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Aisling's Shoes, Inc.</p>
    </footer>
</body>
</html>