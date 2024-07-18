<?php
include 'conf.php';
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['fullName'])) {
    header("Location: rider_login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rider | List of Orders</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    </style>
</head>

<body>
    <section class="nav-section">
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
                                <li><a class="dropdown-item py-3" href="rider_profile.php">Profile</a></li>
                                <li><a class="dropdown-item py-3" href="rider_my_order.php">My Orders</a></li>
                                <li><a class="dropdown-item py-3" href="rider_list_of_orders.php">List Orders</a></li>
                                <li><a class="dropdown-item py-3" href="users_rider.php">Chat</a></li>
                                <hr>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center text-decoration-none">
                        <a href="rider_list_of_orders.php"
                            class="d-flex justify-content-center align-items-center text-decoration-none">
                            <img src="images/Capstone/logo.png" alt="" class="img-fluid img-logo-nav">
                            <div class="ms-1 C2WAD-text"><strong>C2WAD</strong></div>
                        </a>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center me-1" id="nav-section">

                    </div>
                </div>
            </div>
        </nav>
    </section>
    <div class="section-myOrder p-2 mb-1" style="margin-top: 2rem;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="h5 pb-3 fw-bold" style="color: #FB5604">List of Orders</div>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="orderContainer">

            <!-- List of orders goes here -->
        </div>

        <div class="text-center">
            <button id="loadMoreButton" class="btn btn-sm btn-accept-order text-white text py-2" style="width: 50%">Load More</button>
        </div>

    </div>
    <div class="section-footer mb-2" style="position: static">
        <div class="d-flex align-items-center px-3 py-2">
            <div class="me-auto">
                <img src="images/logo-bw.png" alt="" class="img-fluid img-logo-nav">
                <label class="C2WAD-text-grey"><strong>C2WAD</strong></label>
            </div>
            <div>
                <a href="https://www.facebook.com/profile.php?id=100064153805135" target="_blank">
                    <i class="fa-brands fa-facebook-f px-2 C2WAD-text-grey"></i>
                </a>
                <a href="https://www.facebook.com/groups/227421291921529" target="_blank">
                    <i class="fa-solid fa-people-group px-2 C2WAD-text-grey"></i>
                </a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadOrders();

            function loadOrders() {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "get_orders.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.querySelector("#orderContainer").innerHTML = xhr.responseText;
                        }
                    }
                };
                xhr.send();
            }

            function fetchOrdersPeriodically() {
                loadOrders();
                setTimeout(fetchOrdersPeriodically, 10000);
            }

            fetchOrdersPeriodically();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadNewNotif();
            function loadNewNotif() {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "get_upcoming_order_count.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.querySelector("#nav-section").innerHTML = xhr.responseText;
                        }
                    }
                };
                xhr.send();
            }
            function fetchOrdersPeriodically() {
                loadNewNotif();
                setTimeout(fetchOrdersPeriodically, 10000);
            }
            fetchOrdersPeriodically();
        });
    </script>

    <script>
        let limit = 3;

        document.addEventListener("DOMContentLoaded", function () {
            loadOrders();

            // Function to load orders
            function loadOrders() {
                const xhr = new XMLHttpRequest();
                // Pass the limit as a parameter
                xhr.open("GET", `get_orders.php?limit=${limit}`, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Replace existing orders with the new ones
                            document.querySelector("#orderContainer").innerHTML = xhr.responseText;
                            // Update the order count periodically
                            fetchOrdersCount();
                        }
                    }
                };
                xhr.send();
            }

            document.getElementById("loadMoreButton").addEventListener("click", function () {
                limit += 3;
                loadOrders();
            });
        });
    </script>


</body>

</html>