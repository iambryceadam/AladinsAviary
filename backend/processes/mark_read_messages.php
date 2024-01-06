<?php
    include 'chat_functions.php';

    if (isset($_POST['receiver_id'])) {
        $receiverId = $_POST['receiver_id'];
        markReadMessages($receiverId);
    }
?>