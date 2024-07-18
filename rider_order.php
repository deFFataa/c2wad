<?php
include 'conf.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rider | List of Orders</title>
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
            <div class="row">
                <div class="col">
                    <div class="dropdown">
                        <a class="nav-link custom-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-bars ps-3 py-4" style="color: #ff702d;"></i>
                        </a>
                        <ul class="dropdown-menu" style="width: 13.5rem">
                            <li><a class="dropdown-item py-3" href="rider_profile.php">Profile</a></li>
                            <li><a class="dropdown-item py-3" href="rider_order.php">Orders</a></li>
                            <li><a class="dropdown-item py-3" href="#">Chat</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <a href="rider_list_of_orders.php"
                        class="d-flex justify-content-center align-items-center text-decoration-none">
                        <img src="images/capstone/logo.png" alt="" class="img-fluid img-logo-nav">
                        <label class="ms-1 C2WAD-text"><strong>C2WAD</strong></label>
                    </a>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-bell p-3" style="color: #ff702d;"></i>
                    <i class="fa-solid fa-cart-shopping" style="color: #ff702d;"></i>
                </div>
            </div>
        </nav>
    </section>
    <div class="section-myOrder p-2 mb-1" style="margin-top: 2rem;">
        <div class="container-fluid" id="orderContainer">
            <!-- List of orders goes here -->
        </div>
        <?php
        $username = $_SESSION['username'];
        $query = "SELECT * FROM client_order";
        $run = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($run)) {
            ?>

            <?php
        }
        ?>
        <div class="section-footer mb-2">
            <div class="ps-3 d-flex justify-content-start align-items-center h-100">
                <div class="footer-col-80">
                    <img src="images/logo-bw.png" alt="" class="img-fluid img-logo-nav">
                    <label class="ms-1 py-3 C2WAD-text-grey"><strong>C2WAD</strong></label>
                </div>
                <div class="footer-col-20">
                    <i class="fa-brands fa-facebook-f px-2 C2WAD-text-grey"></i>
                    <i class="fa-solid fa-people-group C2WAD-text-grey"></i>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                loadOrders(); // Load orders when the document is ready

                function loadOrders() {
                    // Function to make the Ajax request and load the orders
                    const xhr = new XMLHttpRequest();
                    xhr.open("GET", "get_orders.php", true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Request was successful
                                document.querySelector(".container-fluid").innerHTML = xhr.responseText;
                            } else {
                                // Handle error if needed
                            }
                        }
                    };
                    xhr.send();
                }

                // Use setTimeout instead of setInterval to trigger a new request after the previous one is complete
                function fetchOrdersPeriodically() {
                    loadOrders();
                    setTimeout(fetchOrdersPeriodically, 3000); // Repeat the request after 3 seconds
                }

                fetchOrdersPeriodically(); // Start fetching orders periodically
            });
        </script>
</body>

</html>