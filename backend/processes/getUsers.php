<?php
include 'chat_functions.php';

$loggedInUserId = 'ADMIN'; // Replace with the logged-in user's ID
$users = getUsersWithRecentMessage($loggedInUserId);

foreach ($users as $user) {
    $encoded_image_url = base64_encode($user['img_profile']);
    $userId = $user['client_id'];
    $userName = $user['first_name'] . ' ' . $user['last_name'];
    $readStatus = $user['read_status'];

    // Determine the class for the indicator based on the read status
    $indicatorClass = ($readStatus == 'unread') ? 'unread-indicator' : 'read-indicator';

    echo "<div class='user' data-user-id='$userId'>
            <div class='chat-profile-img'>
                <img src='data:image/jpeg;base64,$encoded_image_url'></img>
            </div>
            <div class='chat-profile-name'>
                $userName
            </div>
            <div class='message-indicator $indicatorClass'><i class='bx bxs-message-square-error' ></i></div>
          </div>";
}
?>
