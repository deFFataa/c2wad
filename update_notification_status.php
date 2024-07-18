<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $user_id = $con->real_escape_string($user_id);

    $notification_sqlRead = "UPDATE notifications SET status = 'Read' WHERE user_id = '$user_id'";
    $notification_result = $con->query($notification_sqlRead);
}
?>
