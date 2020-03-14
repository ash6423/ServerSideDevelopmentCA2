
<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}
// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];
// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();
// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
<title>Aislings Shoes</title>
<link rel="stylesheet" type="text/css" href="./sass/main.css">
</head>
<!-- the body section -->
<body>
<header><h1>Aisling's Shoes!!!</h1></header>
<main>
<h1>Record List</h1>
<aside>
<!-- display a list of categories in the sidebar-->
<h2>Brands</h2>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>

<!-- display a table of records from the database -->
<h2><?php echo $category_name; ?><img src="./image_uploads/runningIcon.png" alt="running" height="32" width="32"></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Code</th>
<th>Size</th>
<th>Colour</th>
<th>Stock Quantity</th>
<th>Price</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td><img src="image_uploads/<?php echo $record['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $record['name']; ?></td>
<td><?php echo $record['code']; ?></td>
<td><?php echo $record['size']; ?></td>
<td><?php echo $record['colour']; ?></td>
<td><?php echo $record['stockQuantity']; ?></td>
<td><?php echo $record['price']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_record_form.php">Add New Shoe Record</a></p>
<p><a href="category_list.php">Edit Brands</a></p>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> Aisling's Shoes, Inc.</p>
</footer>
</body>
</html>