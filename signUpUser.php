<?php
session_start();
include 'conf.php';

if (isset($_POST['submitUser'])) {

    function handleFileUpload($fieldName, $targetDir) {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fieldName]['tmp_name'];
            $fileName = $_FILES[$fieldName]['name'];
            $targetFilePath = $targetDir . basename($fileName);

            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                return $targetFilePath;
            } else {
                ?>
                <script>
                    alert("There was an error uploading the file. Please try again.");
                    window.location.href = document.referrer;
                </script>
                <?php
                exit();
            }
        } else {
            ?>
            <script>
                alert("Error: <?php echo $_FILES[$fieldName]['error']; ?>");
                window.location.href = document.referrer;
            </script>
            <?php
            exit();
        }
    }

    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastName']);
    $sex = mysqli_real_escape_string($con, $_POST['sex']);
    $fbLink = mysqli_real_escape_string($con, $_POST['facebook']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    $municipality = mysqli_real_escape_string($con, $_POST['municipality']);
    $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
    $street = mysqli_real_escape_string($con, $_POST['street']);

    $targetDir = "images/IDForClient/";
    $idCardPath = handleFileUpload("idCard", $targetDir);

    $checkUserQuery = "SELECT username FROM user WHERE username = ? UNION SELECT username FROM temp_user WHERE username = ?";
    $checkUserStmt = mysqli_stmt_init($con);

    if (mysqli_stmt_prepare($checkUserStmt, $checkUserQuery)) {
        mysqli_stmt_bind_param($checkUserStmt, "ss", $username, $username);
        mysqli_stmt_execute($checkUserStmt);
        mysqli_stmt_store_result($checkUserStmt);

        if (mysqli_stmt_num_rows($checkUserStmt) > 0) {
            ?>
            <script>
                alert("Username is already taken. Please choose a different username.");
                window.location.href = document.referrer;
            </script>
            <?php
            exit();
        }
    } else {
        ?>
        <script>
            alert("Error checking existing username in user and temp_user tables");
            window.location.href = document.referrer;
        </script>
        <?php
        exit();
    }

    mysqli_stmt_close($checkUserStmt);

    $query = "INSERT INTO temp_user (username, password, firstName, lastName, municipality, barangay, street, sex, fblink, phoneNumber, idPic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($con);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssssssss", $username, $password, $firstname, $lastname, $municipality, $barangay, $street, $sex, $fbLink, $phoneNumber, $idCardPath);

        if (mysqli_stmt_execute($stmt)) {
            ?>
            <script>
                alert("Your Account was submitted. Please wait for us to verify your account.");
                window.location.href = document.referrer;
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Error executing the query");
                window.location.href = document.referrer;
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Error creating prepared statement");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

if (isset($_POST['submitRider'])) {

    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $sex = mysqli_real_escape_string($con, $_POST['sex']);
    $fbLink = mysqli_real_escape_string($con, $_POST['facebook']);
    $phone = mysqli_real_escape_string($con, $_POST['phoneNumber']);

    function uploadFile($fieldName, $targetDir)
    {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fieldName]['tmp_name'];
            $fileName = $_FILES[$fieldName]['name'];
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                return $targetFilePath;
            } else {
                ?>
                <script>
                    alert("There was an error on uploading the file. Please try again.")
                    window.location.href = document.referrer
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("There was an error on uploading the file. Please try again.")
                window.location.href = document.referrer
            </script>
            <?php
        }

        return null;
    }

    $targetDir = "images/IDForRider/";

    $corPath = uploadFile('COR', $targetDir);
    $ormoPath = uploadFile('ORMO', $targetDir);
    $licensePath = uploadFile('license', $targetDir);

    $query = "INSERT INTO temp_rider (firstName, lastName, sex, fbLink, phoneNumber, COR, ORM, driverLicense)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($con);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $firstname, $lastname, $sex, $fbLink, $phone, $corPath, $ormoPath, $licensePath);

        if (mysqli_stmt_execute($stmt)) {
            ?>
            <script>
                alert("Your Account was submitted. Please wait for us to verify your account.");
                window.location.href = document.referrer
            </script>
            <?php
        } else {
            echo "Error executing the query: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error creating prepared statement: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT user_id, unique_id, password FROM user WHERE username = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];

            if (password_verify($password, $hashed_password)) {
                mysqli_stmt_close($stmt);
                mysqli_close($con);

                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $username;
                $_SESSION['unique_id'] = $row['unique_id'];

                header("Location: user_home.php");
                exit();
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);

        session_start();
        $_SESSION['message'] = "Incorrect username or password";
        header("Location: index.php");
        exit();
    } else {
        die("Prepared statement failed: " . mysqli_error($con));
    }
}


