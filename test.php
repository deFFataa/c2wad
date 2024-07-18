<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capstone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to send a chat message
function sendChatMessage($sender_id, $receiver_id, $message_content)
{
    global $conn;

    $sql = "INSERT INTO chat_messages (sender_id, receiver_id, message_content) VALUES ('$sender_id', '$receiver_id', '$message_content')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to get chat messages between two users
function getChatMessages($sender_id, $receiver_id)
{
    global $conn;

    $sql = "SELECT * FROM chat_messages WHERE (sender_id = '$sender_id' AND receiver_id = '$receiver_id') OR (sender_id = '$receiver_id' AND receiver_id = '$sender_id') ORDER BY timestamp ASC";

    $result = $conn->query($sql);

    $messages = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    return $messages;
}

// Usage examples:
// Sending a chat message
if (isset($_POST['sender_id']) && isset($_POST['receiver_id']) && isset($_POST['message_content'])) {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message_content = $_POST['message_content'];

    if (sendChatMessage($sender_id, $receiver_id, $message_content)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message.";
    }
}

// Displaying chat messages
if (isset($_GET['sender_id']) && isset($_GET['receiver_id'])) {
    $sender_id = $_GET['sender_id'];
    $receiver_id = $_GET['receiver_id'];

    $messages = getChatMessages($sender_id, $receiver_id);

    foreach ($messages as $message) {
        $sender = $message['sender_id'];
        $receiver = $message['receiver_id'];
        $content = $message['message_content'];
        $timestamp = $message['timestamp'];

        echo "From: $sender, To: $receiver, Message: $content, Timestamp: $timestamp<br>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Chatting System</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Include any necessary CSS styles here -->
    <style>
        /* Style for chat messages container */
        .chat-messages {
            border: 1px solid #ccc;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <h1>Chatting System</h1>

    <!-- Chat messages container -->
    <div class="chat-messages" id="chatMessages">
        <!-- Chat messages will be displayed here dynamically using JavaScript -->
    </div>

    <!-- Chat form -->
    <form id="chatForm">
        <input type="text" name="sender_id" value="1" style="display: none;">
        <input type="text" name="receiver_id" value="2" style="display: none;">
        <input type="text" name="message_content" placeholder="Type your message...">
        <button type="submit">Send</button>
    </form>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript to handle chat functionality -->
    <script>
        // Function to display chat messages
        function displayChatMessages(messages) {
            let chatMessages = $("#chatMessages");
            chatMessages.empty();

            messages.forEach(message => {
                chatMessages.append(`<p><strong>${message.sender_id}</strong>: ${message.message_content}</p>`);
            });

            // Scroll to the bottom of the chat container
            chatMessages.scrollTop(chatMessages[0].scrollHeight);
        }

        // Function to fetch and display chat messages
        function fetchChatMessages() {
            let sender_id = 1; // Replace with the logged-in user ID
            let receiver_id = 2; // Replace with the receiver's user ID

            $.ajax({
                url: "chat.php",
                type: "GET",
                data: { sender_id: sender_id, receiver_id: receiver_id },
                dataType: "json",
                success: function (data) {
                    // Convert the JSON response to a JavaScript array
                    let messages = JSON.parse(data);
                    displayChatMessages(messages);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Function to handle form submission and send chat message
        $("#chatForm").on("submit", function (event) {
            event.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "chat.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    // Refresh chat messages after sending a message
                    fetchChatMessages();
                }
            });

            // Clear the message input field after sending
            $(this)[0].reset();
        });

        // Fetch and display chat messages on page load
        fetchChatMessages();

        // Polling - Fetch and display chat messages periodically (optional for real-time updates)
        setInterval(fetchChatMessages, 5000); // Fetch every 5 seconds (adjust as needed)
    </script>
</body>

</html>