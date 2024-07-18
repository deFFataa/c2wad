<?php
include 'conf.php';
session_start();
if ((!isset($_SESSION['rider_id']))) {
    header("Location: rider_login.php");
}

$riderID = $_SESSION["rider_id"];
function generateStarRating($rating)
{
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5;

    $output = '';

    for ($i = 0; $i < $fullStars; $i++) {
        $output .= '<i class="fas fa-star"></i>';
    }

    if ($halfStar) {
        $output .= '<i class="fas fa-star-half-alt"></i>';
    }

    for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++) {
        $output .= '<i class="far fa-star"></i>';
    }

    return $output;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Reports</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
            <div class="text d-block me-auto">Delivery Reports</div>
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
        <div class="d-flex m-3 mt-3">
            <a href="admin_reports.php" class="btn btn-filter btn-sm me-2">All</a>
            <a href="<?php echo $_SERVER['PHP_SELF'] . '?status=Active'; ?>"
                class="btn btn-filter btn-sm me-2">Active</a>
            <a href="<?php echo $_SERVER['PHP_SELF'] . '?status=Delivered'; ?>"
                class="btn btn-filter btn-sm me-2">Successful</a>
            <a href="<?php echo $_SERVER['PHP_SELF'] . '?status=Cancelled'; ?>"
                class="btn btn-filter btn-sm me-2">Unsuccessful</a>

        </div>
        <hr class="mx-3">
        <div class="container-fluid">
            <div class="row">
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
                <div class="col-lg-5" style="margin: 0; padding: 0;">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <div class="d-flex align-items-center me-2">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search...">
                            <button type="submit" name="btn-search" class="btn btn-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Client Name</th>
                        <th>Rider Name</th>
                        <th>Status</th>
                        <th>Rating</th>
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

                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];

                        if ($status === "Active") {
                            $query = "SELECT * FROM client_order WHERE status = 'Pending' OR status = 'Accepted'";
                        } else {
                            $query = "SELECT * FROM client_order WHERE status = '$status'";
                        }
                    } else {
                        $query = "SELECT * FROM client_order";
                    }

                    if (!empty($search_query)) {
                        $query = "SELECT * FROM client_order WHERE client_name LIKE '%$search_query%' OR rider_name LIKE '%$search_query%'";
                    }


                    $query .= " LIMIT $entries_per_page OFFSET $offset";


                    $query_run = mysqli_query($con, $query);
                    $row_count = mysqli_num_rows($query_run);

                    if ($row_count > 0) {
                        $counter = 1;

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $order_id = $row['order_id'];
                            ?>
                            <form action="admin_code.php" method="POST" onsubmit="return confirm('This cannot be undone.');">
                                <tr>
                                    <td>
                                        <?php echo $counter; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_id']; ?>
                                    <td>
                                        <?php echo $row['client_name'] ?>
                                    </td>
                                    </td>
                                    <td>
                                        <?php echo $row['rider_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['status'] ?>
                                    </td>
                                    <td>
                                        <?php echo generateStarRating($row['client_rating']); ?>
                                    </td>

                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <input type="hidden" name="uid" value="<?php echo $row['order_id'] ?>">

                                            <button type="button" class="btn btn-view-acc" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal?<?php echo $order_id ?>">
                                                <i class="fa-solid fa-eye"></i>
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
            <div class="row">
                <div class="col-12 text-end">
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
        </div>
    </section>
    <!-- Modal for viewing full details -->
    <?php
    $query = "SELECT * FROM client_order";
    $run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($run)) {
        $order_id = $row['order_id'];
        $status = $row['status'];
        ?>
        <div class="modal fade" id="exampleModal?<?php echo $order_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Full Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-3">
                            <div class="col-6">
                                <p class="fw-bold m-0">Store/Pick Up Location</p>
                                <?php echo $row['order_location'] ?>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold m-0">Order Detail</p>
                                <?php echo $row['order_detail'] ?>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold m-0">Payment Method</p>
                                <?php echo $row['order_payment'] ?>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold m-0">Drop Off</p>
                                <?php echo $row['street'] . ", " . $row['barangay'] . ", " . $row['municipality'] ?>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold m-0">Land Mark</p>
                                <?php if (!empty($row['landmark'])): ?>
                                    <p class="d-block">
                                        <?php echo $row['landmark']; ?>
                                    </p>
                                <?php else: ?>
                                    <p class="d-block">
                                        None
                                    </p>
                                <?php endif; ?>
                                <input type="hidden" name="landmark" value="<?php echo $row['landmark']; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="fw-bold">Delivery Update</p>
                            </div>
                        </div>
                        <div class="row gy-3">
                            <?php
                            $accepted_query = "SELECT rider_orderupdate.order_accept_time, rider_orderupdate.order_uid, rider_orderupdate.rider_location, rider_orderupdate.location_time, client_order.order_id FROM rider_orderupdate, client_order WHERE client_order.order_id = '$order_id' AND rider_orderupdate.order_uid = '$order_id' ORDER BY `rider_orderupdate`.`location_time` DESC ";
                            $accepted_run = mysqli_query($con, $accepted_query);

                            while ($accepted_res = mysqli_fetch_assoc($accepted_run)) {
                                ?>
                                <div class="col-5 text-end d-flex flex-column justify-content-center">
                                    <span class="rider-location-update">
                                        <?php echo date('F j, h:ia', strtotime($accepted_res['location_time'])) ?>
                                    </span>
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center justify-content-center">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <i class="fa-solid fa-box me-3 h4 pt-2" style="color: #FB5604; font-size: 15px"></i>
                                    <div class="track-box-content d-flex align-items-center">
                                        <label for="" class="rider-location">
                                            <?php echo $accepted_res['rider_location'] ?>
                                        </label>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="fw-bold">Rating</p>
                                <?php echo generateStarRating($row['client_rating']); ?>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-center align-items-start flex-column mt-3"
                                    style="padding: 0 7rem">
                                    <span class="fw-semibold w-100 text-center">Comments</span>
                                    <?php
                                    $client_comment = $row['rating_comment'];

                                    if ($client_comment != '') {
                                        ?>
                                        <textarea class="form-control" name="rating_comment"
                                            placeholder="Client's comment will display here" id="floatingTextarea2"
                                            style="height: 100px" readonly><?php echo $row['rating_comment'] ?></textarea>
                                        <?php
                                    } else {
                                        ?>
                                            <span class="text-center w-100">No comment</span>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <?php
                        if ($status != "Cancelled") {
                            ?>
                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <p class="fw-bold">Proof of Delivery</p>
                                </div>
                                <div class="col-12 text-center">
                                    <p class="fw-bold"></p>
                                </div>
                                <div class="col-12">
                                    <?php if (!empty($row['proof'])): ?>
                                        <img src="<?php echo $row['proof']; ?>" alt="Proof Image" class="img-fluid">
                                    <?php else: ?>
                                        <p class="text-center">No proof available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <p class="fw-bold">Order Cancelled</p>
                                </div>
                                <div class="col-12 text-center">
                                    <span class="fw-semibold">Reason: </span>
                                    <?php echo $row['reason'] ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

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
                                    <label for="" class="h6">MY PROFILE</label>
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