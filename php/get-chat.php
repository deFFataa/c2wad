<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN user ON user.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        // Fetch all rows into an array
        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

        // Reverse the array to display messages from bottom to top
        $rows = array_reverse($rows);

        foreach ($rows as $row) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output = '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>' . $output;
            } else {
                $output = '<div class="chat incoming">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>' . $output;
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}

?>

<style>
    /* Add this CSS to your stylesheet or in a style tag */
    .chat-container {
        display: flex;
        flex-direction: column-reverse;
        /* Reverse the order of items in the column */
        height: 300px;
        /* Set a fixed height or adjust as needed */
        overflow-y: auto;
        /* Enable vertical scrolling if the container height exceeds the content */
    }

    .chat {
        margin-bottom: 10px;
        /* Add spacing between messages */
    }

    .incoming {
        align-self: flex-start;
        /* Align incoming messages to the start (bottom in a reversed column) */
    }
</style>