<?php
session_start();
include_once "conf.php";
if (!isset($_SESSION['unique_id']) && !isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | Chat</title>
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
    <div class="wrapper p-3 mb-1" style="margin-top: 1rem;">
        <section class="users">
            <header>
                <div class="content">
                </div>
            </header>
            <div class="search">
                <span class="text">Select rider to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button class=""><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
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
    <script src="js/users.js"></script>

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
</body>

</html>