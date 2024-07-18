<?php
include 'conf.php';
session_start();

if ((!isset($_SESSION['unique_id']))) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | Order History</title>
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

    <style>
    </style>
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
    <div class="section-myOrder p-2 mb-1" style="margin-top: 2rem;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-1">
                    <a href="user_order.php" class="btn btn-place-order btn-sm text-white">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <hr>
                </div>
                <div class="col-12 mb-3">
                    <span class="h5 pb-3">Order History</span>
                </div>
                <?php
                $username = $_SESSION['username'];
                $query = "SELECT client_order.order_id, client_order.rider_name, client_order.order_uid, client_order.order_location, client_order.order_detail, client_order.order_payment, client_order.municipality, client_order.barangay, client_order.street, client_order.order_placeTime, client_order.status, client_order.proof, user.user_id, user.username FROM client_order, user WHERE user.user_id = client_order.order_uid AND user.username = '$username' AND client_order.status = 'Delivered'";

                $run = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($run)) {
                    $status = $row['status'];
                    ?>
                    <div class="col-12 mb-3">
                        <div class="box-order p-3" style="height: 100%">
                            <div class="row px-2 py-2 gy-3">
                                <span class="C2WAD-text fw-semibold">Reference No.
                                    <?php echo $row['order_id'] ?>
                                </span>
                                <hr class="mx-2 mb-0">
                                <div class="col-12">
                                    <div class="bg-light p-3 rounded rounded-3">
                                        <span class="h6">Order/Pick Up</span>
                                        <p class="d-block">
                                            <?php echo $row['order_location'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light p-3 rounded rounded-3">
                                        <span class="h6">Order Details</span>
                                        <p class="d-block">
                                            <?php echo $row['order_detail'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light p-3 rounded rounded-3">
                                        <span class="h6">Payment Method</span>
                                        <p class="d-block">
                                            <?php echo $row['order_payment'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light p-3 rounded rounded-3">
                                        <span class="h6">Drop Off</span>
                                        <p class="d-block">
                                            <?php echo $row['street'] . ", " . $row['barangay'] . ", " . $row['municipality'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light p-3 rounded rounded-3">
                                        <span class="h6">Rider</label>
                                        <p class="d-block">
                                            <?php echo $row['rider_name']; ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span class="orderTime text-secondary pb-3">Order Placed:
                                        <?php echo date('F j, Y g:ia', strtotime($row['order_placeTime'])) ?>
                                    </span>
                                </div>
                                <?php
                                $order_id = $row['order_id'];
                                $queryAccepted = "SELECT rider_orderupdate.order_accept_time, rider_orderupdate.order_uid, client_order.order_id FROM rider_orderupdate, client_order WHERE client_order.order_id = '$order_id' AND rider_orderupdate.order_uid = '$order_id' LIMIT 1";
                                $query_run = mysqli_query($con, $queryAccepted);
                                while ($res = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <div class="col-10">
                                        <div class="order-box">
                                            <span class="orderTime text-secondary pb-3">Order Accepted:
                                                <?php echo date('F j, Y g:ia', strtotime($res['order_accept_time'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2 text-end">
                                        <button type="button" class="btn-edit-order" data-bs-toggle="modal"
                                            data-bs-target="#locationModal<?php echo $res['order_id'] ?>">
                                            <i class="fa-solid fa-greater-than me-2 bg-none" style="font-size: 12px"></i>
                                        </button>
                                    </div>
                                    <?php
                                }
                                ?>
                                <button type="button" class="btn btn-place-order btn-sm text-white w-100"
                                    data-bs-toggle="modal" data-bs-target="#receivedOrder?<?php echo $row['order_id'] ?>"><i
                                        class="fa-solid fa-receipt pe-2"></i>Proof of Delivery</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Modal for orders -->
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT client_order.order_id, client_order.order_uid, client_order.order_location, client_order.order_detail, client_order.order_payment, client_order.municipality, client_order.barangay, client_order.street, client_order.order_placeTime, user.user_id, user.username FROM client_order, user WHERE user.user_id = client_order.order_uid AND user.username = '$username'";
    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        ?>
        <div class="modal fade" id="exampleModal<?php echo $row['order_id'] ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="uid" value="<?php echo $row['order_id'] ?>">
                        <div class="row">
                            <div class="col-12 py-1 ">
                                < class="h6">Order/Pick Up</>
                                <input type="text" name="order_location" class="d-block form-control"
                                    value="<?php echo $row['order_location'] ?>" readonly>
                            </div>
                            <div class="col-6 py-1  ">
                                <span class="h6">Order Details</span>
                                <input type="text" name="order_detail" class="d-block form-control"
                                    value="<?php echo $row['order_detail'] ?>" readonly>
                            </div>
                            <div class="col-6 py-1">
                                <span class="h6">Payment Method</span>
                                <select class="form-control" name="payment_method" id="" readonly>
                                    <?php
                                    $currentPayment = $row['order_payment'];
                                    $otherPayment = ($currentPayment === 'GCash') ? 'COD' : 'GCash';
                                    ?>
                                    <option value="<?php echo $currentPayment ?>" selected>
                                        <?php echo $currentPayment ?>
                                    </option>
                                    <option value="<?php echo $otherPayment ?>">
                                        <?php echo $otherPayment ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="col-12 py-1">
                                    <span class="h6">Address</span>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" class="d-block form-control"
                                                value="<?php echo $row['street'] . ", " . $row['barangay'] . ", " . $row['municipality'] ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="updateOrder" class="btn btn-place-order text-white">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $order_id = $row['order_id'];
        $queryAccepted = "SELECT rider_orderupdate.order_accept_time, rider_orderupdate.order_uid, rider_orderupdate.rider_location, rider_orderupdate.location_time, client_order.order_id FROM rider_orderupdate, client_order WHERE client_order.order_id = '$order_id' AND rider_orderupdate.order_uid = '$order_id'";
        $query_run = mysqli_query($con, $queryAccepted);
        while ($res = mysqli_fetch_assoc($query_run)) {
            ?>
            <!-- Modal for updating location -->
            <div class="modal fade" id="locationModal<?php echo $res['order_id'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rider's Location</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row gy-3">
                                <?php
                                $order_id = $row['order_id'];
                                $queryAccepted = "SELECT rider_orderupdate.order_accept_time, rider_orderupdate.order_uid, rider_orderupdate.rider_location, rider_orderupdate.location_time, client_order.order_id FROM rider_orderupdate, client_order WHERE client_order.order_id = '$order_id' AND rider_orderupdate.order_uid = '$order_id' ORDER BY `rider_orderupdate`.`location_time` DESC ";
                                $query_run = mysqli_query($con, $queryAccepted);
                                while ($res = mysqli_fetch_assoc($query_run)) {
                                    ?>  
                                    <div class="col-4">
                                        <div class="rider-location-update" style="font-size: 15px">
                                            <?php echo date('F j', strtotime($res['location_time'])) ?><br>
                                            <?php echo date('h:ia', strtotime($res['location_time'])) ?>
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex flex-column align-items-center justify-content-center">
                                        <div class="track-point"></div>
                                        <div class="track-line"></div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <i class="fa-solid fa-box me-3 h4 pt-2" style="color: #FB5604;"></i>
                                        <div class="track-box-content d-flex align-items-center">
                                            <span class="rider-location">
                                                <?php echo $res['rider_location'] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <!-- Modal for proof of order -->

    <?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM client_order, user WHERE user.username = '$username' AND user.user_id = client_order.order_uid ";
    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        ?>
        <form action="rider_code.php" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="receivedOrder?<?php echo $row['order_id'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Proof of Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if (!empty($row['proof'])): ?>
                                <img src="<?php echo $row['proof']; ?>" alt="Proof Image" class="img-fluid">
                            <?php else: ?>
                                <p>No proof available</p>
                            <?php endif; ?>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>

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
    <script src="">
        function submitRating() {
            let rating = document.querySelector('input[name="rating"]:checked');
            if (rating) {
                let orderId = rating.closest('.modal').id.split('?')[1];
                let value = rating.value;

                alert("Thank you for rating Order " + orderId + " with " + value + " stars!");

                let modal = rating.closest('.modal');
                let bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.hide();
            } else {
                alert("Please select a rating.");
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationDot = document.getElementById('notificationDot');

            notificationDropdown.addEventListener('click', function () {
                notificationDot.style.display = 'none';
            });
        });
    </script>

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
                setTimeout(fetchOrdersPeriodically, 10000);
            }
            fetchOrdersPeriodically();
        });
    </script>
</body>

</html>