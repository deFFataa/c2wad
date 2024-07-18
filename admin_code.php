<?php
session_start();
include 'conf.php';

if (isset($_POST['accept-client'])) {
    $id = $_POST['uid'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $facebook = $_POST['facebook'];
    $phone = $_POST['phone'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $street = $_POST['street'];

    $ran_id = rand(time(), 100000000);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (unique_id, username, password, firstName, lastName, sex, municipality, barangay, street, fblink, phoneNumber, account_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'activated')";

    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'sssssssssss', $ran_id, $username, $hashed_password, $firstname, $lastname, $sex, $municipality, $barangay, $street, $facebook, $phone);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Accepted!")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }

    $query_two = "DELETE FROM temp_user WHERE id = ?";
    $stmt_two = mysqli_prepare($con, $query_two);

    mysqli_stmt_bind_param($stmt_two, 'i', $id);

    mysqli_stmt_execute($stmt_two);
}



if (isset($_POST['decline-client'])) {
    $uid = $_POST['uid'];

    $query = "DELETE FROM temp_user WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'i', $uid);

    $query_two_run = mysqli_stmt_execute($stmt);

    if ($query_two_run) {
        ?>
        <script>
            alert("Account Declined!")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }
}

if (isset($_POST['decline-rider'])) {
    $uid = $_POST['uid'];

    $query = "DELETE FROM temp_rider WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'i', $uid);

    $query_two_run = mysqli_stmt_execute($stmt);

    if ($query_two_run) {
        ?>
        <script>
            alert("Account Declined!")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }
}

if (isset($_POST['update-acc-admin'])) {
    $id = $_POST['uid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $facebook = $_POST['facebook'];
    $phone = $_POST['phone'];
    $accountStat = $_POST['accountStat'];

    $query = "UPDATE user SET firstName = ?, lastName = ?, fblink = ?, phoneNumber = ?, account_status = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'sssssi', $firstname, $lastname, $facebook, $phone, $accountStat, $id);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Updated!")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error updating the account! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }
}

if (isset($_POST['update-accRider-admin'])) {
    $id = $_POST['uid'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullName = $_POST['fullName'];
    $facebook = $_POST['facebook'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    $query = "UPDATE user_rider SET username = ?, password = ?, fullName = ?, fblink = ?, phoneNumber = ?, account_status = ? WHERE rider_id = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'ssssssi', $username, $password, $fullName, $facebook, $phone, $status, $id);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Updated!")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error updating the account! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }
}

if (isset($_POST['delete-acc-client'])) {
    $id = $_POST['uid'];

    $query = "DELETE FROM user WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'i', $id);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Deleted.")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error deleting the account! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }
}

if (isset($_POST['delete-riderAcc-client'])) {
    $id = $_POST['uid'];

    $query = "DELETE FROM user_rider WHERE rider_id = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'i', $id);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Deleted.")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error deleting the account! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }
}

if (isset($_POST['add-acc-on-admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastName'];
    $sex = $_POST['sex'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $street = $_POST['street'];
    $facebook = $_POST['facebook'];
    $phone = $_POST['phone'];
    $status = 'Activated';

    $ran_id = rand(time(), 100000000);

    $query = "INSERT INTO user (unique_id, username, password, firstName, lastName, sex, municipality, barangay, street, fblink, phoneNumber, account_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'ssssssssssss', $ran_id, $username, $password, $firstname, $lastname, $sex, $municipality, $barangay, $street, $facebook, $phone, $status);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Added Successfully")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error adding the account! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }

}

if (isset($_POST['add-riderAcc-on-admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullName = $_POST['fullname'];
    $sex = $_POST['sex'];
    $facebook = $_POST['facebook'];
    $phone = $_POST['phone'];
    $ran_id = rand(time(), 100000000);

    $uploadDir = 'images/IDForRider/';
    $COR = $uploadDir . basename($_FILES['COR']['name']);
    $ORM = $uploadDir . basename($_FILES['ORMO']['name']);
    $driverLicense = $uploadDir . basename($_FILES['license']['name']);

    move_uploaded_file($_FILES['COR']['tmp_name'], $COR);
    move_uploaded_file($_FILES['ORMO']['tmp_name'], $ORM);
    move_uploaded_file($_FILES['license']['tmp_name'], $driverLicense);

    $query = "INSERT INTO user_rider (unique_id, username, password, fullName, sex, fblink, phoneNumber, account_status, COR, ORM, driverLicense) VALUES (?, ?, ?, ?, ?, ?, ?, 'Activated', ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'ssssssssss', $ran_id, $username, $password, $fullName, $sex, $facebook, $phone, $COR, $ORM, $driverLicense);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Added Successfully")
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error updating the account! Please try again.")
            window.location.href = document.referrer;
        </script>
        <?php
    }
}

