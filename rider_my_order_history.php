<?php
include 'conf.php';
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['unique_id']) && !isset($_SESSION['fullName'])) {
    header("Location: rider_login.php");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rider | My Orders</title>
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
        <div class="container-fluid" id="orderContainer">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mb-1">
                        <a href="rider_my_order.php" class="btn btn-place-order btn-sm text-white"><i
                                class="fa-solid fa-arrow-left"></i>
                        </a>
                        <hr>
                    </div>
                    <div class="col-12">
                        <span class="h5 pb-3">Delivery Reports</span>
                    </div>
                    <?php
                    $fullName = $_SESSION['fullName'];
                    $query = "SELECT 
                    client_order.order_id, 
                    client_order.order_uid, 
                    client_order.client_name, 
                    client_order.phoneNumber, 
                    client_order.order_location, 
                    client_order.order_detail, 
                    client_order.order_payment, 
                    client_order.municipality, 
                    client_order.barangay, 
                    client_order.street, 
                    client_order.landmark, 
                    client_order.order_placeTime, 
                    client_order.proof,
                    client_order.status,
                    client_order.reason,
                    user_rider.fullName, 
                    user_rider.rider_id
                FROM 
                    client_order, user_rider 
                WHERE 
                    (client_order.status = 'Delivered' OR client_order.status = 'Cancelled' OR client_order.status = 'Accepted') 
                    AND 
                    client_order.rider_name = '$fullName' AND user_rider.fullName = '$fullName' ORDER BY client_order.order_id DESC";

                    $run = mysqli_query($con, $query);

                    if (mysqli_num_rows($run) === 0) {
                        ?>
                        <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 50vh">
                            <span class="h5 pb-3">No Orders</span>
                        </div>
                        <?php
                    } else {
                        while ($row = mysqli_fetch_assoc($run)) {
                            if (!empty($row['proof']) or !empty($row['reason'])) {
                                ?>

                                <form action="rider_code.php" method="POST">
                                    <div class="col-12">
                                        <div class="box-order p-3 mb-3" style="height: 100%">
                                            <div class="row gy-3">
                                                <span class="C2WAD-text fw-semibold">Reference No.
                                                    <?php echo $row['order_id'] ?>
                                                </span>
                                                <hr class="mx-2 mb-0">
                                                <div class="col-6">
                                                    <div class="bg-light p-2 rounded rounded-2">
                                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                                        <input type="hidden" name="riderName"
                                                            value="<?php echo $row['fullName'] ?>">
                                                        <span class="h6">Name</span>
                                                        <p class="d-block">
                                                            <?php echo $row['client_name'] ?>
                                                        </p>
                                                        <input type="hidden" name="clientName"
                                                            value="<?php echo $row['client_name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="bg-light p-2 rounded rounded-2">
                                                        <span class="h6">Phone</span>
                                                        <p class="d-block">
                                                            <?php echo $row['phoneNumber'] ?>
                                                        </p>
                                                        <input type="hidden" name="CP" value="<?php echo $row['phoneNumber'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="bg-light p-2 rounded rounded-2">
                                                        <span class="h6">Order/Pick Up</span>
                                                        <p class="d-block">
                                                            <?php echo $row['order_location'] ?>
                                                        </p>
                                                        <input type="hidden" name="order_loc"
                                                            value="<?php echo $row['order_location'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="bg-light p-2 rounded rounded-2">
                                                        <span class="h6">Order Details</span>
                                                        <p class="d-block">
                                                            <?php echo $row['order_detail'] ?>
                                                        </p>
                                                        <input type="hidden" name="order_detail"
                                                            value="<?php echo $row['order_detail'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="bg-light p-2 rounded rounded-2">
                                                        <span class="h6">Payment Method</span>
                                                        <p class="d-block">
                                                            <?php echo $row['order_payment'] ?>
                                                        </p>
                                                        <input type="hidden" name="order_payment"
                                                            value="<?php echo $row['order_payment'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="bg-light p-2 rounded rounded-2">
                                                        <span class="h6">Drop Off</span>
                                                        <p class="d-block">
                                                            <?php echo $row['street'] . ", " . $row['barangay'] . ", " . $row['municipality'] ?>
                                                        </p>
                                                        <input type="hidden" name="street" value="<?php echo $row['street'] ?>">
                                                        <input type="hidden" name="barangay" value="<?php echo $row['barangay'] ?>">
                                                        <input type="hidden" name="municipality"
                                                            value="<?php echo $row['municipality'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="bg-light p-2 rounded rounded-2">
                                                        <span class="h6">Landmark</span>
                                                        <?php if (!empty($row['landmark'])): ?>
                                                            <p class="d-block">
                                                                <?php echo $row['landmark']; ?>
                                                            </p>
                                                        <?php else: ?>
                                                            <p class="d-block">
                                                                None
                                                            </p>
                                                        <?php endif; ?>
                                                        <input type="hidden" name="landmark"
                                                            value="<?php echo $row['landmark']; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-10">
                                                    <span class="orderTime text-secondary pb-3">Order Placed:
                                                        <?php echo date('F j, Y g:ia', strtotime($row['order_placeTime'])) ?>
                                                    </span>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#viewModal<?php echo $row['order_id'] ?>"
                                                        style="margin: 0; padding: 0;">
                                                        <i class="fa-solid fa-greater-than"></i>
                                                    </button>
                                                </div>
                                                <?php
                                                if (!empty($row['proof'])) {
                                                    $order_id = $row['order_id'];
                                                    ?>
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn-place-order btn-sm text-white w-100"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#receivedOrder?<?php echo $row['order_id'] ?>"><i
                                                                class="fa-solid fa-receipt pe-2"></i>Proof of Delivery</button>
                                                    </div>
                                                    <?php
                                                } else if (!empty($row['reason'])) {
                                                    ?>
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-terminate-order btn-sm text-white w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#cancelledOrder?<?php echo $row['order_id'] ?>"><i
                                                                    class="fa-solid fa-receipt pe-2"></i>Order Cancelled</button>
                                                        </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }

                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    $query1 = "SELECT client_order.order_id FROM client_order";
    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        $order_id = $row['order_id'];

        $query = "SELECT rider_orderupdate.order_accept_time, rider_orderupdate.order_uid, rider_orderupdate.rider_location, rider_orderupdate.location_time, client_order.order_id FROM rider_orderupdate, client_order WHERE client_order.order_id = '$order_id' AND rider_orderupdate.order_uid = '$order_id'";
        $runOuter = mysqli_query($con, $query);
        while ($rowOuter = mysqli_fetch_assoc($runOuter)) {
            ?>
            <!-- Modal for my orders -->
            <form action="rider_code.php" method="post">
                <div class="modal fade" id="viewModal<?php echo $row['order_id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Location
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <?php
                                    $order_id = $rowOuter['order_id'];
                                    $query2 = "SELECT rider_orderupdate.order_accept_time, rider_orderupdate.order_uid, rider_orderupdate.rider_location, rider_orderupdate.location_time, client_order.order_id FROM rider_orderupdate, client_order WHERE client_order.order_id = '$order_id' AND rider_orderupdate.order_uid = '$order_id' ORDER BY `rider_orderupdate`.`location_time` DESC ";
                                    $runInner = mysqli_query($con, $query2);

                                    while ($rowInner = mysqli_fetch_assoc($runInner)) {
                                        ?>
                                        <div class="col-4">
                                            <div class="rider-location-update" style="font-size: 15px">
                                                <?php echo date('F j', strtotime($rowInner['location_time'])) ?><br>
                                                <?php echo date('h:ia', strtotime($rowInner['location_time'])) ?>
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
                                                    <?php echo $rowInner['rider_location'] ?>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="updateLocation" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php
        }
    }
    ?>



    <!-- Modal for complete order -->

    <?php
    $fullName = $_SESSION['fullName'];
    $query = "SELECT * FROM client_order WHERE rider_name = '$fullName'";
    $run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($run)) {
        ?>
        <form action="rider_code.php" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="receivedOrder?<?php echo $row['order_id'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Proof of Delivery</h1>
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

    <!-- Modal for unsuccessful delivery order -->

    <?php
    $username = $_SESSION['username'];
    $query = "SELECT client_order.order_id, client_order.order_uid, client_order.client_name, client_order.phoneNumber, client_order.order_location, client_order.order_location, client_order.order_detail, client_order.order_payment, client_order.municipality, client_order.barangay, client_order.street, client_order.landmark, client_order.order_placeTime, client_order.proof, client_order.reason, user_rider.fullName, user_rider.rider_id FROM client_order, user_rider WHERE client_order.status = 'Delivered' OR client_order.status = 'Cancelled' AND user_rider.username = '$username'";
    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        ?>
        <form action="rider_code.php" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="cancelledOrder?<?php echo $row['order_id'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reason for Cancellation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <span>
                                        <?php echo $row['reason'] ?>
                                    </span>
                                </div>
                            </div>
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
                        } else {
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
</body>

</html>