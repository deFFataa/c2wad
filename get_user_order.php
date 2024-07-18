<?php
include 'conf.php';
session_start();

$username = $_SESSION['username'];
$query = "SELECT client_order.order_id, client_order.order_uid, client_order.client_rating, client_order.order_location, client_order.order_detail, client_order.order_payment, client_order.municipality, client_order.barangay, client_order.street, client_order.landmark, client_order.order_placeTime, client_order.status, user.user_id, user.username FROM client_order, user WHERE user.user_id = client_order.order_uid AND user.username = '$username' AND (client_order.status != 'Delivered' AND client_order.client_rating IS NULL AND client_order.status != 'Cancelled')";

$run = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($run)) {
    ?>
    <?php
    $status = $row['status'];
    ?>
    <div class="col-12  mb-3">
        <div class="box-order p-2" style="height: 100%">
            <div class="row px-3 py-2 gy-3">
                <span class="C2WAD-text fw-semibold">Reference No.
                    <?php echo $row['order_id'] ?>
                </span>
                <hr class="mx-2 mb-0">
                <div class="row g-2">
                    <div class="col-12">
                        <div class="bg-light p-3 rounded rounded-3">
                            <div class="h6">Order/Pick Up</div>
                            <div class="">
                                <?php echo $row['order_location'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-2">
                        <div class="bg-light p-3 rounded rounded-3">
                            <div class="h6">Order Details</div>
                            <div class="">
                                <?php echo $row['order_detail'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-2">
                        <div class="bg-light p-3 rounded rounded-3">
                            <div class="h6">Payment Method</div>
                            <div class="">
                                <?php echo $row['order_payment'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-2">
                        <div class="bg-light p-3 rounded rounded-3">
                            <div class="h6">Drop Off</div>
                            <div class="">
                                <?php echo $row['street'] . ", " . $row['barangay'] . ", " . $row['municipality'] ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($status === "Pending") {
                        ?>
                        <div class="col-6 p-2">
                            <div class="bg-light p-3 rounded rounded-3">
                                <div class="h6">Rider</div>
                                <div class="d-block">
                                    --
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        $order_id = $row['order_id'];
                        $query_rider = "SELECT client_order.order_uid, client_order.order_id, client_order.rider_name, user.user_id, user.unique_id, user_rider.unique_id AS rider_unique_id FROM client_order INNER JOIN user ON client_order.order_uid = user.user_id LEFT JOIN user_rider ON client_order.rider_name = user_rider.fullName WHERE (client_order.status = 'Accepted' OR client_order.status = 'Cancelled') AND client_order.order_id = '$order_id'";
                        $query_run = mysqli_query($con, $query_rider);

                        if ($rider = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <div class="col-6 p-2">
                                <div class="bg-light p-3 rounded rounded-3">
                                    <div class="h6">Rider</div>
                                    <div class="d-block">
                                        <?php echo $rider['rider_name']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                    }
                    ?>
                    <div class="col-12 p-2">
                        <div class="bg-light p-3 rounded rounded-3">
                            <div class="h6">Landmark</div>
                            <?php if (!empty($row['landmark'])): ?>
                                <div class="d-block">
                                    <?php echo $row['landmark']; ?>
                                </div>
                            <?php else: ?>
                                <div class="d-block">
                                    None
                                </div>
                            <?php endif; ?>
                            <input type="hidden" name="landmark" value="<?php echo $row['landmark']; ?>">
                        </div>
                    </div>
                    <?php
                    if ($status === "Pending") {
                        ?>
                        <div class="col-12">
                            <div class="h6"></div>
                            <div class="d-block">
                                --
                            </div>
                        </div>
                        <?php
                    } else {
                        $order_id = $row['order_id'];
                        $query_rider = "SELECT client_order.order_uid, client_order.order_id, client_order.rider_name, user.user_id, user.unique_id, user_rider.unique_id AS rider_unique_id FROM client_order INNER JOIN user ON client_order.order_uid = user.user_id LEFT JOIN user_rider ON client_order.rider_name = user_rider.fullName WHERE (client_order.status = 'Accepted' OR client_order.status = 'Cancelled') AND client_order.order_id = '$order_id'";
                        $query_run = mysqli_query($con, $query_rider);

                        if ($rider = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <div class="col-12 mb-2">
                                <a href="chat_client.php?user_id=<?php echo $rider['rider_unique_id']; ?>"
                                    class="btn btn-sm btn-place-order px-5 text-white">
                                    <i class="fa-solid fa-message me-2"></i>Chat Rider
                                </a>
                            </div>
                            <?php
                        }

                    }
                    ?>
                    <?php if ($status != "Accepted") { ?>
                        <div class="col-10">
                            <div class="orderTime text-secondary pb-3">Order Placed:
                                <?php echo date('F j, Y g:ia', strtotime($row['order_placeTime'])) ?>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <button type="button" class="btn-edit-order" data-bs-toggle="modal"
                                data-bs-target="#exampleModal<?php echo $row['order_id'] ?>">
                                <i class="fa-solid fa-greater-than me-2 bg-none" style="font-size: 12px"></i>
                            </button>
                        </div>
                        <div class="col-12 text-center">
                            <form action="signUpUser.php" method="POST">
                                <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#cancelOrder_<?php echo $row['order_id'] ?>" name="cancelOrder"
                                    class="btn-cancel-order w-100">Cancel Order</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <!-- New content for accepted status -->
                        <?php
                        $order_id = $row['order_id'];
                        $queryAccepted = "SELECT rider_orderupdate.order_accept_time, rider_orderupdate.rider_location, rider_orderupdate.order_uid, client_order.order_id FROM rider_orderupdate, client_order WHERE client_order.order_id = '$order_id' AND rider_orderupdate.order_uid = '$order_id' LIMIT 1";
                        $query_run = mysqli_query($con, $queryAccepted);
                        while ($res = mysqli_fetch_assoc($query_run)) {

                            ?>
                            <div class="col-10">
                                <div class="order-box">
                                    <div class="orderTime text-secondary pb-3">Order Accepted:
                                        <?php echo date('F j, Y g:ia', strtotime($res['order_accept_time'])) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-end">
                                <button type="button" class="btn-edit-order" data-bs-toggle="modal"
                                    data-bs-target="#locationModal<?php echo $res['order_id'] ?>">
                                    <i class="fa-solid fa-greater-than me-2 bg-none" style="font-size: 12px"></i>
                                </button>
                            </div>
                            <div class="col-12">
                                <?php
                                $getLoc = "SELECT * FROM client_order WHERE order_id = '$order_id' AND proof != ''";
                                $runGetLoc = mysqli_query($con, $getLoc);
                                if (mysqli_num_rows($runGetLoc) > 0) {
                                    ?>
                                    <button type="button" class="btn btn-sm btn-place-order text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal_<?php echo $row['order_id'] ?>">
                                        <i class="fa-solid fa-check pe-2"></i>Order Received
                                    </button>
                                    <?php
                                } else {
                                    ?>
                                    <button type="button" class="btn btn-sm btn-place-order text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal_<?php echo $row['order_id'] ?>"
                                        disabled>
                                        <i class="fa-solid fa-check pe-2"></i>Order Received
                                    </button>
                                    <?php
                                }
                                ?>

                            </div>
                            <?php
                        }
                        ?>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

if (mysqli_num_rows($run) === 0) {
    ?>
    <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 65vh">
        <p>No Orders</p>
    </div>
    <?php
}
?>