function acceptRequest($requestId)
{
    global $con;

    $query = "SELECT * FROM temp_user WHERE id=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $requestId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $insertQuery = "INSERT INTO user (firstName, lastName, sex, fbLink, phoneNumber, status) VALUES (?, ?, ?, ?, ?, 'activated')";
    $insertStmt = mysqli_prepare($con, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, 'sssss', $row['firstName'], $row['lastName'], $row['sex'], $row['facebook'], $row['phoneNumber']);
    mysqli_stmt_execute($insertStmt);

    $deleteQuery = "DELETE FROM temp_user WHERE id=?";
    $deleteStmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($deleteStmt, 'i', $requestId);
    mysqli_stmt_execute($deleteStmt);
}

if (isset($_POST['accept-all'])) {
    $query = "SELECT * FROM temp_user";
    $query_run = mysqli_query($con, $query);
    $row_count = mysqli_num_rows($query_run);

    if ($row_count > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            acceptRequest($row['id']);
        }

        header("Location: admin_accounts_request.php");
        exit();
    } else {
        ?>
        <script>
            alert("There was an error! Please try again.")
            window.location.href = document.referrer
        </script>
        <?php
    }
}


if (isset($_POST['accept-rider'])) {
    $id = $_POST['uid'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $facebook = $_POST['facebook'];
    $phone = $_POST['phone'];
    $COR = $_POST['COR'];
    $ORM = $_POST['ORM'];
    $license = $_POST['DLicense'];
    $ran_id = rand(time(), 100000000);
    $full_name = $firstname . ' ' . $lastname;
    $status = 'Deactivated';

    $query = "INSERT INTO user_rider (unique_id, username, password, fullName, sex, fblink, phoneNumber, account_status, COR, ORM, driverLicense) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssssss', $ran_id, $username, $password, $full_name, $sex, $facebook, $phone, $status, $COR, $ORM, $license);

    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        ?>
        <script>
            alert("Account Accepted!")
            window.location.href = document.referrer
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error updating the account! Please try again.")
            window.location.href = document.referrer
        </script>
        <?php
    }

    $query_two = "DELETE FROM temp_rider WHERE id = ?";
    $stmt_two = mysqli_prepare($con, $query_two);
    mysqli_stmt_bind_param($stmt_two, 'i', $id);
    $query_two_run = mysqli_stmt_execute($stmt_two);
}

function updateRiderDay($con, $selectedRiders, $newDay)
{
    if (isset($selectedRiders) && is_array($selectedRiders)) {
        foreach ($selectedRiders as $rider_id) {
            $queryCheck = "SELECT day1, day2 FROM user_rider WHERE rider_id = ?";
            $stmtCheck = mysqli_prepare($con, $queryCheck);
            mysqli_stmt_bind_param($stmtCheck, 'i', $rider_id);
            mysqli_stmt_execute($stmtCheck);
            mysqli_stmt_bind_result($stmtCheck, $currentDay1, $currentDay2);
            mysqli_stmt_fetch($stmtCheck);
            mysqli_stmt_close($stmtCheck);

            if (empty($currentDay1)) {
                $dayToUpdate = 'day1';
            } elseif (empty($currentDay2)) {
                $dayToUpdate = 'day2';
            } else {
                continue;
            }

            $queryUpdate = "UPDATE user_rider SET $dayToUpdate = ? WHERE rider_id = ?";
            $stmtUpdate = mysqli_prepare($con, $queryUpdate);

            mysqli_stmt_bind_param($stmtUpdate, 'si', $newDay, $rider_id);
            $run = mysqli_stmt_execute($stmtUpdate);
            mysqli_stmt_close($stmtUpdate);
        }
        ?>
        <script>
            alert("Success!")
            window.location.href = document.referrer
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error! Please try again.")
            window.location.href = document.referrer
        </script>
        <?php
    }
}


if (isset($_POST['saveQue'])) {
    updateRiderDay($con, $_POST['selectedRiders'], 'Monday');
} elseif (isset($_POST['saveQueTuesday'])) {
    updateRiderDay($con, $_POST['selectedRiders'], 'Tuesday');
} elseif (isset($_POST['saveQueWednesday'])) {
    updateRiderDay($con, $_POST['selectedRiders'], 'Wednesday');
} elseif (isset($_POST['saveQueThursday'])) {
    updateRiderDay($con, $_POST['selectedRiders'], 'Thursday');
} elseif (isset($_POST['saveQueFriday'])) {
    updateRiderDay($con, $_POST['selectedRiders'], 'Friday');
} elseif (isset($_POST['saveQueSaturday'])) {
    updateRiderDay($con, $_POST['selectedRiders'], 'Saturday');
} elseif (isset($_POST['saveQueSunday'])) {
    updateRiderDay($con, $_POST['selectedRiders'], 'Sunday');
}


