<?php

include 'conf.php';
session_start();

$fullName = $_SESSION['fullName'];

$currentDay = date('N');

$riderAssignments = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    7 => 'Sunday'
);

$assignedRider = $riderAssignments[$currentDay];

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 3;

$query = "SELECT client_order.order_id, client_order.order_uid, client_order.client_name, client_order.phoneNumber, client_order.order_location, client_order.order_detail, client_order.order_payment, client_order.municipality, client_order.barangay, client_order.street, client_order.landmark ,client_order.order_placeTime, client_order.proof, user_rider.fullName, user_rider.rider_id, user_rider.fullName, user_rider.day1, user_rider.day2 FROM client_order, user_rider WHERE client_order.status = 'Pending' AND user_rider.fullName = '$fullName' LIMIT $limit";
$run = mysqli_query($con, $query);

$loopCounter = 0;

while ($row = mysqli_fetch_assoc($run)) {
    $loopCounter++;
    if ($row['day1'] === $assignedRider or $row['day2'] === $assignedRider) {
        ?>
        <div class="col-12">
            <div class="row">
                <form action="rider_code.php" method="POST">
                    <div class="col-12">
                        <div class="box-order p-3 mb-3" style="height: 100%">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="bg-light rounded rounded-2 p-2">
                                        <input type="hidden" name="user_id" value="<?php echo $row['order_uid'] ?>">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                        <input type="hidden" name="riderName" value="<?php echo $row['fullName'] ?>">
                                        <div class="h6">Name</div>
                                        <p class="d-block">
                                            <?php echo $row['client_name'] ?>
                                        </p>
                                        <input type="hidden" name="clientName" value="<?php echo $row['client_name'] ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded rounded-2 p-2">
                                        <div class="h6">Phone</div>
                                        <p class="d-block">
                                            <?php echo $row['phoneNumber'] ?>
                                        </p>
                                        <input type="hidden" name="CP" value="<?php echo $row['phoneNumber'] ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded rounded-2 p-2">
                                        <div class="h6">Order/Pick Up</div>
                                        <p class="d-block">
                                            <?php echo $row['order_location'] ?>
                                        </p>
                                        <input type="hidden" name="order_loc" value="<?php echo $row['order_location'] ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded rounded-2 p-2">
                                        <div class="h6">Order Details</div>
                                        <p class="d-block">
                                            <?php echo $row['order_detail'] ?>
                                        </p>
                                        <input type="hidden" name="order_detail" value="<?php echo $row['order_detail'] ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded rounded-2 p-2">
                                        <div class="h6">Payment Method</div>
                                        <p class="d-block">
                                            <?php echo $row['order_payment'] ?>
                                        </p>
                                        <input type="hidden" name="order_payment" value="<?php echo $row['order_payment'] ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded rounded-2 p-2">
                                        <div class="h6">Drop Off</div>
                                        <p class="d-block">
                                            <?php echo $row['street'] . ", " . $row['barangay'] . ", " . $row['municipality'] ?>
                                        </p>
                                        <input type="hidden" name="street" value="<?php echo $row['street'] ?>">
                                        <input type="hidden" name="barangay" value="<?php echo $row['barangay'] ?>">
                                        <input type="hidden" name="municipality" value="<?php echo $row['municipality'] ?>">
                                    </div>
                                </div>
                                <div class="col-12" <?php if (empty($row['landmark']))
                                    echo 'None'; ?>>
                                    <div class="bg-light rounded rounded-2 p-2">
                                        <div class="h6">Landmark</div>
                                        <p class="d-block">
                                            <?php echo $row['landmark']; ?>
                                        </p>
                                        <input type="hidden" name="landmark" value="<?php echo $row['landmark']; ?>">
                                        <div class="bg-light rounded rounded-2 p-2"></div>
                                    </div>

                                    <div class="col-12">
                                        <div class="orderTime text-secondary pb-3">Order Placed:
                                            <?php echo date('F j, Y g:ia', strtotime($row['order_placeTime'])) ?>
                                        </div>
                                    </div>
                                    <?php
                                    $fullName = $_SESSION['fullName'];
                                    $queryInner = "SELECT client_order.rider_name, client_order.proof, client_order.status, client_order.reason, user_rider.fullName FROM client_order, user_rider WHERE client_order.rider_name = '$fullName' AND user_rider.fullName = '$fullName' AND client_order.proof = '' AND client_order.reason = '' ";
                                    $runInner = mysqli_query($con, $queryInner);

                                    $acceptedOrders = 0;

                                    while ($rowInner = mysqli_fetch_assoc($runInner)) {
                                        $proof = $rowInner['proof'];
                                        $reason = $rowInner['reason'];

                                        if ($reason == '' && $proof == '') {
                                            $acceptedOrders++;
                                        }
                                    }

                                    if ($acceptedOrders >= 3) {
                                        ?>
                                        <div class="col-12 text-center">
                                            <div class="btn btn-sm btn-terminate-order text-white w-100" style="width: 120px;">Not
                                                Available</div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="col-12 text-center">
                                            <button type="submit" name="acceptOrder" class="btn btn-sm btn-accept-order text-white"
                                                style="width: 120px;">Accept</button>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="col-12">


            <?php
            $day1 = $row['day1'];
            $day2 = $row['day2'];

            if ($day1 == '' and $day2 == '') {
                ?>
                <div class="d-flex justify-content-center align-items-center" style="min-height: 75vh">
                    <p style="font-size: 14px">You don't have a schedule yet.</p>
                </div>
                <?php
            } else if ($day1 != '' and $day2 == '') {
                ?>
                    <div class="d-flex justify-content-center align-items-center" style="min-height: 75vh">
                        <p style="font-size: 14px">Relax, kindly wait for your turn to serve on
                        <?php echo $day1 ?>
                        </p>
                    </div>
                <?php
            } else if ($day1 == '' and $day2 != '') {
                ?>
                        <div class="d-flex justify-content-center align-items-center" style="min-height: 75vh">
                            <p style="font-size: 14px">Relax, kindly wait for your turn to serve on
                        <?php echo $day2 ?>
                            </p>
                        </div>
                <?php
            } else {
                ?>
                        <div class="d-flex justify-content-center align-items-center" style="min-height: 75vh">
                            <p style="font-size: 14px">Relax, kindly wait for your turn to serve on
                        <?php echo $row['day1'] . " and " . $row['day2'] ?>
                            </p>
                        </div>
                <?php
            }

            ?>
        </div>
        <?php
        break;
    }
}


if (mysqli_num_rows($run) === 0) {
    ?>
    <div class="col-12 d-flex justify-content-center align-items-center" style="height: 66vh">
        <p>No pending orders found.</p>
    </div>
    <?php
}

?>