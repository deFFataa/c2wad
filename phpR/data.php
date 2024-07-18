<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = ? OR outgoing_msg_id = ?)
    AND (outgoing_msg_id = ? OR incoming_msg_id = ?) ORDER BY msg_id DESC LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt, "iiii", $row['unique_id'], $row['unique_id'], $outgoing_id, $outgoing_id);
    mysqli_stmt_execute($stmt);
    $query2 = mysqli_stmt_get_result($stmt);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
    (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="chat_rider.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <i class="fa-solid fa-user user-icon" style="color: black"></i>
                    <div class="details">
                        <span>' . $row['fullName'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                </a>';
}
?>