function removeRidersByDay($con, $day)
{
    $query = "UPDATE user_rider SET day1 = '' WHERE day1 = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $day);
    $run = mysqli_stmt_execute($stmt);

    $queryDay2 = "UPDATE user_rider SET day2 = '' WHERE day2 = ?";
    $stmtDay2 = mysqli_prepare($con, $queryDay2);
    mysqli_stmt_bind_param($stmtDay2, 's', $day);
    $runDay2 = mysqli_stmt_execute($stmtDay2);

    if ($run || $runDay2) {
        ?>
        <script>
            alert("Success!");
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("There was an error updating the account! Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmtDay2);
}

function removeRiderByDay($con, $rider_id, $day)
{
    $queryCheck = "SELECT day1, day2 FROM user_rider WHERE rider_id = ?";
    $stmtCheck = mysqli_prepare($con, $queryCheck);
    mysqli_stmt_bind_param($stmtCheck, 'i', $rider_id);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_bind_result($stmtCheck, $currentDay1, $currentDay2);
    mysqli_stmt_fetch($stmtCheck);
    mysqli_stmt_close($stmtCheck);

    if ($currentDay1 === $day) {
        $columnToUpdate = 'day1';
    } elseif ($currentDay2 === $day) {
        $columnToUpdate = 'day2';
    } else {
        ?>
        <script>
            alert("The specified day is not assigned to the rider!");
            window.location.href = document.referrer;
        </script>
        <?php
        exit();
    }

    $query = "UPDATE user_rider SET $columnToUpdate = '' WHERE rider_id = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $rider_id);
        $run = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($run) {
            ?>
            <script>
                alert("Success!");
                window.location.href = document.referrer;
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("There was an error updating the account! Please try again.");
                window.location.href = document.referrer;
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Database error! Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    exit();
}

if (isset($_POST['removeQueMonday'])) {
    removeRiderByDay($con, $_POST['rider_id'], 'Monday');
} elseif (isset($_POST['removeQueTuesday'])) {
    removeRiderByDay($con, $_POST['rider_id'], 'Tuesday');
} elseif (isset($_POST['removeQueWednesday'])) {
    removeRiderByDay($con, $_POST['rider_id'], 'Wednesday');
} elseif (isset($_POST['removeQueThursday'])) {
    removeRiderByDay($con, $_POST['rider_id'], 'Thursday');
} elseif (isset($_POST['removeQueFriday'])) {
    removeRiderByDay($con, $_POST['rider_id'], 'Friday');
} elseif (isset($_POST['removeQueSaturday'])) {
    removeRiderByDay($con, $_POST['rider_id'], 'Saturday');
} elseif (isset($_POST['removeQueSunday'])) {
    removeRiderByDay($con, $_POST['rider_id'], 'Sunday');
}


if (isset($_POST['removeAllRiderQMonday'])) {
    removeRidersByDay($con, 'Monday');
}

if (isset($_POST['removeAllRiderQTuesday'])) {
    removeRidersByDay($con, 'Tuesday');
}

if (isset($_POST['removeAllRiderQWednesday'])) {
    removeRidersByDay($con, 'Wednesday');
}

if (isset($_POST['removeAllRiderQThursday'])) {
    removeRidersByDay($con, 'Thursday');
}

if (isset($_POST['removeAllRiderQFriday'])) {
    removeRidersByDay($con, 'Friday');
}

if (isset($_POST['removeAllRiderQSaturday'])) {
    removeRidersByDay($con, 'Saturday');
}

if (isset($_POST['removeAllRiderQSunday'])) {
    removeRidersByDay($con, 'Sunday');
}


if (isset($_POST['updatePass'])) {
    $riderID = $_POST['riderID'];
    $newPass = $_POST['password'];

    $query_one = "UPDATE user_rider SET password = ? WHERE rider_id = ?";
    $stmt = mysqli_prepare($con, $query_one);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'si', $newPass, $riderID);
        $run = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($run) {
            ?>
            <script>
                alert("Password Updated!")
                window.location.href = document.referrer;
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("There was an error updating your password! Please try again.")
                window.location.href = document.referrer;
            </script>
            <?php
        }
    }
}
