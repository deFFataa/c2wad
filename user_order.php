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
    <title>User | Orders</title>
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

    <div class="section-myOrder p-2 mb-1" style="margin-top: 2rem;">
        <div class="container-fluid">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mb-1">
                        <a href="user_order_history.php" class="btn btn-place-order btn-sm text-white">Order History</a>
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="h5 pb-3">My Orders</div>
                    </div>
                    <div id="orderContainer">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for orders -->
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT client_order.order_id, client_order.landmark, client_order.order_uid, client_order.order_location, client_order.order_detail, client_order.order_payment, client_order.municipality, client_order.barangay, client_order.street, client_order.order_placeTime, user.user_id, user.username FROM client_order, user WHERE user.user_id = client_order.order_uid AND user.username = '$username'";
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
                        <form action="signUpUser.php" method="POST">
                            <input type="hidden" name="uid" value="<?php echo $row['order_id'] ?>">
                            <div class="row">
                                <div class="col-12 py-1 ">
                                    <label class="h6">Order/Pick Up</label>
                                    <input type="text" name="order_location" class="d-block form-control"
                                        value="<?php echo $row['order_location'] ?>">
                                </div>
                                <div class="col-6 py-1  ">
                                    <label class="h6">Order Details</label>
                                    <input type="text" name="order_detail" class="d-block form-control"
                                        value="<?php echo $row['order_detail'] ?>">
                                </div>
                                <div class="col-6 py-1">
                                    <label class="h6">Payment Method</label>
                                    <select class="form-control" name="payment_method" id="">
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
                                    <div class="col-12 py-1 ">
                                        <span class="h6">Address</span>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="text" name="street" class="d-block form-control"
                                                    value="<?php echo $row['street'] ?>">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="barangay" class="d-block form-control"
                                                    value="<?php echo $row['barangay'] ?>">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="municipality" class="d-block form-control"
                                                    value="<?php echo $row['municipality'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here"
                                            id="floatingTextarea">
                                                            <?php echo $row['landmark'] ?>
                                                            </textarea>
                                        <label for="floatingTextarea">Landmark</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="updateOrder" class="btn btn-place-order text-white">Save
                                    changes</button>
                            </div>
                        </form>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rider's Status</h1>
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
                                        <div class="rider-location-update">
                                            <?php echo date('M j', strtotime($res['location_time'])) ?><br>
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
                                            <label class="rider-location">
                                                <?php echo $res['rider_location'] ?>
                                            </label>
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
            </div>
            </div>
            <?php
        }
    }
    ?>

    <!--Modal for receiving orders-->
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT client_order.order_id, client_order.order_uid, client_order.order_location, client_order.order_detail, client_order.order_payment, client_order.municipality, client_order.barangay, client_order.street, client_order.order_placeTime, client_order.status, user.user_id, user.username FROM client_order, user WHERE user.user_id = client_order.order_uid AND user.username = '$username' AND client_order.status = 'Accepted'";

    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        ?>
        <form action="signUpUser.php" method="POST">
            <div class="modal fade" id="exampleModal_<?php echo $row['order_id'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Rate the service:</p>
                            <div class="rating">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                <input type="radio" name="rating_<?php echo $row['order_id'] ?>"
                                    id="star5_<?php echo $row['order_id'] ?>" value="5">
                                <label for="star5_<?php echo $row['order_id'] ?>"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating_<?php echo $row['order_id'] ?>"
                                    id="star4_<?php echo $row['order_id'] ?>" value="4">
                                <label for="star4_<?php echo $row['order_id'] ?>"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating_<?php echo $row['order_id'] ?>"
                                    id="star3_<?php echo $row['order_id'] ?>" value="3">
                                <label for="star3_<?php echo $row['order_id'] ?>"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating_<?php echo $row['order_id'] ?>"
                                    id="star2_<?php echo $row['order_id'] ?>" value="2">
                                <label for="star2_<?php echo $row['order_id'] ?>"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating_<?php echo $row['order_id'] ?>"
                                    id="star1_<?php echo $row['order_id'] ?>" value="1">
                                <label for="star1_<?php echo $row['order_id'] ?>"><i class="fas fa-star"></i></label>
                            </div>
                        </div>
                        <div class="px-3">
                            <div class="form-floating">
                                <textarea class="form-control" name="rating_comment" placeholder="Leave a comment here" id="floatingTextarea2"
                                    style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Comments</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="receivedOrder" class="btn btn-place-order text-white">Send
                                Rating</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>

    <?php
    $username = $_SESSION['username'];
    $cancelOrder = "SELECT * FROM client_order";
    $runCancel = mysqli_query($con, $cancelOrder);
    while ($row = mysqli_fetch_assoc($runCancel)) {
        ?>
        <!-- Modal for cancelling orders -->
        <div class="modal fade" id="cancelOrder_<?php echo $row['order_id'] ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <form action="signUpUser.php" method="POST">
                            <input type="hidden" name="uid" value="<?php echo $row['order_id'] ?>">
                            <i class="fa-solid fa-circle-exclamation text-secondary h1"></i>
                            <div class="my-3">Do you really want to cancel this order?</div>
                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="cancelOrder" class="btn btn-danger btn-sm">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
        document.addEventListener("DOMContentLoaded", function () {
            loadOrders();

            function loadOrders() {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "get_user_order.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.querySelector("#orderContainer").innerHTML = xhr.responseText;
                        } else {
                        }
                    }
                };
                xhr.send();
            }

            function fetchOrdersPeriodically() {
                loadOrders();
                setTimeout(fetchOrdersPeriodically, 3000);
            }

            fetchOrdersPeriodically();
        });
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