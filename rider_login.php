<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col d-flex flex-column align-items-center justify-content-center overflow-hidden vh-100"
                id="container-fluid-index">
                <div class="icon--header">
                    <img src="images/Capstone/logo.png" alt="logo" class="img-fluid img-logo" />
                    <h4 class="fw-bold">RIDER LOGIN</h4>
                </div>
                <div class="username-box">
                    <?php include 'message.php' ?>
                    <form action="rider_code.php" method="post">
                        <div class="form-floating mb-1">
                            <input type="text" name="username" class="form-control shadow-none" id="floatingInput"
                                placeholder="Enter Username" style="width: 20rem !important;" />
                            <label for="floatingInput" class="text-secondary">Username</label>
                        </div>

                        <div class="form-floating mb-2 d-flex">
                            <input type="password" name="password" class="form-control shadow-none"
                                id="floatingPassword" placeholder="Enter Password" style="width: 20rem !important;">
                            <label for="floatingPassword" class="text-secondary">Password</label>
                            <div class="input-group-append position-absolute end-0 align-self-center">
                                <button class="btn" type="button" id="showPasswordBtn">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" name="login" class="btn btn-login fw-bold text-white">
                            LOGIN
                        </button>
                        <p class="text-secondary desc-account text-center">
                            Are you a client?
                            <a href="index.php" class="signUpUser">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const showPasswordBtn = document.getElementById('showPasswordBtn');

            showPasswordBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    showPasswordBtn.html = '<i class="fa-solid fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    showPasswordBtn.html = '<i class="fa-solid fa-eye-slash"></i>';
                }
            });
        });
    </script>
</body>

</html>