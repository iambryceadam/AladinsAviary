<?php
include 'chat_functions.php';

$fullSizeImageURL = "";

if (isset($_GET['user_id'])) {
    $sender = 'ADMIN'; // Replace with the logged-in user's ID
    $receiver = $_GET['user_id'];
    $user_info_row = getUserInfo($receiver);
    $messages = getMessages($sender, $receiver);

    if (!empty($messages)) {
        echo "<div class='chat-box-header'>" .  "<img src='data:image/jpeg;base64," . base64_encode($user_info_row['img_profile'])."' class='cli-profile-image' alt='Profile Image'>" . $user_info_row['first_name'] . "  ". $user_info_row['last_name'] . "</div><div class='header-chat-divider'></div>";
        foreach ($messages as $message) {
            $imgData = $message['image'];
            // Determine the class based on the sender
            $messageClass = ($message['user_sender_id'] == $sender) ? 'outgoing-message' : 'incoming-message';

            // Display profile image only for messages sent by the other user
            $profileImage = '';
            if ($messageClass === 'incoming-message') {
                $profileImage = getProfileImage($message['user_sender_id']);
                $profileImage = "<img src='data:image/jpeg;base64," . base64_encode($profileImage)."' class='cli-profile-image' alt='Profile Image' >";
            } else{
                $profileImage = "<img src='images/app_icon.png' class='admin-profile-image' alt='Profile Image' >";
            }

            if (strpos($message['message'], '<img') !== false) {
                echo "<div class='message'>
                        $profileImage
                        <div class='content $messageClass'>{$message['message']}</div>
                      </div>";
            } else {
                // Output the message without an image
                $fullSizeImageURL = $imgData;
                echo "<div class='message'>
                        $profileImage
                        <div class='content $messageClass'>
                            {$message['message']}
                            <div class='chat-sent-image-container'>
                                <img src='data:image/jpeg;base64," . base64_decode($imgData) . "' class='chat-sent-images' data-fullsize='data:image/jpeg;base64," . base64_decode($fullSizeImageURL) . "' alt='' />
                            </div>
                        </div>
                    </div>";
            }
        }
    } else {
        echo "<div class='chat-box-header'>" .  "<img src='data:image/jpeg;base64," . base64_encode($user_info_row['img_profile'])."' class='cli-profile-image' alt='Profile Image' > " . $user_info_row['first_name'] . " ". $user_info_row['last_name'] . "</div><div class='header-chat-divider'></div>";
        echo '<div class="no-message">No messages yet</div>';
    }
}
?>
