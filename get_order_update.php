<?php

include 'conf.php';
session_start();

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM notifications WHERE status = 'Unread' AND user_id = '$user_id' ";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    ?>
    <div class="dropdown position-relative pe-1">
        <a class="btn position-relative" href="get_notifications.php" id="notificationDropdown">
            <i class="fa-solid fa-bell p-1" style="color: #ff702d;"></i>
            <span
                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"
                id="notificationDot">
                <span class="visually-hidden"></span>
                <span class="visually-hidden">unread messages</span>
            </span>
        </a>
    </div>
    <?php
} else {
    ?>
    <div class="dropdown position-relative pe-1">
        <a class="btn position-relative" href="get_notifications.php" id="notificationDropdown">
            <i class="fa-solid fa-bell p-2" style="color: #ff702d;"></i>
            <span class="position-absolute top-0 start-100 translate-middle border border-light" id="notificationDot">
                <span class="visually-hidden"></span>
                <span class="visually-hidden">unread messages</span>
            </span>
        </a>
    </div>

    <?php
}

?>