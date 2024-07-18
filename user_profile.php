<?php
include 'conf.php';
session_start();

if ((!isset($_SESSION['unique_id']))) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | Profile</title>
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
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
    </style>
</head>

<body>
    <section class="nav-section" id="nav-home">
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
                                <li><a class="dropdown-item py-3" href="user_profile.php">Profile</a></li>
                                <li><a class="dropdown-item py-3" href="user_order.php">Orders</a></li>
                                <li><a class="dropdown-item py-3" href="users_client.php">Chat</a></li>
                                <hr>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center text-decoration-none">
                        <a href="user_home.php"
                            class="d-flex justify-content-center align-items-center text-decoration-none">
                            <img src="images/Capstone/logo.png" alt="" class="img-fluid img-logo-nav">
                            <div class="ms-1 C2WAD-text"><strong>C2WAD</strong></div>
                        </a>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center me-1">
                        <div id="bellNotif">

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <div class="section-myProfile p-2 mb-1">
        <div class="container-fluid">
            <div class="profile-box">
                <div class="row" style="">
                    <?php
                    $unique = $_SESSION['unique_id'];
                    $query = "SELECT * FROM user WHERE unique_id = '$unique' ";
                    $query_run = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                        <form action="signUpUser.php" method="POST">
                            <input type="hidden" name="uid" value="<?php echo $row['user_id'] ?>">

                            <div class="col-12 text-center">
                                <span class="h6">MY PROFILE</span>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control shadow-none input-focus-profile" name="firstName"
                                        value="<?php echo $row['firstName'] ?>" id="floatingFirstName"
                                        placeholder="First Name" readonly />
                                    <label for="floatingFirstName" class="text-secondary">First Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control shadow-none input-focus-profile" name="lastName"
                                        value="<?php echo $row['lastName'] ?>" id="floatingLastName" placeholder="Last Name"
                                        readonly />
                                    <label for="floatingLastName" class="text-secondary">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control shadow-none input-focus-profile" name="CP"
                                        value="<?php echo $row['phoneNumber'] ?>" id="floatingCP"
                                        placeholder="Cellphone Number" />
                                    <label for="floatingCP" class="text-secondary">Cellphone Number</label>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" name="updateUser"
                                    class="btn btn-sm btn-place-order text-white">Save</button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>
                <div class="mb-4"></div>
                <div class="row" style="">
                    <?php
                    $unique = $_SESSION['unique_id'];
                    $query = "SELECT * FROM user WHERE unique_id = '$unique' ";
                    $query_run = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                        <form action="signUpUser.php" method="POST">
                            <input type="hidden" name="uid" value="<?php echo $row['user_id'] ?>">

                            <div class="col-12 text-center">
                                <span class="h6">ADDRESS</span>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" name="municipality" id="municipality"
                                        class="form-control shadow-none mb-2" required
                                        value="<?= $row['municipality'] ?>" />
                                    <label for="municipality" class="text-secondary">Municipality</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" name="barangay" id="barangay"
                                        class="form-control shadow-none mb-2" required
                                        value="<?= $row['barangay'] ?>" />
                                    <label for="barangay" class="text-secondary">Barangay</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" name="street" value="<?php echo $row['street'] ?>"
                                        class="form-control shadow-none input-focus-profile" id="floatingStreet"
                                        placeholder="Street" />
                                    <label for="floatingStreet" class="text-secondary">Street</label>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" name="updateAddress"
                                    class="btn btn-place-order btn-sm text-white">Save</button>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>

                <div class="mb-4"></div>
                <div class="row">
                    <form action="signUpUser.php" method="POST">
                        <?php
                        $username = $_SESSION['username'];
                        $query = "SELECT * FROM user WHERE username = '$username' ";
                        $query_run = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <input type="hidden" name="uid" value="<?php echo $row['user_id'] ?>">
                            <?php
                        }
                        ?>

                        <div class="col-12 text-center">
                            <span class="h6">PASSWORD</span>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control shadow-none input-focus-profile"
                                    name="currentPass" id="floatingCurrentPassword" placeholder="Current Password" />
                                <label for="floatingCurrentPassword" class="text-secondary">Current Password</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control shadow-none input-focus-profile"
                                    name="newPass" id="floatingNewPassword" placeholder="New Password" />
                                <label for="floatingNewPassword" class="text-secondary">New Password</label>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" name="updatePass"
                                class="btn btn-sm btn-place-order text-white">Save</button>
                        </div>
                    </form>
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
    <script src="js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationDot = document.getElementById('notificationDot');

            notificationDropdown.addEventListener('click', function () {
                notificationDot.style.display = 'none';
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadNewNotifhome();
            function loadNewNotifhome() {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "get_order_update.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.querySelector("#bellNotif").innerHTML = xhr.responseText;
                        } else {
                        }
                    }
                };
                xhr.send();
            }
            function fetchOrdersPeriodically() {
                loadNewNotifhome();
                setTimeout(fetchOrdersPeriodically, 3000);
            }
            fetchOrdersPeriodically();
        });
    </script>

    <script>
        $(function () {
            // Autocomplete for municipality input
            $("#municipality").autocomplete({
                source: [
                    "Cabagan", "San Pablo", "Tumauini", "Santa Maria", "Sto. Thomas", "Tuguegarao"
                ]
            });

            // Autocomplete for barangay input
            $("#barangay").autocomplete({
                source: [
                    "Aggub", "Anao", "Angancasilian", "Balasig", "Cansan", "Casibarag Norte", "Casibarag Sur",
                    "Catabayungan", "Centro", "Cubag", "Garita", "Luquilu", "Mabangug", "Magassi", "Masipi East",
                    "Masipi West", "Ngarag", "Pilig Abajo", "Pilig Alto", "San Antonio", "San Bernardo", "Saui",
                    "Tallag", "Ugad", "Union",
                    "Annanuman", "Auitan", "Ballacayu", "Binguang", "Bungad", "Dalena", "Caddangan", "Calamagui",
                    "Caralucud", "Guminga", "Limbauan", "Minanga Norte", "Minanga Sur", "San Jose", "Poblacion",
                    "Simanu Norte", "Simanu Sur", "Tupa",
                    "Annafunan East", "Annafunan West", "Atulayan Norte", "Atulayan Sur", "Bagay", "Buntun",
                    "Caggay", "Capatan", "Carig Norte", "Carig Sur", "Caritan Centro", "Caritan Sur", "Cataggaman Nuevo",
                    "Cataggaman Pardo", "Cataggaman Viejo", "Centro 1 (Bagumbayan)", "Centro 2 (Poblacion)", "Centro 3 (Poblacion)",
                    "Centro 4 (Poblacion)", "Centro 5 (Bagumbayan)", "Centro 6 (Poblacion)", "Centro 7 (Poblacion)", "Centro 8 (Poblacion)",
                    "Centro 9 (Bagumbayan)", "Centro 10 (Riverside)", "Centro 11 (Balzain West)", "Centro 12 (Balzain East)",
                    "Dadda", "Gosi Norte", "Gosi Sur", "Larion Alto", "Larion Bajo", "Leonarda", "Libag Norte", "Libag Sur",
                    "Linao Sur", "Linao Norte", "Linao West", "Namabbalan Norte", "Namabbalan Sur", "Pallua Norte",
                    "Pengue-Ruyu", "San Gabriel", "Tagga", "Tanza", "Ugac Norte", "Ugac Sur",
                    "Annafunan", "Antagan I", "Antagan II", "Arcon", "Balug", "Banig", "Bantug", "Barangay District 1 (Poblacion)",
                    "Barangay District 2 (Poblacion)", "Barangay District 3 (Poblacion)", "Barangay District 4 (Poblacion)", "Bayabo East",
                    "Caligayan", "Camasi", "Carapentero", "Compania", "Cumabao", "Fermeldy", "Fugu Abajo", "Fugu Norte",
                    "Fugu Sur", "Lalauan", "Lanna", "Lapogan", "Lingaling", "Liwanag", "Malamag East", "Malamag West",
                    "Maligaya", "Minanga", "Moldero", "Namnama", "Paragu", "Pilitan", "San Mateo", "San Pedro", "San Vicente",
                    "Santa", "Santa Catalina", "Santa Visitacion", "Santa Niño", "Sinippil", "Sisim Abajo", "Sisim Alto",
                    "Tunggui", "Ugad"
                ]
            });
        });
    </script>
</body>

</html>