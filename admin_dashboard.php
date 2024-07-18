<?php
include 'conf.php';
session_start();

if ((!isset($_SESSION['rider_id']))) {
    header("Location: rider_login.php");
}

$riderID = $_SESSION["rider_id"];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Home</title>
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
    <link rel="stylesheet" href="css/admin.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="sidebar">
        <div class="logo-details text-center">
            <div class="logo_name">ADMIN</div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <ul class="nav-list" style="
        padding-left: 0;">
            <li>
                <a href="#">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="admin_accounts.php">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Accounts</span>
                </a>
                <span class="tooltip">Accounts</span>
            </li>
            <li>
                <a href="admin_reports.php">
                    <i class="bx bx-folder"></i>
                    <span class="links_name">Reports</span>
                </a>
                <span class="tooltip">Reports</span>
            </li>
            <li>
                <a href="admin_track.php">
                    <i class="bx bx-current-location"></i>
                    <span class="links_name">Track</span>
                </a>
                <span class="tooltip">Track</span>
            </li>
            <li>
                <a href="admin_rider_que.php">
                    <i class='bx bxs-add-to-queue'></i>
                    <span class="links_name">Rider Queuing</span>
                </a>
                <span class="tooltip">Queuing</span>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="d-flex bg-light border align-items-center">
            <div class="text d-block me-auto">Dashboard</div>
            <div class="dropdown me-3">
                <button class="btn dropdown-toggle border border-1 border-warning text-warning bg-light-subtle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal=<?php echo $riderID ?>">Setting</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <?php
        $queryClient = "SELECT * FROM user";
        $resClient = mysqli_query($con, $queryClient);
        $totalClient = mysqli_num_rows($resClient);

        $queryClientMale = "SELECT * FROM user WHERE sex = 'Male'";
        $resClientMale = mysqli_query($con, $queryClientMale);
        $totalClientMale = mysqli_num_rows($resClientMale);

        $queryClientFemale = "SELECT * FROM user WHERE sex = 'Female'";
        $resClientFemale = mysqli_query($con, $queryClientFemale);
        $totalClientFemale = mysqli_num_rows($resClientFemale);

        $queryAccRequest = "SELECT * FROM temp_user";
        $resAccRequest = mysqli_query($con, $queryAccRequest);
        $totalAccRequest = mysqli_num_rows($resAccRequest);

        $queryRider = "SELECT * FROM user_rider WHERE unique_id IS NOT NULL AND unique_id <> ''";
        $resRider = mysqli_query($con, $queryRider);
        $totalRider = mysqli_num_rows($resRider);
        

        $queryRiderMale = "SELECT * FROM user_rider WHERE sex = 'Male'";
        $resRiderMale = mysqli_query($con, $queryRiderMale);
        $totalRiderMale = mysqli_num_rows($resRiderMale);

        $queryRiderFemale = "SELECT * FROM user_rider WHERE sex = 'Female'";
        $resRiderFemale = mysqli_query($con, $queryRiderFemale);
        $totalRiderFemale = mysqli_num_rows($resRiderFemale);

        $queryAccRequestRider = "SELECT * FROM temp_rider";
        $resAccRequestRider = mysqli_query($con, $queryAccRequestRider);
        $totalAccRequestRider = mysqli_num_rows($resAccRequestRider);

        $queryDeliveries = "SELECT * FROM client_order WHERE status = 'Delivered' OR status ='Cancelled'";
        $resDeliveries = mysqli_query($con, $queryDeliveries);
        $totalDeliveries = mysqli_num_rows($resDeliveries);

        $queryDeliveriesSuccessful = "SELECT * FROM client_order WHERE status = 'Delivered'";
        $resDeliveriesSuccessful = mysqli_query($con, $queryDeliveriesSuccessful);
        $totalDeliveriesSuccessful = mysqli_num_rows($resDeliveriesSuccessful);

        $queryDeliveriesUnsuccessful = "SELECT * FROM client_order WHERE status ='Cancelled'";
        $resDeliveriesUnsuccessful = mysqli_query($con, $queryDeliveriesUnsuccessful);
        $totalDeliveriesUnsuccessful = mysqli_num_rows($resDeliveriesUnsuccessful);
        ?>
        <div class="container mt-4">
            <div class="row gy-3">
                <h4 class="dash-box-header fw-bold">Accounts</h4>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex dropdown text-center">
                        <button class="icon--dash d-flex align-items-center justify-content-center dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: none; background: none;">
                            <i class="fa-solid fa-users me-2 icon--total"></i>
                        </button>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalClient ?>
                            </h3>
                            <div>Total Clients</div>
                        </div>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="admin_accounts.php">View Client Accounts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex">
                        <div class="icon--dash d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user me-2 icon-male"></i>
                        </div>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalClientMale ?>
                            </h3>
                            <div>Male</div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex">
                        <div class="icon--dash d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user me-2 icon--female"></i>
                        </div>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalClientFemale ?>
                            </h3>
                            <div>Female</div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex dropdown text-center">
                        <button class="icon--dash d-flex align-items-center justify-content-center dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: none; background: none;">
                            <i class="fa-solid fa-circle-check me-2 icon--success"></i>
                        </button>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalAccRequest ?>
                            </h3>
                            <div>Account Request</div>
                        </div>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="admin_accounts_request.php">View Client Account
                                    Request</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex dropdown text-center">
                        <button class="icon--dash d-flex align-items-center justify-content-center dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: none; background: none;">
                            <i class="fa-solid fa-users me-2 icon--total"></i>
                        </button>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalRider ?>
                            </h3>
                            <div>Total Riders</div>
                        </div>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="admin_accounts_rider.php">View Rider Accounts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex">
                        <div class="icon--dash d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user me-2 icon-male"></i>
                        </div>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalRiderMale ?>
                            </h3>
                            <div>Male</div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex">
                        <div class="icon--dash d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user me-2 icon--female"></i>
                        </div>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalRiderFemale ?>
                            </h3>
                            <div>Female</div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex dropdown text-center">
                        <button class="icon--dash d-flex align-items-center justify-content-center dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: none; background: none;">
                            <i class="fa-solid fa-circle-check me-2 icon--success"></i>
                        </button>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalAccRequestRider ?>
                            </h3>
                            <div>Account Request</div>
                        </div>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="admin_accounts_request_rider.php">View Rider Account
                                    Request</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5"></div>
                <h4 class="dash-box-header fw-bold">Reports</h4>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex dropdown text-center">
                        <button class="icon--dash d-flex align-items-center justify-content-center dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: none; background: none;">
                            <i class="fa-solid fa-truck me-2 icon--total"></i>
                        </button>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalDeliveries ?>
                            </h3>
                            <div>Total Deliveries</div>
                        </div>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="admin_reports.php">View Reports</a></li>
                            <li><a class="dropdown-item" href="admin_reports.php?status=Delivered">View Successful
                                    Reports</a>
                            </li>
                            <li><a class="dropdown-item" href="admin_reports.php?status=Cancelled">View Unsuccessful
                                    Reports</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex">
                        <div class="icon--dash d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-check me-2 icon--success"></i>
                        </div>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalDeliveriesSuccessful ?>
                            </h3>
                            <div>Successful</div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dash-box-1 border d-flex">
                        <div class="icon--dash d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-xmark me-2 icon--fail"></i>
                        </div>
                        <div class="ms-2 text--dash d-flex flex-column justify-content-center align-items-start">
                            <h3>
                                <?php echo $totalDeliveriesUnsuccessful ?>
                            </h3>
                            <div>Unsuccessful</div>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal=<?php echo $riderID ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php
                    $query = "SELECT * FROM user_rider WHERE rider_id = '$riderID'";
                    $res = mysqli_query($con, $query);

                    if ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <form action="admin_code.php" method="POST" class="container">
                            <input type="hidden" name="riderID" value="<?php echo $row['rider_id'] ?>">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <span class="h6">MY PROFILE</span>
                                    <hr>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control shadow-none input-focus-profile"
                                            name="newPass" value="<?php echo $row['username'] ?>" id="floatingNewPassword" placeholder="Username" readonly/>
                                        <label for="floatingNewPassword" class="text-secondary">Username</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control shadow-none input-focus-profile"
                                            name="password" id="floatingCurrentPassword" placeholder="Current Password"
                                            value="<?php echo $row['password'] ?>" />
                                        <button class="btn btn-outline-secondary border-1 border-secondary-subtle"
                                            type="button" id="togglePassword">
                                            <i class="fas fa-eye" id="eye-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" name="updatePass"
                                        class="btn btn-place-order text-white">Save</button>
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="js/adminSee.js"></script>
    <script src="js/script.js"></script>
</body>

</html>