<?php
include 'chat_functions.php';

if (isset($_GET['receiver_id'])) {
    $receiverId = $_GET['receiver_id'];
    $users = getUsers($receiverId);
    foreach ($users as $user) {
        $encoded_image_url = base64_encode($user['img_profile']);
        $userId = $user['client_id'];
        $userName = $user['first_name'] . ' ' . $user['last_name'];

        // Return the HTML content for the selected user
        echo "<div class='user active' data-user-id='$userId'>
                <div class='chat-profile-img'>
                    <img src='data:image/jpeg;base64,$encoded_image_url'></img>
                </div>
                <div class='chat-profile-name'>
                    $userName
                </div>
            </div>";
    }
}
?>
