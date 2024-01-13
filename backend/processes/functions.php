<?php
 require('connection.php');


function addAdminNotif($conn, $TID, $CID, $adminHeader){
    $currentDate = date('mdY');
    $get_client_details = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$CID'");
    $client_details_results = mysqli_fetch_assoc($get_client_details);
    $client_name = $client_details_results['first_name'] . ' ' . $client_details_results['last_name'];
    
    $get_animal_details = mysqli_query($conn, "SELECT * FROM tbl_animals WHERE transaction_id = '$TID'");
    $animal_id_result = mysqli_fetch_assoc($get_animal_details);
    $animal_height = $animal_id_result['height'];
    $animal_weight = $animal_id_result['weight'];
    $animal_age = $animal_id_result['age'];
    $animal_sex = $animal_id_result['sex'];
    $animal_color = $animal_id_result['color'];
    $animal_quantity = $animal_id_result['quantity'];
    $animal_image = $animal_id_result['image'];
    $breed_id = $animal_id_result['breed_id'];

    $get_breed_details = mysqli_query($conn, "SELECT * FROM tbl_breeds WHERE breed_id = '$breed_id'");
    $breed_details_result = mysqli_fetch_assoc($get_breed_details);
    $breed_name = $breed_details_result['description'];
    $species_id = $breed_details_result['species_id'];

    $get_species_details = mysqli_query($conn, "SELECT * FROM tbl_species WHERE species_id = '$species_id'");
    $species_details_result = mysqli_fetch_assoc($get_species_details);
    $species_name = $species_details_result['description'];

    $customNotifID = generateCustomClientNotificationID($conn, $currentDate);
    $customAdminNotifID = generateCustomAdminNotificationID($conn, $currentDate);
    $adminContent = 'Transaction: ' . $animal_quantity . ' ' . $breed_name . ' ' . $species_name . ' by ' . $client_name;
    //mysqli_query($conn, "INSERT INTO tbl_client_notif (notif_id, client_id, header, content, notif_img, status) values ('$customNotifID', '$CID', '$cNotifHeader', '$cNotifContent', '$image_data', 0)");
    $stmt = $conn->prepare("INSERT INTO tbl_admin_notif (notification_id, transaction_id, header, content, notif_img) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssss", $customAdminNotifID, $TID, $adminHeader, $adminContent, $animal_image);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();
}

function addNotif($conn, $TID, $CID, $adminHeader, $clientHeader){
    $currentDate = date('mdY');
    $get_client_details = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$CID'");
    $client_details_results = mysqli_fetch_assoc($get_client_details);
    $client_name = $client_details_results['first_name'] . ' ' . $client_details_results['last_name'];
    
    $get_animal_details = mysqli_query($conn, "SELECT * FROM tbl_animals WHERE transaction_id = '$TID'");
    $animal_id_result = mysqli_fetch_assoc($get_animal_details);
    $animal_height = $animal_id_result['height'];
    $animal_weight = $animal_id_result['weight'];
    $animal_age = $animal_id_result['age'];
    $animal_sex = $animal_id_result['sex'];
    $animal_color = $animal_id_result['color'];
    $animal_quantity = $animal_id_result['quantity'];
    $animal_image = $animal_id_result['image'];
    $breed_id = $animal_id_result['breed_id'];

    $get_breed_details = mysqli_query($conn, "SELECT * FROM tbl_breeds WHERE breed_id = '$breed_id'");
    $breed_details_result = mysqli_fetch_assoc($get_breed_details);
    $breed_name = $breed_details_result['description'];
    $species_id = $breed_details_result['species_id'];

    $get_species_details = mysqli_query($conn, "SELECT * FROM tbl_species WHERE species_id = '$species_id'");
    $species_details_result = mysqli_fetch_assoc($get_species_details);
    $species_name = $species_details_result['description'];

    $customNotifID = generateCustomClientNotificationID($conn, $currentDate);
    $customAdminNotifID = generateCustomAdminNotificationID($conn, $currentDate);
    $adminContent = 'Transaction: ' . $animal_quantity . ' ' . $breed_name . ' ' . $species_name . ' by ' . $client_name;
    $stmt = $conn->prepare("INSERT INTO tbl_admin_notif (notification_id, transaction_id, header, content, notif_img) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $customAdminNotifID, $TID, $adminHeader, $adminContent, $animal_image);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO tbl_client_notif (notif_id, client_id, header, content, notif_img, status) VALUES (?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssss", $customNotifID, $CID, $clientHeader, $adminContent, $animal_image);
    $stmt->execute();
    $stmt->close();
}

function generateCustomClientNotificationID($conn, $currentDate) {
    // Get the maximum transaction number from the database
    $checkTransaction = "SELECT MAX(CAST(SUBSTRING(notif_id, 11) AS UNSIGNED)) AS max_number FROM tbl_client_notif";
    $result = mysqli_query($conn, $checkTransaction);
    $get_max_number = mysqli_fetch_assoc($result);
    $maxNumber = $get_max_number['max_number'];

    if (!is_null($maxNumber)) {
        $notifID = (int)$maxNumber + 1;
    } else {
        $notifID = 1;
    }

    $customNotifID = "CN" . $currentDate . $notifID;
    return $customNotifID;
}

function generateCustomAdminNotificationID($conn, $currentDate) {
    // Get the maximum transaction number from the database
    $checkTransaction = "SELECT MAX(CAST(SUBSTRING(notification_id, 11) AS UNSIGNED)) AS max_number FROM tbl_admin_notif";
    $result = mysqli_query($conn, $checkTransaction);
    $get_max_number = mysqli_fetch_assoc($result);
    $maxNumber = $get_max_number['max_number'];

    if (!is_null($maxNumber)) {
        $notifID = (int)$maxNumber + 1;
    } else {
        $notifID = 1;
    }

    $customAdminNotifID = "AN" . $currentDate . $notifID;
    return $customAdminNotifID;
}

?>