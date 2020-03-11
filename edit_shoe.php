<?php
// Get the data
$shoe_id = filter_input(INPUT_POST, 'shoe_id', FILTER_VALIDATE_INT);
$brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
// Validate inputs
if ($shoe_id == NULL || $shoe_id == FALSE || $brand_id == NULL ||
$brand_id == FALSE || empty($code) || empty($name) ||
$price == NULL || $price == FALSE) {
$error = "Invalid data. Check all fields and try again.";
include('error.php');
} else {
// Image upload
$imgFile = $_FILES['image']['name'];
$tmp_dir = $_FILES['image']['tmp_name'];
$imgSize = $_FILES['image']['size'];
$original_image = filter_input(INPUT_POST, 'original_image');
if ($imgFile) {
$upload_dir = 'image_uploads/'; // upload directory	
$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$image = rand(1000, 1000000) . "." . $imgExt;
if (in_array($imgExt, $valid_extensions)) {
if ($imgSize < 5000000) {
if (filter_input(INPUT_POST, 'original_image') !== "") {
unlink($upload_dir . $original_image);                    
}
move_uploaded_file($tmp_dir, $upload_dir . $image);
} else {
$errMSG = "Sorry, your file is too large it should be less then 5MB";
}
} else {
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
} else {
// If no image selected the old image remain as it is.
$image = $original_image; // old image from database
}
// End Image upload

// If valid, update the shoes in the database
require_once('database.php');
$query = 'UPDATE shoes
SET categoryID = :brand_id,
code = :code,
name = :name,
price = :price,
image = :image
WHERE shoeID = :shoe_id';
$statement = $db->prepare($query);
$statement->bindValue(':brand_id', $brand_id);
$statement->bindValue(':code', $code);
$statement->bindValue(':name', $name);
$statement->bindValue(':price', $price);
$statement->bindValue(':image', $image);
$statement->bindValue(':shoe_id', $shoe_id);
$statement->execute();
$statement->closeCursor();
// Display the index page
include('index.php');
}
?>