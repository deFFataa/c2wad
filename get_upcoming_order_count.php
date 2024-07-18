<?php

include 'conf.php';
session_start();

$sql = "SELECT * FROM client_order WHERE status = 'Pending' LIMIT 1";
$result = $con->query($sql);

if ($run = mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="dropdown position-relative me-3">
            <button class="btn position-relative" style="padding: 2px" type="button" id="notificationDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-bell" style="color: #ff702d;"></i>
                <span
                    class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden"></span>
                    <?php
                    $sql1 = "SELECT * FROM client_order WHERE status = 'Pending'";
                    $sqlRun1 = mysqli_query($con, $sql1);
                    $newNotif1 = mysqli_num_rows($sqlRun1);
                    ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
            <ul class="dropdown-menu">
                <?php

                $sql = "SELECT * FROM client_order WHERE status = 'Pending'";
                $sqlRun = mysqli_query($con, $sql);
                $newNotif = mysqli_num_rows($sqlRun);

                if ($rowInner = mysqli_fetch_assoc($sqlRun)) {
                    ?>
                    <li>
                        <a class="dropdown-item" href="rider_list_of_orders.php" style="font-style: 12px">
                            New Order! Check it out
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
} else {
    ?>
    <div class="col d-flex justify-content-end align-items-center me-1">
        <div class="dropdown position-relative me-3">
            <button class="btn position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-bell p-1" style="color: #ff702d;"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="rider_list_of_orders.php" style="font-size: 15px !important">
                        No more pending orders.
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <?php
}
?>