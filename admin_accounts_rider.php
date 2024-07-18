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
    <title>Admin | Accounts</title>
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
                <a href="admin_dashboard.php">
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
                    <i class='bx bx-current-location'></i>
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
            <div class="text d-block me-auto">Rider Accounts</div>
            <div class="dropdown me-3">
                <button class="btn dropdown-toggle border border-1 border-warning text-warning bg-light-subtle"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal=<?php echo $riderID ?>">Setting</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="d-flex mt-3">
            <a href="admin_accounts_request_rider.php"
                class="ms-3 acc-req text-white d-flex justify-content-center align-items-center"> <i
                    class="fa-solid fa-motorcycle pe-1">
                </i>Account Request Rider
            </a>
            <a href="admin_accounts.php"
                class="ms-3 acc-req text-white d-flex justify-content-center align-items-center"> <i
                    class="fa-solid fa-user pe-1">
                </i>Client Account
            </a>
        </div>
        <hr class="mx-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 py-3">
                    <span class="h5" style="color: #FB5604">Rider Accounts</span>
                </div>
                <div class="col-lg-7">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get"
                        class="d-flex align-items-center me-2">
                        Show
                        <input type="number" name="entries" class="form-control w-25 mx-2"
                            style="width: 4rem !important" min="1" max="100" value="<?php echo $entries_per_page; ?>">
                        entries
                        <button type="submit" class="btn btn-sm btn-filter mx-2"><i
                                class="fa-solid fa-filter"></i></button>
                    </form>
                </div>
                <div class="col-lg-4" style="margin: 0; padding: 0;">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <div class="d-flex align-items-center me-2">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search...">
                            <button type="submit" name="btn-search" class="btn btn-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-1" style="margin: 0;">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-add-user-admin w-100 me-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="fa-solid fa-user-plus"></i>
                    </button>
                </div>
            </div>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Rating</th>
                        <th>Credentials</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $default_entries_per_page = 10;
                    $entries_per_page = isset($_GET['entries']) ? intval($_GET['entries']) : $default_entries_per_page;
                    $entries_per_page = max(1, min(100, $entries_per_page));

                    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                        $page = max(1, intval($_GET['page']));
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $entries_per_page;

                    $search_query = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

                    if (!empty($search_query)) {
                        $query = "SELECT * FROM user_rider WHERE fullName LIKE '%$search_query%' OR phoneNumber LIKE '%$search_query%' LIMIT $entries_per_page OFFSET $offset";
                    } else {
                        $query = "SELECT * FROM user_rider WHERE unique_id IS NOT NULL AND unique_id <> '' LIMIT $entries_per_page OFFSET $offset";
                    }

                    $query_run = mysqli_query($con, $query);
                    $row_count = mysqli_num_rows($query_run);

                    if ($row_count > 0) {
                        $counter = 1;

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $user_id = $row['rider_id'];
                            $rider_name = $row['fullName'];
                            ?>
                            <form action="admin_code.php" method="POST" onsubmit="return confirm('This cannot be undone.');">
                                <tr>
                                    <td>
                                        <?php echo $counter; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['fullName'] ?>
                                        <input type="hidden" name="fullName" value="<?php echo $row['fullName'] ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['phoneNumber']; ?>
                                        <input type="hidden" name="phone" value="<?php echo $row['phoneNumber'] ?>">
                                    </td>
                                    <td>
                                        <?php
                                        $getRating = "SELECT AVG(client_rating) AS averageRating, status FROM client_order WHERE rider_name = '$rider_name' AND status = 'Delivered'";
                                        $resRating = mysqli_query($con, $getRating);

                                        if (mysqli_num_rows($resRating) > 0) {
                                            $rowRating = mysqli_fetch_assoc($resRating);

                                            if ($rowRating["averageRating"] > 0) {
                                                $formattedRating = number_format($rowRating["averageRating"], 2);
                                                echo $formattedRating . "<i class ='ms-2 fa fa-solid fa-star'></i>";
                                            } else {
                                                echo "No ratings yet";
                                            }
                                        } else {
                                            echo "No ratings yet";
                                        }
                                        ?>


                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#cred<?php echo $row['rider_id']; ?>">
                                            View Credentials
                                        </button>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <input type="hidden" name="uid" value="<?php echo $row['rider_id'] ?>">
                                            <button type="button" name="accept-client" class="btn btn-accept-acc"
                                                data-bs-toggle="modal" data-bs-target="#viewModalEdit<?php echo $user_id; ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            <button type="submit" name="delete-riderAcc-client" class="btn btn-decline-acc">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                            <?php
                            $counter++;
                        }
                    } else {
                        echo "<h1>None</h1>";
                    }

                    ?>
                </tbody>

            </table>
        </div>
    </section>
    <div class="row">
        <div class="col-12 text-end pe-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination" style="float: right;">
                    <li class="page-item">
                        <a style="color: #FB5604" class="page-link"
                            href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . ($page - 1) . '&search=' . urlencode($search_query); ?>"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" style="color: #FB5604"
                            href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . ($page + 1) . '&search=' . urlencode($search_query); ?>"
                            aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal add rider-->
    <div class="modal fade" id="exampleModal" style="background-color: rgba(0, 0, 0, 0.5);" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="admin_code.php" method="POST" enctype="multipart/form-data">
                        <div class="row gy-3">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="Username" name="username">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="Password" name="password">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="Full Name" name="fullname">
                            </div>
                            <div class="col-lg-6">
                                <select name="sex" class="form-control">
                                    <option value="" selected disabled>-- Sex --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="Facebook Link" name="facebook">
                            </div>
                            <div class="mt-4">
                                <h5 class="fw-semibold text-center">Attach Requirements</h5>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-2">
                                    <input type="file" name="COR" class="form-control shadow-none" id="floatingInput"
                                        placeholder="Last name" />
                                    <label for="floatingInput" class="text-secondary">Certificate of
                                        Registration</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-2">
                                    <input type="file" name="ORMO" class="form-control shadow-none" id="floatingInput"
                                        placeholder="Last name" />
                                    <label for="floatingInput" class="text-secondary">Official Receipt of
                                        Motorcycle</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-2">
                                    <input type="file" name="license" class="form-control shadow-none"
                                        id="floatingInput" placeholder="Last name" />
                                    <label for="floatingInput" class="text-secondary">Driver's License</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-riderAcc-on-admin" class="btn btn-filter">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    $query = "SELECT * FROM user_rider";
    $query_run = mysqli_query($con, $query);
    $row_count = mysqli_num_rows($query_run);

    if ($row_count > 0) {
        $counter = 1;

        while ($row = mysqli_fetch_assoc($query_run)) {
            $user_id = $row['rider_id'];
            ?>
            <!-- Modal -->
            <form action="admin_code.php" method="POST">
                <div class="modal fade bd-example-modal-lg" style="background-color: rgba(0, 0, 0, 0.5);"
                    id="viewModalEdit<?php echo $user_id; ?>" tabindex="-1" aria-labelledby="viewModalLabelEdit"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="viewModalLabelEdit">Details
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row gy-3">
                                    <div class="col-lg-6 text-start">
                                        <input type="hidden" name="uid" value="<?php echo $user_id ?>">
                                        <span class="ms-1 fw-bold">Username</span>
                                        <input type="text" name="username" class="form-control"
                                            value="<?php echo $row['username'] ?>">
                                    </div>
                                    <div class="col-lg-6 text-start">
                                        <span class="ms-1 fw-bold">Password</span>
                                        <input type="password" name="password" value="<?php echo $row['password'] ?>" class="form-control">
                                    </div>
                                    <div class="col-lg-6 text-start">
                                        <input type="hidden" name="uid" value="<?php echo $user_id ?>">
                                        <span class="ms-1 fw-bold">Full Name</span>
                                        <input type="text" name="fullName" class="form-control"
                                            value="<?php echo $row['fullName'] ?>">
                                    </div>
                                    <div class="col-lg-6 text-start">
                                        <span class="ms-1 fw-bold">Sex</span>
                                        <select name="sex" class="form-control">
                                            <option value="<?php echo $row['sex'] ?>" selected>
                                                <?php echo $row['sex'] ?>
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 text-start">
                                        <span class="ms-1 fw-bold">Facebook</span>
                                        <input type="text" name="facebook" class="form-control"
                                            value="<?php echo $row['fblink'] ?>">
                                    </div>
                                    <div class="col-lg-6 text-start">
                                        <span class="ms-1 fw-bold">Phone Number</span>
                                        <input type="text" name="phone" class="form-control"
                                            value="<?php echo $row['phoneNumber'] ?>">
                                    </div>
                                    <div class="col-lg-6 text-start">
                                        <span class="ms-1 fw-bold">Status</span>
                                        <select name="status" class="form-control">
                                            <?php
                                            $selectedStatus = $row['account_status'];
                                            $options = ['Deactivate', 'Activated'];

                                            foreach ($options as $option) {
                                                if ($selectedStatus == $option) {
                                                    echo '<option value="' . $option . '" selected>' . $option . '</option>';
                                                } else {
                                                    echo '<option value="' . $option . '">' . $option . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="update-accRider-admin" class="btn btn-accept-acc">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php
        }
    }
    ?>

    <?php
    $query = "SELECT * FROM user_rider";
    $query_run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($query_run)) {
        $user_id = $row['rider_id'];

        $query1 = "SELECT * FROM user_rider WHERE rider_id = '$user_id'";
        $run = mysqli_query($con, $query1);

        while ($row1 = mysqli_fetch_assoc($run)) {
            ?>
            <!-- Modal -->
            <div class="modal fade" id="cred<?php echo $row1['rider_id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewModalLabel">Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if ($row1['COR']): ?>
                                <p><strong>Certificate of Registration (CR):</strong> <a href="<?php echo $row1['COR']; ?>"
                                        target="_blank">View File</a></p>
                            <?php endif; ?>
                            <?php if ($row1['ORM']): ?>
                                <p><strong>Official Receipt of Motorcycles (OR):</strong> <a href="<?php echo $row1['ORM']; ?>"
                                        target="_blank">View File</a></p>
                            <?php endif; ?>

                            <?php if ($row1['driverLicense']): ?>
                                <p><strong>Driver's License:</strong> <a href="<?php echo $row1['driverLicense']; ?>"
                                        target="_blank">View File</a></p>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <!-- End of Modal -->
        <?php
    }
    ?>
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
                                            name="newPass" value="<?php echo $row['username'] ?>" id="floatingNewPassword"
                                            placeholder="Username" readonly />
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