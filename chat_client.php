<?php
session_start();
include_once "conf.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client | Chat</title>
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
        </nav>
    </section>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
                $sql = mysqli_query($con, "SELECT * FROM user_rider WHERE unique_id = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                } else {
                    header("location: users_client.php");
                }
                ?>
                <a href="users_client.php" class="back-icon"><i class="fas fa-arrow-left pe-3"></i></a>
                <div class="details">
                    <span>
                        <?php echo $row['fullName'] ?>
                    </span>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                    autocomplete="off">
                <button class="btn-send-message"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="js/chat.js"></script>
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