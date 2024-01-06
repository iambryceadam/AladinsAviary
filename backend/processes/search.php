<?php
include 'chat_functions.php';

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    $filteredUsers = searchUsers($searchTerm);

    foreach ($filteredUsers as $user) {
        $encoded_image_url = base64_encode($user['img_profile']);
        echo "<div class='user' data-user-id='{$user['client_id']}'>
                <div class='chat-profile-img'>
                    <img src='data:image/jpeg;base64,{$encoded_image_url}'></img>
                </div>
                <div class='chat-profile-name'>
                    {$user['first_name']} {$user['last_name']}
                </div>
              </div>";
    }
} else {
    echo "Invalid request";
}
?>
