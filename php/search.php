<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT user_id, unique_id, CONCAT(firstName, ' ', lastName) AS `fullName`
    FROM user
    UNION
    SELECT rider_id, unique_id, fullName FROM user_rider
    WHERE NOT unique_id = {$outgoing_id} AND fullName LIKE '%{$searchTerm}%'";

$output = "";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "data.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;
?>