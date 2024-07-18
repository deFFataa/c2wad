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
    <title>Admin | Account Request Client</title>
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
            <div class="text d-block me-auto">Client Account Request</div>
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
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Sex</th>
                        <th>Address</th>
                        <th>Facebook</th>
                        <th>Phone Number</th>
                        <th>ID</th>
                        <th>Action</th>
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
                        $query = "SELECT * FROM temp_user WHERE firstName LIKE '%$search_query%' OR lastName LIKE '%$search_query%' OR phoneNumber LIKE '%$search_query%' LIMIT $entries_per_page OFFSET $offset";
                    } else {
                        $query = "SELECT * FROM temp_user LIMIT $entries_per_page OFFSET $offset";
                    }

                    $query_run = mysqli_query($con, $query);
                    $row_count = mysqli_num_rows($query_run);

                    if ($row_count > 0) {
                        $counter = 1;

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <form action="admin_code.php" method="POST">
                                <tr>
                                    <td>
                                        <?php echo $counter; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['firstName'] . " " . $row['lastName']; ?>
                                        <input type="hidden" name="firstname" value="<?php echo $row['firstName'] ?>">
                                        <input type="hidden" name="lastname" value="<?php echo $row['lastName'] ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['sex']; ?>
                                        <input type="hidden" name="sex" value="<?php echo $row['sex'] ?>">
                                    </td>
                                    <td style="width: 20%">
                                        <span class="">
                                            <?php echo $row['street'] . ", " . $row['barangay'] . ", " . $row['municipality'] ?>
                                        </span>
                                        <input type="hidden" name="municipality" value="<?php echo $row['municipality'] ?>">
                                        <input type="hidden" name="barangay" value="<?php echo $row['barangay'] ?>">
                                        <input type="hidden" name="street" value="<?php echo $row['street'] ?>">
                                    </td>
                                    <td>
                                        <a href="<?php echo $row['fblink']; ?>" target="_blank">
                                            Fb Link
                                        </a>
                                        <input type="hidden" name="facebook" value="<?php echo $row['fblink'] ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['phoneNumber']; ?>
                                        <input type="hidden" name="phone" value="<?php echo $row['phoneNumber'] ?>">
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal<?php echo $row['id'] ?>">
                                            View ID
                                        </button>
                                    </td>
                                    <td>
                                        <input type="hidden" name="uid" value="<?php echo $row['id'] ?>">
                                        <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
                                        <input type="hidden" name="password" value="<?php echo $row['password'] ?>">
                                        <button type="submit" name="accept-client"
                                            class="btn  btn-sm btn-accept-acc" onclick="return confirm('You are about to accept this account.');">Accept</button>
                                        <button type="submit" name="decline-client"
                                            class="btn btn-sm btn-decline-acc" onclick="return confirm('You are about to decline this account.');">Decline</button>
                                    </td>
                                </tr>
                            </form>

                            <?php
                            $counter++;
                        }
                    } else {
                        ?>
                        <h1>No Request</h1>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
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
    </section>
    <?php
    $query = "SELECT * FROM temp_user";
    $query_run = mysqli_query($con, $query);
    $row_count = mysqli_num_rows($query_run);

    if ($row_count > 0) {
        $counter = 1;

        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Client's ID</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                            if (!empty($row['idPic']) && file_exists($row['idPic'])) {
                                echo '<img src="' . $row['idPic'] . '" alt="" class="img-fluid">';
                            } else {
                                echo '<p>No image available</p>';
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
                                    <span for="" class="h6">MY PROFILE</span>
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