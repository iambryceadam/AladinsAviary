<?php
include 'chat_functions.php';

$currentDate = date('mdY');
$customMessageID = generateCustomMessageID($conn, $currentDate);

$content = "";
$image_data = "";
$senderId = 'ADMIN';

if (isset($_POST['send'])) {
    $content = $_POST['message'];
    $receiverId = $_POST['receiver_id'];
    $message =  $content;

    // Check if image data is provided
    if (isset($_POST['imageData']) && !empty($_POST['imageData'])) {
        $image = base64_encode($_POST['imageData']);
        //$image = NULL;
        //$image_name = mysqli_real_escape_string($conn, $image['name']);
        //$image_data = file_get_contents($image['tmp_name']);
        //$image_data = mysqli_real_escape_string($conn, $image_data);
        $conn->query("INSERT INTO tbl_messages (message_id, user_sender_id, user_receiver_id, message, image, read_status) VALUES ('$customMessageID', '$senderId', '$receiverId', '$message', '$image', 'unread')");
        $message .= '<div class="chat-sent-image-container"><img src="' . $imgData . '" alt="Attached Image" class="chat-sent-images" /></div>';
    } else{
        $image_data = NULL;
        $conn->query("INSERT INTO tbl_messages (message_id, user_sender_id, user_receiver_id, message, image, read_status) VALUES ('$customMessageID', '$senderId', '$receiverId', '$message', '$image_data', 'unread')");
    }
}

function generateCustomMessageID($conn, $currentDate) {
    // Get the maximum receiver number from the database
    $checkReceiver = "SELECT MAX(CAST(SUBSTRING(message_id, 12) AS UNSIGNED)) AS max_receiver FROM tbl_messages";
    $result = mysqli_query($conn, $checkReceiver);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $maxReceiver = $row['max_receiver'];

        if (!is_null($maxReceiver)) {
            $receiverID = (int)$maxReceiver + 1;
        } else {
            $receiverID = 1;
        }
    } else {
        $receiverID = 1;
    }

    // Determine the number of digits in the receiver ID
    $numDigits = strlen((string)$receiverID);

    // Create a formatted receiver ID with leading zeros
    $formattedReceiverID = $receiverID;

    $customMessageID = "MSG" . $currentDate . $formattedReceiverID;
    return $customMessageID;
}

?>