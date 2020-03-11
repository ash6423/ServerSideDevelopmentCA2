<?php
require_once('database.php');
// Get IDs
$shoe_id = filter_input(INPUT_POST, 'shoe_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
// Delete the shoe from the database
if ($shoe_id != false && $category_id != false) {
    $query = "DELETE FROM shoes
              WHERE shoeID = :shoe_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':shoe_id', $shoe_id);
    $statement->execute();
    $statement->closeCursor();
}
// display the Homepage
include('index.php');
?>