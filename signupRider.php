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
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="container vh-100">
        <div class="d-flex flex-column align-items-center justify-content-center overflow-hidden"
            id="container-fluid-index">
            <div class="icon--header">
                <img src="images/Capstone/logo.png" alt="logo" class="img-fluid img-logo" />
                <h4 class="fw-bold">BE A RIDER</h4>
            </div>
            <div class="username-box">
                <form action="signUpUser.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-1">
                                <input type="text" name="firstname" class="form-control shadow-none" id="floatingInput"
                                    placeholder="Firstname" />
                                <label for="floatingInput" class="text-secondary">Firstname</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="text" name="lastname" class="form-control shadow-none" id="floatingInput"
                                    placeholder="Last name" />
                                <label for="floatingInput" class="text-secondary">Last Name</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <select name="sex" class="form-floating form-select text-secondary mb-2"
                                style="height: 3.68rem;" aria-label="Default select example">
                                <option selected disabled>Sex</option>
                                <option value="Male">M</option>
                                <option value="Female">F</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="text" name="facebook" class="form-control shadow-none" id="floatingInput"
                                    placeholder="Last name" />
                                <label for="floatingInput" class="text-secondary">Facebook Link</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" name="phoneNumber" class="form-control shadow-none"
                                    id="floatingInput" placeholder="Phone Number" />
                                <label for="floatingInput" class="text-secondary">Phone Number</label>
                            </div>
                        </div>
                        <h4 class="text-center fw-bold my-3">Attach Requirements</h4>
                        <div class="col-lg-4">
                            <div class="form-floating mb-2">
                                <input type="file" name="COR" class="form-control shadow-none" id="floatingInput"
                                    placeholder="Last name" />
                                <label for="floatingInput" class="text-secondary">Certificate of Registration</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-2">
                                <input type="file" name="ORMO" class="form-control shadow-none" id="floatingInput"
                                    placeholder="Last name" />
                                <label for="floatingInput" class="text-secondary">Official Receipt of Motorcycle</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-2">
                                <input type="file" name="license" class="form-control shadow-none" id="floatingInput"
                                    placeholder="Last name" />
                                <label for="floatingInput" class="text-secondary">Driver's License</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submitRider" class="btn btn-login fw-bold text-white mt-3">
                        SUBMIT
                    </button>
                    <p class="text-secondary desc-account text-center">
                        Already have an account?
                        <a href="index.php" class="signUpUser">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>