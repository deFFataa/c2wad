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
    <title>Admin | Account Request Rider</title>
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
            <div class="text d-block me-auto">Rider Account Request</div>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Sex</th>
                        <th>Facebook</th>
                        <th>Phone Number</th>
                        <th>ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM temp_rider";
                    $query_run = mysqli_query($con, $query);
                    $row_count = mysqli_num_rows($query_run);

                    if ($row_count > 0) {
                        $counter = 1;

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            </form>
                            <form action="admin_code.php" method="POST" onsubmit="return confirm('This cannot be undone.');">
                                <tr>
                                    <td>
                                        <?php echo $counter; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="uid" value="<?php echo $row['id'] ?>">
                                        <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
                                        <input type="hidden" name="password" value="<?php echo $row['password'] ?>">
                                        <?php echo $row['firstName'] . " " . $row['lastName']; ?>
                                        <input type="hidden" name="firstname" value="<?php echo $row['firstName'] ?>">
                                        <input type="hidden" name="lastname" value="<?php echo $row['lastName'] ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['sex']; ?>
                                        <input type="hidden" name="sex" value="<?php echo $row['sex'] ?>">
                                    </td>
                                    <td>
                                        <a href="<?php echo $row['fbLink']; ?>" target="_blank">
                                            <?php echo $row['fbLink']; ?>
                                        </a>
                                        <input type="hidden" name="facebook" value="<?php echo $row['fbLink'] ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['phoneNumber']; ?>
                                        <input type="hidden" name="phone" value="<?php echo $row['phoneNumber'] ?>">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewModal<?php echo $row['id']; ?>">
                                            View Credentials
                                        </button>
                                    </td>
                                    <td>
                                        <input type="hidden" name="COR" value="<?php echo $row['COR']; ?>">
                                        <input type="hidden" name="ORM" value="<?php echo $row['ORM']; ?>">
                                        <input type="hidden" name="DLicense" value="<?php echo $row['driverLicense']; ?>">
                                        <button type="submit" name="accept-rider"
                                            class="btn btn-accept-acc btn-sm">Accept</button>
                                        <button type="submit" name="decline-rider"
                                            class="btn btn-decline-acc btn-sm">Decline</button>
                                    </td>
                                </tr>
                            </form>
                            <?php
                            $counter++;
                        }
                    } else {
                        echo "<h1>No Request</h1>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php
    $query = "SELECT * FROM temp_rider";
    $query_run = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($query_run)) {
        $user_id = $row['id'];

        $query1 = "SELECT * FROM temp_rider WHERE id = '$user_id'";
        $run = mysqli_query($con, $query1);

        while ($row1 = mysqli_fetch_assoc($run)) {
            ?>
            <!-- Modal -->
            <div class="modal fade" id="viewModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel"
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