if (isset($_POST['updateUser'])) {
    $uid = $_POST['uid'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $CP = $_POST['CP'];

    $query = "UPDATE `user` SET firstName = ?, lastName = ?, phoneNumber = ? WHERE `user_id` = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssi', $firstName, $lastName, $CP, $uid);
        $run = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($run) {
            ?>
            <script>
                alert("Account Updated!");
                window.location.href = document.referrer;
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("There was an error updating your account. Please try again.");
                window.location.href = document.referrer;
            </script>
            <?php
        }
    }
}

if (isset($_POST['updatePass'])) {
    $uid = $_POST['uid'];
    $currentPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];

    $query_one = "SELECT * FROM user WHERE user_id = ?";
    $stmt_one = mysqli_prepare($con, $query_one);

    if ($stmt_one) {
        mysqli_stmt_bind_param($stmt_one, 'i', $uid);
        mysqli_stmt_execute($stmt_one);
        $result = mysqli_stmt_get_result($stmt_one);

        if ($row = mysqli_fetch_assoc($result)) {
            $storedHashedPassword = $row['password'];

            if (password_verify($currentPass, $storedHashedPassword)) {
                $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);

                $query_two = "UPDATE user SET password = ? WHERE user_id = ?";
                $stmt_two = mysqli_prepare($con, $query_two);

                if ($stmt_two) {
                    mysqli_stmt_bind_param($stmt_two, 'si', $hashedNewPass, $uid);
                    $res = mysqli_stmt_execute($stmt_two);
                    mysqli_stmt_close($stmt_two);

                    if ($res) {
                        ?>
                        <script>
                            alert("Password Updated!");
                            window.location.href = document.referrer;
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert("Password update failed. Please try again.");
                            window.location.href = document.referrer;
                        </script>
                        <?php
                    }
                }
            } else {
                ?>
                <script>
                    alert("Current password doesn't match. Please try again.");
                    window.location.href = document.referrer;
                </script>
                <?php
            }
        }

        mysqli_stmt_close($stmt_one);
    }
}


if (isset($_POST['updateAddress'])) {
    $uid = $_POST['uid'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $street = $_POST['street'];

    $query = "UPDATE user SET municipality=?, barangay=?, street=? WHERE user_id=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $municipality, $barangay, $street, $uid);
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Address Updated!");
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error updating your address. Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['placeOrder'])) {
    $uid = $_POST['uid'];
    $name = $_POST['client_name'];
    $orderLoc = $_POST['locName'];
    $orderDetails = $_POST['orderDetails'];
    $payment = $_POST['payment_method'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $landmark = $_POST['landmark'];
    $street = $_POST['Street'];
    $CP = $_POST['CP'];
    $status = 'Pending';

    $query = "INSERT INTO `client_order` (`order_uid`, `client_name`, `phoneNumber`, `order_location`, `order_detail`, `order_payment`, `municipality`, `barangay`, `street`, `landmark`, `status`, `order_placeTime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP())";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "issssssssss", $uid, $name, $CP, $orderLoc, $orderDetails, $payment, $municipality, $barangay, $street, $landmark, $status);
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Order Submitted");
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error submitting an order. Please try again");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['updateOrder'])) {
    $uid = $_POST['uid'];
    $orderLoc = $_POST['order_location'];
    $orderDetails = $_POST['order_detail'];
    $payment = $_POST['payment_method'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $street = $_POST['street'];

    $query = "UPDATE `client_order` SET `order_location`=?, `order_detail`=?, `order_payment`=?, `municipality`=?, `barangay`=?, `street`=? WHERE `client_order`.`order_id`=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssssssi", $orderLoc, $orderDetails, $payment, $municipality, $barangay, $street, $uid);
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Order Updated!");
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error updating your order. Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['cancelOrder'])) {
    $uid = $_POST['uid'];

    $query = "DELETE FROM `client_order` WHERE `client_order`.`order_id`=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $uid);
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Order Cancelled!");
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error cancelling your order. Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['receivedOrder'])) {
    $order_id = $_POST['order_id'];

    $rating_name = 'rating_' . $order_id;
    $rating = $_POST[$rating_name];
    $rating_comment = $_POST['rating_comment'];

    $query = "UPDATE client_order SET status='Delivered', client_rating=?, rating_comment=? WHERE order_id=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "dss", $rating, $rating_comment, $order_id);
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Thank you for the rating");
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error rating the service. Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

?>