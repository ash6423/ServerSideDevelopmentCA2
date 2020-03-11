<?php
require('database.php');
$shoe_id = filter_input(INPUT_POST, 'shoe_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM shoes
          WHERE shoeID = :shoe_id';
$statement = $db->prepare($query);
$statement->bindValue(':shoe_id', $shoe_id);
$statement->execute();
$shoe = $statement->fetch(PDO::FETCH_ASSOC);
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
        <h1>Edit shoe</h1>
        <form action="edit_shoe.php" method="post" enctype="multipart/form-data"
              id="add_shoe_form">
            <input type="hidden" name="original_image" value="<?php echo $shoe['image']; ?>" />
            <input type="hidden" name="shoe_id"
                   value="<?php echo $shoe['shoeID']; ?>">
            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $shoe['categoryID']; ?>">
            <br>
            <label>Code:</label>
            <input type="input" name="code"
                   value="<?php echo $shoe['code']; ?>">
            <br>
            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $shoe['name']; ?>">
            <br>
            <label>Price:</label>
            <input type="input" name="price"
                   value="<?php echo $shoe['price']; ?>">
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($shoe['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $shoe['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> PHP CRUD, Inc.</p>
    </footer>
</body>
</html>