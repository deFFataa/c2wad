<?php
session_start();
include 'conf.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user_rider WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $riderID = $row['rider_id'];
            $unique_id = $row['unique_id'];
            $fullName = $row['fullName'];
            $username = $row['username'];

            mysqli_stmt_close($stmt);
            mysqli_close($con);

            if ($username === 'admin') {
                $_SESSION['username'] = $username;
                $_SESSION['fullName'] = $fullName;
                $_SESSION['unique_id'] = $unique_id;
                $_SESSION['rider_id'] = $riderID;
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $_SESSION['username'] = $username;
                $_SESSION['fullName'] = $fullName;
                $_SESSION['unique_id'] = $unique_id;
                header("Location: rider_list_of_orders.php");
                exit();
            }
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($con);
            $_SESSION['message'] = "Incorrect username or password";
            header("Location: rider_login.php");
            exit();
        }
    } else {
        die("Prepared statement failed: " . mysqli_error($con));
    }
}

if (isset($_POST['updateUser'])) {
    $uid = $_POST['uid'];
    $fullName = $_POST['fullName'];
    $CP = $_POST['CP'];

    $query = "UPDATE `user_rider` SET fullName=?, phoneNumber=? WHERE `rider_id`=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $fullName, $CP, $uid);
    $run = mysqli_stmt_execute($stmt);

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
            alert("There was an error updating the account! Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['updatePass'])) {
    $uid = $_POST['uid'];
    $currentPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];

    $query_one = "SELECT * FROM user_rider WHERE rider_id=? AND password=?";
    $stmt = mysqli_prepare($con, $query_one);
    mysqli_stmt_bind_param($stmt, "ss", $uid, $currentPass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $query_two = "UPDATE user_rider SET password=? WHERE `rider_id`=?";
        $stmt = mysqli_prepare($con, $query_two);
        mysqli_stmt_bind_param($stmt, "si", $newPass, $uid);
        $res = mysqli_stmt_execute($stmt);

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
    } else {
        ?>
        <script>
            alert("Current password doesn't match. Please try again.");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['acceptOrder'])) {
    $user_id = $_POST['user_id'];
    $rider_id = $_POST['rider_id'];
    $order_id = $_POST['order_id'];
    $riderName = $_POST['riderName'];

    $query = "INSERT INTO `rider_orderupdate` (`rider_uid`, `order_uid`, `rider_name`, `order_accept_time`, `rider_location`) VALUES (?, ?, ?, current_timestamp(), 'Order Accepted')";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "iss", $rider_id, $order_id, $riderName);
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        $update_query = "UPDATE `client_order` SET `status` = 'Accepted', `rider_name` = ? WHERE `order_id` = ?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, "si", $riderName, $order_id);
        $update_run = mysqli_stmt_execute($stmt);
        $_SESSION['rider_name'] = $riderName;

        if ($update_run) {
            $notification_content = "Your order has been accepted by $riderName.";
            $insert_notification_sql = "INSERT INTO notifications (user_id, order_id, content) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $insert_notification_sql);
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $order_id, $notification_content);
            mysqli_stmt_execute($stmt);

            ?>
            <script>
                alert("Order Accepted!");
                window.location.href = document.referrer;
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Error Updating Order Status");
                window.location.href = document.referrer;
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Error");
            window.location.href = document.referrer;
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['updateLocation'])) {
    $order_id = $_POST['order_id'];
    $rider_id = $_POST['rider_id'];
    $client_id = $_POST['client_id'];
    $locationName = $_POST['locationName'];

    $query = "INSERT INTO rider_orderupdate (rider_uid, order_uid, rider_location, location_time) VALUES (?, ?, ?, current_timestamp())";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "iss", $rider_id, $order_id, $locationName);
    $run = mysqli_stmt_execute($stmt);

    $content = "The rider is on its way to your address.";

    if ($locationName == "Out for Delivery") {
        $notifInsert = "INSERT INTO notifications (user_id, order_id, content, status, timestamp) VALUES ('$client_id', '$order_id', '$content', 'unread', current_timestamp())";
        $runNotf = mysqli_query($con, $notifInsert);
    } else if ($locationName == "Delivered") {
        $contentDelivered = "Your order has been delivered.";
        $notifInsert = "INSERT INTO notifications (user_id, order_id, content, status, timestamp) VALUES ('$client_id', '$order_id', '$contentDelivered', 'unread', current_timestamp())";
        $runNotf = mysqli_query($con, $notifInsert);
    } else {
        echo "";
    }

    if ($run) {
        ?>
        <script>
            alert("Successfully Updated Location!");
            window.location.href = document.referrer;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Error Updated Location");
            window.location.href = document.referrer;
            <?php
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['uploadProof'])) {
    $order_id = $_POST['order_id'];

    $upload_dir = 'images/ProofOrder/';
    $uploaded_file = $_FILES['proof']['tmp_name'];
    $file_name = $_FILES['proof']['name'];
    $destination = $upload_dir . $file_name;

    if (move_uploaded_file($uploaded_file, $destination)) {
        $update_query = "UPDATE client_order SET proof=? WHERE order_id=?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, "si", $destination, $order_id);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            echo '<script>alert("Congratulations on completing the order"); window.location.href = document.referrer;</script>';
        } else {
            echo '<script>alert("Error"); window.location.href = document.referrer;</script>';
        }
    } else {
        echo '<script>alert("Error uploading the file! Please try again."); window.location.href = document.referrer;</script>';
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['terminateOrder'])) {
    $order_id = $_POST['order_id'];
    $reason = $_POST['reasonCancel'];

    $query = "UPDATE client_order SET status = 'Cancelled', reason = ? WHERE order_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "si", $reason, $order_id);
    $run = mysqli_stmt_execute($stmt);

    if ($run) {
        echo '<script>alert("Order Terminated"); window.location.href = document.referrer;</script>';
    } else {
        echo '<script>alert("There was an error"); window.location.href = document.referrer;</script>';
    }

    mysqli_stmt_close($stmt);
}
?>