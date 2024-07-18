<?php

include 'conf.php';
session_start();

$user_id = $_SESSION['user_id'];
$user_id = $con->real_escape_string($user_id);

$notification_sqlRead = "UPDATE notifications SET status = 'Read' WHERE user_id = '$user_id'";
$notification_result = $con->query($notification_sqlRead);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | Notifications</title>
    <link rel="icon" type="image/x-icon" href="images/Capstone/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/user.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="nav-section" id="nav-home">
        <nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="dropdown">
                            <a class="nav-link custom-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-bars ps-3 py-4" style="color: #ff702d;"></i>
                            </a>
                            <ul class="dropdown-menu" style="width: 13.5rem">
                                <li><a class="dropdown-item py-3" href="user_profile.php">Profile</a></li>
                                <li><a class="dropdown-item py-3" href="user_order.php">Orders</a></li>
                                <li><a class="dropdown-item py-3" href="users_client.php">Chat</a></li>
                                <hr>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center text-decoration-none">
                        <a href="user_home.php"
                            class="d-flex justify-content-center align-items-center text-decoration-none">
                            <img src="images/Capstone/logo.png" alt="" class="img-fluid img-logo-nav">
                            <div class="ms-1 C2WAD-text"><strong>C2WAD</strong></div>
                        </a>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center me-1">
                        <div id="bellNotif">

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <div class="section-3 p-2 mb-1 mt-4">
        <div class="profile-box">
            <div class="container mt-3">
                <div class="row">
                    <p class="h5 mt-2" style="color: #ff702d;"> Notifications</p>
                    <?php
                    $user_id = $_SESSION['user_id'];

                    $notification_sql = "SELECT * FROM notifications WHERE status = 'Read' AND user_id = '$user_id' ORDER BY id DESC LIMIT 10";
                    $notification_result = $con->query($notification_sql);

                    if ($notification_result->num_rows > 0) {
                        while ($row = $notification_result->fetch_assoc()) {
                            $notification_content = $row['content'];
                            $order_id = $row['order_id'];
                            ?>
                            <div class="col-12 mt-2">
                                <div style="border: solid 1px #e28a1e;" class="p-3">
                                    <span class="d-block ms-2" style="font-size: 14px; font-weight: bold;">Reference #
                                        <?php echo $row['order_id'] ?>
                                    </span>
                                    <a href="user_order.php" class="m-2" style="font-size: 12px; color: #e28a1e;">
                                        <?php echo $notification_content ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-12 mt-3">
                            <p class="ms-2" style="font-size: 13px; color: #fff;">No new Notifications</p>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="mt-3">
                        <div class="text-center">
                            <a href="get_all_notifications.php" class="btn btn-link C2WAD-text "
                                style="text-decoration: underline !important">View All <i
                                    class="fa fa-solid fa-arrow-right"
                                    style="text-decoration: underline !important"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadNewNotifhome();
            function loadNewNotifhome() {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "get_order_update.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.querySelector("#bellNotif").innerHTML = xhr.responseText;
                        } else {
                        }
                    }
                };
                xhr.send();
            }
            function fetchOrdersPeriodically() {
                loadNewNotifhome();
                setTimeout(fetchOrdersPeriodically, 3000);
            }
            fetchOrdersPeriodically();
        });

        document.addEventListener("DOMContentLoaded", function () {
            function updateNotificationStatus() {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "update_notification_status.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                        }
                    }
                };
                xhr.send();
            }

            const links = document.querySelectorAll("a");
            links.forEach(link => {
                link.addEventListener("click", updateNotificationStatus);
            });
        });
    </script
</body>

</html>