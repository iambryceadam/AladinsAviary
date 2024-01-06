<?php
include 'connection.php';

function getProfileImage($userId) {
    global $conn;
    $result = $conn->query("SELECT img_profile FROM tbl_clients WHERE client_id = '$userId'");
    
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['img_profile'];
    } else {
        return 'images/app_icon.png'; // Provide a default image path if there's an error or no image found
    }
}

function getUserInfo($userId){
    global $conn;
    $result = $conn->query("SELECT * FROM tbl_clients WHERE client_id = '$userId'");
    
    if ($result) {
        $row = $result->fetch_assoc();
        return $row;
    }
}

function getUsers($userId) {
    global $conn;
    $result = $conn->query("SELECT * FROM tbl_clients WHERE client_id = '$userId'");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getMessages($sender, $receiver) {
    global $conn;
    $result = $conn->query("SELECT * FROM tbl_messages WHERE (user_sender_id = '$sender' AND user_receiver_id = '$receiver') OR (user_sender_id = '$receiver' AND user_receiver_id = '$sender') ORDER BY timestamp");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// function sendMessage($message_ID, $sender, $receiver, $message, $image, $status) {
//     global $conn;
//     $conn->query("INSERT INTO tbl_messages (message_id, user_sender_id, user_receiver_id, message, image, read_status) VALUES ('$message_ID', '$sender', '$receiver', '$message', '$image', 'unread')");
// }

function searchUsers($searchTerm) {
    global $conn;
    $searchTerm = $conn->real_escape_string($searchTerm);

    $query = "SELECT * FROM tbl_clients WHERE CONCAT(first_name, ' ', last_name) LIKE '%$searchTerm%'";
    $result = $conn->query($query);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateMessageStatus($messageId, $status) {
    global $conn;

    $updateStatusQuery = "UPDATE tbl_messages SET read_status = ? WHERE message_id = ?";
    $stmt = mysqli_prepare($conn, $updateStatusQuery);
    mysqli_stmt_bind_param($stmt, 'ss', $status, $messageId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function markReadMessages($receiverId) {
    global $conn;

    $updateStatusQuery = "UPDATE tbl_messages SET read_status = 'read' WHERE user_sender_id = ? AND read_status = 'unread'";
    $stmt = mysqli_prepare($conn, $updateStatusQuery);
    mysqli_stmt_bind_param($stmt, 's', $receiverId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getUsersWithRecentMessage($loggedInUserId) {
    global $conn;

    $query = "SELECT
            tbl_clients.client_id,
            tbl_clients.first_name,
            tbl_clients.last_name,
            tbl_clients.img_profile,
            MAX(tbl_messages.timestamp) AS recent_timestamp,
            MAX(CASE WHEN (tbl_messages.user_sender_id = 'ADMIN' OR tbl_messages.user_sender_id = '$loggedInUserId') THEN NULL ELSE tbl_messages.read_status END) AS read_status
          FROM tbl_clients
          LEFT JOIN tbl_messages ON (tbl_clients.client_id = tbl_messages.user_sender_id OR tbl_clients.client_id = tbl_messages.user_receiver_id)
          WHERE tbl_clients.client_id != '$loggedInUserId'
            AND ((tbl_messages.user_receiver_id = 'ADMIN' OR tbl_messages.user_receiver_id IS NULL) -- Include users with no messages
            OR (tbl_messages.user_receiver_id != 'ADMIN' OR tbl_messages.user_receiver_id IS NULL)) 
          GROUP BY tbl_clients.client_id
          ORDER BY recent_timestamp DESC";


    $result = $conn->query($query);

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        // Handle the query error
        die("Error: " . $conn->error);
    }
}



?>