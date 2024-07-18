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
                        <a href="rider_my_order_history.php" class="btn btn-place-order btn-sm text-white">Delivery
                            Reports</a>
                        <hr>
                    </div>
                    <div class="col-12 mb-3">
                        <span class="h5 pb-3">My Orders</span>
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
                    user_rider.fullName, 
                    user_rider.rider_id 
                FROM 
                    client_order, user_rider 
                WHERE 
                    (client_order.status = 'Accepted') 
                    AND 
                    client_order.rider_name = '$fullName' AND user_rider.fullName = '$fullName' ";

                    $run = mysqli_query($con, $query);

                    if (mysqli_num_rows($run) == 0) {
                        ?>
                        <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 69vh">
                            <span class="h6 pb-3">Your active order will display here.</span>
                        </div>
                        <?php
                    } else {
                        while ($row = mysqli_fetch_assoc($run)) {
                            if (empty($row['proof'])) {
                                $order_uid = $row['order_uid'];
                                ?>

                                <form action="rider_code.php" method="POST">
                                    <div class="col-12">
                                        <div class="box-order p-3 mb-3" style="height: 100%">
                                            <div class="row gy-3">
                                                <span class="C2WAD-text fw-semibold">Reference No.
                                                    <?php echo $row['order_id'] ?>
                                                </span>
                                                <div class="my-0">
                                                    <hr class="mb-0">
                                                </div>
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
                                                            <div class="d-block">
                                                                None
                                                            </div>
                                                        <?php endif; ?>
                                                        <input type="hidden" name="landmark"
                                                            value="<?php echo $row['landmark']; ?>">
                                                    </div>
                                                </div>
                                                <?php
                                                $username = $_SESSION['username'];

                                                $getUniqueId = "SELECT unique_id FROM user WHERE user_id = '$order_uid'";
                                                $resUniqueId = mysqli_query($con, $getUniqueId);
                                                if (mysqli_num_rows($resUniqueId) > 0) {
                                                    $rowUI = mysqli_fetch_assoc($resUniqueId);
                                                    $unique_id = $rowUI['unique_id'];
                                                }

                                                $query_rider = "SELECT client_order.order_id, client_order.order_uid, user.unique_id AS client_unique_id, user_rider.username FROM user, client_order, user_rider WHERE client_order.order_uid = user.user_id AND user_rider.username = '$username' AND user.unique_id = '$unique_id'";
                                                $query_run = mysqli_query($con, $query_rider);

                                                if ($rider = mysqli_fetch_assoc($query_run)) {
                                                    ?>
                                                    <div class="col-6">
                                                        <a href="chat_rider.php?user_id=<?php echo $rider['client_unique_id']; ?>"
                                                            class="btn btn-sm btn-place-order text-white">
                                                            <i class="fa-solid fa-message me-2"></i>Chat Client
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="col-10">
                                                    <span class="orderTime text-secondary pb-3">Order Placed:
                                                        <?php echo date('F j, Y g:ia', strtotime($row['order_placeTime'])) ?>
                                                    </span>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal<?php echo $row['order_id'] ?>"
                                                        style="margin: 0; padding: 0;">
                                                        <i class="fa-solid fa-greater-than"></i>
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-place-order btn-sm text-white w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#receivedOrder?<?php echo $row['order_id'] ?>"><i
                                                            class="fa-solid fa-check pe-2"></i>Complete</button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-terminate-order btn-sm text-white w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#cancelOrder?<?php echo $row['order_id'] ?>"><i
                                                            class="fa-solid fa-xmark pe-2"></i>Cancel</button>
                                                </div>
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

    <?php
    if (isset($_SESSION['fullName'])) {

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
        user_rider.fullName, 
        user_rider.rider_id 
    FROM 
        client_order, user_rider 
    WHERE 
        (client_order.status = 'Accepted' OR client_order.status = 'Delivered' OR client_order.status = 'Pending') 
        AND 
        client_order.rider_name = '$fullName' AND user_rider.fullName = '$fullName'";
        $run = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($run)) {
            $orderID = $row["order_id"];
            ?>
            <!-- Modal for my orders -->
            <form action="rider_code.php" method="post">
                <div class="modal fade" id="exampleModal<?php echo $row['order_id'] ?>" tabindex="-1"
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
                                    <div class="col-12">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                        <input type="hidden" name="client_id" value="<?php echo $row['order_uid'] ?>">
                                        <select name="locationName" class="form-control" required>
                                            <option value="" selected disabled>--Select--</option>
                                            <option value="Arrived at Location">Arrived at Location</option>
                                            <option value="Out for Delivery">Out for Delivery</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <?php
                                $getLoc = "SELECT * FROM rider_orderupdate WHERE order_uid = '$orderID' ORDER BY location_time DESC";
                                $resLoc = mysqli_query($con, $getLoc);

                                while ($rowLoc = mysqli_fetch_assoc($resLoc)) {
                                    ?>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="rider-location-update">
                                                <?php echo date('M j', strtotime($rowLoc['location_time'])) ?><br>
                                                <?php echo date('h:ia', strtotime($rowLoc['location_time'])) ?>
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
                                                    <?php echo $rowLoc['rider_location'] ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
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
    $username = $_SESSION['username'];
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
    user_rider.fullName, 
    user_rider.rider_id 
FROM 
    client_order, user_rider 
WHERE 
    (client_order.status = 'Accepted' OR client_order.status = 'Delivered' OR client_order.status = 'Pending') 
    AND 
    client_order.rider_name = '$fullName' AND user_rider.fullName = '$fullName'";
    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        ?>
        <form action="rider_code.php" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="receivedOrder?<?php echo $row['order_id'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Proof</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                Proof of Order
                            </div>
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <input type="file" class="form-control" name="proof">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="uploadProof" class="btn btn-place-order text-white">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>

    <!-- Modal for cancelling order -->
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
        user_rider.fullName, 
        user_rider.rider_id 
    FROM 
        client_order, user_rider 
    WHERE 
        (client_order.status = 'Accepted' OR client_order.status = 'Delivered' OR client_order.status = 'Pending') 
        AND 
        client_order.rider_name = '$fullName' AND user_rider.fullName = '$fullName'";
    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        ?>
        <form action="rider_code.php" method="POST">
            <div class="modal fade" id="cancelOrder?<?php echo $row['order_id'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Terminate</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                    <span>Reason for Cancelling Order:</span>
                                    <select name="reasonCancel" id="" class="form-control w-100">
                                        <option value="" disabled selected>-- Select --</option>
                                        <option value="Unavailable Order">Unavailable Order</option>
                                        <option value="Closed Establishment">Closed Establishment</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="terminateOrder" class="btn btn-terminate-order text-white">Cancel
                                Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>

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