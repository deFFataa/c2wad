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
    <title>Admin | Assign Riders</title>
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
            <div class="text d-block me-auto">Assign Riders</div>
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
        <div class="container-fluid mt-5">
            <div class="row gap-4 d-flex justify-content-center">
                <div class="col-lg-5 col-md-5 que-box me-2">
                    <div class="w-100 text-center d-block">
                        <div class="fw-bold">Monday</div>
                    </div>
                    <div class="row px-2">
                        <div class="col-10 mb-2 fw-bold">Riders</div>
                        <div class="col-2 mb-2 fw-bold">Action</div>
                        <?php
                        $queryMonday = "SELECT * FROM user_rider WHERE day1 = 'Monday' OR day2 = 'Monday'";
                        $runMonday = mysqli_query($con, $queryMonday);

                        if (mysqli_num_rows($runMonday) > 0) {
                            while ($row = mysqli_fetch_assoc($runMonday)) {
                                ?>
                                <div class="col-10 mb-2">
                                    <?php echo $row['fullName']; ?>
                                </div>
                                <div class="col-2 text-center mb-2">
                                    <form action="admin_code.php" method="post">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <button type="submit" name="removeQueMonday" class="btn btn-decline-acc btn-sm"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 text-center">
                                No riders found for Monday.
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <form action="admin_code.php" method="post"
                            onsubmit="return confirm('Do you really wish to remove all of it?');">
                            <button type="submit" name="removeAllRiderQMonday"
                                class="btn btn-decline-acc btn-sm text-white">
                                Remove All
                            </button>
                        </form>
                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <button type="button" class="btn btn-filter btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add
                        </button>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 que-box">
                    <div class="w-100 text-center d-block">
                        <div class="fw-bold">Tuesday</div>
                    </div>
                    <div class="row px-2">
                        <div class="col-10 mb-2 fw-bold">Riders</div>
                        <div class="col-2 mb-2 fw-bold">Action</div>
                        <?php
                        $queryMonday = "SELECT * FROM user_rider WHERE day1 = 'Tuesday' OR day2 = 'Tuesday'";
                        $runMonday = mysqli_query($con, $queryMonday);

                        if (mysqli_num_rows($runMonday) > 0) {
                            while ($row = mysqli_fetch_assoc($runMonday)) {
                                ?>
                                <div class="col-10 mb-2">
                                    <?php echo $row['fullName']; ?>
                                </div>
                                <div class="col-2 text-center mb-2">
                                    <form action="admin_code.php" method="post">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <button type="submit" name="removeQueTuesday" class="btn btn-decline-acc btn-sm"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 text-center">
                                No riders found for Tuesday.
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <form action="admin_code.php" method="post"
                            onsubmit="return confirm('Do you really wish to remove all of it?');">
                            <button type="submit" name="removeAllRiderQTuesday"
                                class="btn btn-decline-acc btn-sm text-white">
                                Remove All
                            </button>
                        </form>
                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <button type="button" class="btn btn-filter btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModalTuesday">
                            Add
                        </button>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 que-box me-2">
                    <div class="w-100 text-center d-block">
                        <div class="fw-bold">Wednesday</div>
                    </div>
                    <div class="row px-2">
                        <div class="col-10 mb-2 fw-bold">Riders</div>
                        <div class="col-2 mb-2 fw-bold">Action</div>
                        <?php
                        $queryMonday = "SELECT * FROM user_rider WHERE day1 = 'Wednesday' OR day2 = 'Wednesday'";
                        $runMonday = mysqli_query($con, $queryMonday);

                        if (mysqli_num_rows($runMonday) > 0) {
                            while ($row = mysqli_fetch_assoc($runMonday)) {
                                ?>
                                <div class="col-10 mb-2">
                                    <?php echo $row['fullName']; ?>
                                </div>
                                <div class="col-2 text-center mb-2">
                                    <form action="admin_code.php" method="post">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <button type="submit" name="removeQueWednesday" class="btn btn-decline-acc btn-sm"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 text-center">
                                No riders found for Wednesday.
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <form action="admin_code.php" method="post"
                            onsubmit="return confirm('Do you really wish to remove all of it?');">
                            <button type="submit" name="removeAllRiderQWednesday"
                                class="btn btn-decline-acc btn-sm text-white">
                                Remove All
                            </button>
                        </form>
                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <button type="button" class="btn btn-filter btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModalWednesday">
                            Add
                        </button>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 que-box">
                    <div class="w-100 text-center d-block">
                        <div class="fw-bold">Thursday</div>
                    </div>
                    <div class="row px-2">
                        <div class="col-10 mb-2 fw-bold">Riders</div>
                        <div class="col-2 mb-2 fw-bold">Action</div>
                        <?php
                        $queryMonday = "SELECT * FROM user_rider WHERE day1 = 'Thursday' OR day2 = 'Thursday'";
                        $runMonday = mysqli_query($con, $queryMonday);

                        if (mysqli_num_rows($runMonday) > 0) {
                            while ($row = mysqli_fetch_assoc($runMonday)) {
                                ?>
                                <div class="col-10 mb-2">
                                    <?php echo $row['fullName']; ?>
                                </div>
                                <div class="col-2 text-center mb-2">
                                    <form action="admin_code.php" method="post">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <button type="submit" name="removeQueThursday" class="btn btn-decline-acc btn-sm"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 text-center">
                                No riders found for Thursday.
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <form action="admin_code.php" method="post"
                            onsubmit="return confirm('Do you really wish to remove all of it?');">
                            <button type="submit" name="removeAllRiderQThursday"
                                class="btn btn-decline-acc btn-sm text-white">
                                Remove All
                            </button>
                        </form>
                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <button type="button" class="btn btn-filter btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModalThursday">
                            Add
                        </button>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 que-box me-2">
                    <div class="w-100 text-center d-block">
                        <div class="fw-bold">Friday</div>
                    </div>
                    <div class="row px-2">
                        <div class="col-10 mb-2 fw-bold">Riders</div>
                        <div class="col-2 mb-2 fw-bold">Action</div>
                        <?php
                        $queryMonday = "SELECT * FROM user_rider WHERE day1 = 'Friday' OR day2 = 'Friday'";
                        $runMonday = mysqli_query($con, $queryMonday);

                        if (mysqli_num_rows($runMonday) > 0) {
                            while ($row = mysqli_fetch_assoc($runMonday)) {
                                ?>
                                <div class="col-10 mb-2">
                                    <?php echo $row['fullName']; ?>
                                </div>
                                <div class="col-2 text-center mb-2">
                                    <form action="admin_code.php" method="post">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <button type="submit" name="removeQueFriday" class="btn btn-decline-acc btn-sm"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 text-center">
                                No riders found for Friday.
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <form action="admin_code.php" method="post"
                            onsubmit="return confirm('Do you really wish to remove all of it?');">
                            <button type="submit" name="removeAllRiderQFriday"
                                class="btn btn-decline-acc btn-sm text-white">
                                Remove All
                            </button>
                        </form>
                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <button type="button" class="btn btn-filter btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModalFriday">
                            Add
                        </button>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 que-box">
                    <div class="w-100 text-center d-block">
                        <div class="fw-bold">Saturday</div>
                    </div>
                    <div class="row px-2">
                        <div class="col-10 mb-2 fw-bold">Riders</div>
                        <div class="col-2 mb-2 fw-bold">Action</div>
                        <?php
                        $queryMonday = "SELECT * FROM user_rider WHERE day1 = 'Saturday' OR day2 = 'Saturday'";
                        $runMonday = mysqli_query($con, $queryMonday);

                        if (mysqli_num_rows($runMonday) > 0) {
                            while ($row = mysqli_fetch_assoc($runMonday)) {
                                ?>
                                <div class="col-10 mb-2">
                                    <?php echo $row['fullName']; ?>
                                </div>
                                <div class="col-2 text-center mb-2">
                                    <form action="admin_code.php" method="post">
                                        <input type="hidden" name="rider_id" value="<?php echo $row['rider_id'] ?>">
                                        <button type="submit" name="removeQueSaturday" class="btn btn-decline-acc btn-sm"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 text-center">
                                No riders found for Saturday.
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <form action="admin_code.php" method="post"
                            onsubmit="return confirm('Do you really wish to remove all of it?');">
                            <button type="submit" name="removeAllRiderQSaturday"
                                class="btn btn-decline-acc btn-sm text-white">
                                Remove All
                            </button>
                        </form>
                    </div>
                    <div class="text-end mt-3 mb-2 px-2">
                        <button type="button" class="btn btn-filter btn-sm text-white" data-bs-toggle="modal"
                            data-bs-target="#exampleModalSaturday">
                            Add
                        </button>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 que-box mb-3">
                    <div class="w-100 text-center d-block">
                        <div class="fw-bold">Sunday</div>
                    </div>
                    <div class="row px-2">
                        <div class="col-10 mb-2 fw-bold">Riders</div>
                        <div class="col-2 mb-2 fw-bold">Action</div>
                        <?php
                        $queryMonday = "SELECT * FROM user_rider WHERE unique_id != ''";
                        $runMonday = mysqli_query($con, $queryMonday);

                        if (mysqli_num_rows($runMonday) > 0) {
                            while ($row = mysqli_fetch_assoc($runMonday)) {
                                ?>
                                <div class="col-10 mb-2">
                                    <?php echo $row['fullName']; ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 text-center">
                                No riders found for Sunday.
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-lg-5"></div>
            </div>
        </div>
    </section>


    <!-- Modal for Monday queuing -->
    <form action="admin_code.php" method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rider</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM user_rider WHERE (day1 = '' OR day2 = '') AND unique_id != ''";
                        $run = mysqli_query($con, $query);

                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="col-12 my-2">
                                    <input type="checkbox" name="selectedRiders[]" value="<?php echo $row['rider_id'] ?>"
                                        class="form-check-input me-2">
                                    <?php echo $row['fullName'] ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 my-2 text-center">
                                No more available riders
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveQue" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal for Tuesday queuing -->
    <form action="admin_code.php" method="post">
        <div class="modal fade" id="exampleModalTuesday" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rider</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM user_rider WHERE (day1 = '' OR day2 = '') AND unique_id != ''";
                        $run = mysqli_query($con, $query);

                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="col-12 my-2">
                                    <input type="checkbox" name="selectedRiders[]" value="<?php echo $row['rider_id'] ?>"
                                        class="form-check-input me-2">
                                    <?php echo $row['fullName'] ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 my-2 text-center">
                                No more available riders
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveQueTuesday" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal for Wednesday queuing -->
    <form action="admin_code.php" method="post">
        <div class="modal fade" id="exampleModalWednesday" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rider</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM user_rider WHERE (day1 = '' OR day2 = '') AND unique_id != ''";
                        $run = mysqli_query($con, $query);

                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="col-12 my-2">
                                    <input type="checkbox" name="selectedRiders[]" value="<?php echo $row['rider_id'] ?>"
                                        class="form-check-input me-2">
                                    <?php echo $row['fullName'] ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 my-2 text-center">
                                No more available riders
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveQueWednesday" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal for Thursday queuing -->
    <form action="admin_code.php" method="post">
        <div class="modal fade" id="exampleModalThursday" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rider</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM user_rider WHERE (day1 = '' OR day2 = '') AND unique_id != ''";
                        $run = mysqli_query($con, $query);

                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="col-12 my-2">
                                    <input type="checkbox" name="selectedRiders[]" value="<?php echo $row['rider_id'] ?>"
                                        class="form-check-input me-2">
                                    <?php echo $row['fullName'] ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 my-2 text-center">
                                No more available riders
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveQueThursday" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal for Friday queuing -->
    <form action="admin_code.php" method="post">
        <div class="modal fade" id="exampleModalFriday" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rider</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM user_rider WHERE (day1 = '' OR day2 = '') AND unique_id != ''";
                        $run = mysqli_query($con, $query);

                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="col-12 my-2">
                                    <input type="checkbox" name="selectedRiders[]" value="<?php echo $row['rider_id'] ?>"
                                        class="form-check-input me-2">
                                    <?php echo $row['fullName'] ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 my-2 text-center">
                                No more available riders
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveQueFriday" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal for Saturday queuing -->
    <form action="admin_code.php" method="post">
        <div class="modal fade" id="exampleModalSaturday" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rider</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM user_rider WHERE (day1 = '' OR day2 = '') AND unique_id != ''";
                        $run = mysqli_query($con, $query);

                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="col-12 my-2">
                                    <input type="checkbox" name="selectedRiders[]" value="<?php echo $row['rider_id'] ?>"
                                        class="form-check-input me-2">
                                    <?php echo $row['fullName'] ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 my-2 text-center">
                                No more available riders
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveQueSaturday" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal for Sunday queuing -->
    <form action="admin_code.php" method="post">
        <div class="modal fade" id="exampleModalSunday" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Rider</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM user_rider WHERE (day1 = '' OR day2 = '') AND unique_id != ''";
                        $run = mysqli_query($con, $query);

                        if (mysqli_num_rows($run) > 0) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <div class="col-12 my-2">
                                    <input type="checkbox" name="selectedRiders[]" value="<?php echo $row['rider_id'] ?>"
                                        class="form-check-input me-2">
                                    <?php echo $row['fullName'] ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 my-2 text-center">
                                No more available riders
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="saveQueSunday" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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