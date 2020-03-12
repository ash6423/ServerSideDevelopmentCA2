<?php
require('database.php');
$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$record = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Edit a Record</title>
    <link rel="stylesheet" type="text/css" href="./sass/main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>Edit a Record</h1></header>
    <main>
        <h1>Edit record</h1>
        <form action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <input type="hidden" name="original_image" value="<?php echo $record['image']; ?>" />
            <input type="hidden" name="record_id"
                   value="<?php echo $record['recordID']; ?>">
            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $record['categoryID']; ?>">
            <br>
            <label>Code:</label>
            <input type="input" name="code"
                   value="<?php echo $record['code']; ?>">
            <br>
            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $record['name']; ?>">
            <br>
            <label>Size:</label>
            <input type="input" name="size"
                   value="<?php echo $record['size']; ?>">
            <br>
            <label>Colour:</label>
            <input type="input" name="colour"
                   value="<?php echo $record['colour']; ?>">
            <br>
            <label>Stock Quantity:</label>
            <input type="input" name="stockQuantity"
                   value="<?php echo $record['stockQuantity']; ?>">
            <br>
            <label>Price:</label>
            <input type="input" name="price"
                   value="<?php echo $record['price']; ?>">
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($record['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $record['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Aisling's Shoes, Inc.</p>
    </footer>
</body>
</html>