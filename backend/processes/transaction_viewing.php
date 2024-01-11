<?php

// Database connection
require('connection.php');

if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];
    $find_transaction_info = "SELECT * FROM tbl_transactions WHERE transaction_id = '$transaction_id'";
    $transaction_info_result = mysqli_query($conn, $find_transaction_info);
    $transaction_info_row = mysqli_fetch_assoc($transaction_info_result);
    $transaction_status = $transaction_info_row['status'];
    $cage_provider = $transaction_info_row['cage_provider'];

    $find_date_filed = "SELECT * FROM tbl_transactions_dates WHERE transaction_id = '$transaction_id'";
    $find_date_filed_result = mysqli_query($conn, $find_date_filed);
    $date_filed_row = mysqli_fetch_assoc($find_date_filed_result);
    $date_filed_value = $date_filed_row['date_filed_request'];
    if($date_filed_row['time_departure'] == null && $date_filed_row['time_arrival'] == null){
        $date_of_departure = "Not yet decided";
        $date_of_arrival = "Not yet decided";
    } else{
        $date_of_departure = $date_filed_row['time_departure'];
        $date_of_arrival = $date_filed_row['time_arrival'];
    }

    $find_sender_id = "SELECT sender_id FROM tbl_senders WHERE transaction_id = '$transaction_id'";
    $find_sender_result = mysqli_query($conn, $find_sender_id);
    $sender_id_row = mysqli_fetch_assoc($find_sender_result);
    $sender_id_value = $sender_id_row['sender_id'];

    $find_sender_info = "SELECT * FROM tbl_senders WHERE transaction_id = '$transaction_id'";
    $find_sInfo_result = mysqli_query($conn, $find_sender_info);
    $sInfo_id_row = mysqli_fetch_assoc($find_sInfo_result);
    $slname_id_value = $sInfo_id_row['last_name'];
    $fname_id_value = $sInfo_id_row['first_name'];
    $sNumber_id_value = $sInfo_id_row['contact'];
    $sEmail_id_value = $sInfo_id_row['email'];

    $find_receiver_id = "SELECT receiver_id FROM tbl_receivers WHERE transaction_id = '$transaction_id'";
    $find_receiver_result = mysqli_query($conn, $find_receiver_id);
    $receiver_id_row = mysqli_fetch_assoc($find_receiver_result);
    $receiver_id_value = $receiver_id_row['receiver_id'];

    $find_receiver_info = "SELECT * FROM tbl_receivers WHERE transaction_id = '$transaction_id'";
    $find_rInfo_result = mysqli_query($conn, $find_receiver_info);
    $rInfo_id_row = mysqli_fetch_assoc($find_rInfo_result);
    $rlname_id_value = $rInfo_id_row['last_name'];
    $rfname_id_value = $rInfo_id_row['first_name'];
    $rNumber_id_value = $rInfo_id_row['contact'];
    $rEmail_id_value = $rInfo_id_row['email'];
    $rAddress_id_value = $rInfo_id_row['address_id'];

    $find_puLoc_id = "SELECT * FROM tbl_locations WHERE transaction_id = '$transaction_id'";
    $find_puLoc_id_result = mysqli_query($conn, $find_puLoc_id);
    $puLoc_id_row = mysqli_fetch_assoc($find_puLoc_id_result);
    $puLoc_id_value = $puLoc_id_row['pickup_location_id'];
    if($puLoc_id_row['dropoff_address'] == NULL || $puLoc_id_row['dropoff_address'] == ""){
        $dropoff_location = "Not Yet Decided";
    } else{
        $dropoff_location = $puLoc_id_row['dropoff_address'];
    }

    $find_puLoc = "SELECT * FROM tbl_profile_addresses WHERE address_id = '$puLoc_id_value'";
    $find_puLoc_result = mysqli_query($conn, $find_puLoc);
    $puLoc_row = mysqli_fetch_assoc($find_puLoc_result);
    $puRegion = $puLoc_row['region'];
    $puProvince = $puLoc_row['province'];
    $puCity = $puLoc_row['city'];
    $puBarangay = $puLoc_row['barangay'];
    $puStreet = $puLoc_row['street'];
    $puHouse_number = $puLoc_row['house_number'];

    $pickup_location = $puHouse_number . " " . $puStreet . " " . $puBarangay . " " . $puCity . " " . $puProvince . " " . $puRegion;

    $find_pMethod = "SELECT * FROM tbl_payments WHERE transaction_id = '$transaction_id'";
    $find_pMethod = mysqli_query($conn, $find_pMethod);
    $pMethod_row = mysqli_fetch_assoc($find_pMethod);

    if($pMethod_row['initial_payment_cost'] == 0){
        $pInitial_cost = "No price has been set yet.";
        $numValueInitialCost = 0;
    } else{
        $pInitial_cost = "P" . $pMethod_row['initial_payment_cost'];
        $numValueInitialCost =  $pMethod_row['initial_payment_cost'];
    }

    if($pMethod_row['final_payment_cost'] == 0){
        $pFinal_cost = "No price has been set yet.";
        $numValueFinalCost = 0;
    } else{
        $pFinal_cost = "P" . $pMethod_row['final_payment_cost'];
        $numValueFinalCost = $pMethod_row['final_payment_cost'];
    }

    $pType_value = $pMethod_row['payment_type'];
    $pMethod_value = $pMethod_row['payment_method'];
    $pInitial_receipt = base64_encode($pMethod_row['initial_payment_receipt']);
    $pFinal_receipt = base64_encode($pMethod_row['final_payment_receipt']);

    ////////////////////////////////////////////////////////////////

    $total_pay_status = $numValueInitialCost + $numValueFinalCost;
    $animal_pickup_cost = 1700;
    $mobilization_cost = 500;
    $ltp_cost = 100;
    $vhc_cost = 150;
    if($cage_provider == 0){
        $carrier_cage_cost = 500;
        $cage_enable = 0;
    } else{
        $carrier_cage_cost = 0;
        $cage_enable = 1;
    }
    $professional_fee = $total_pay_status - ($animal_pickup_cost + $mobilization_cost + $ltp_cost + $vhc_cost + $carrier_cage_cost);
    $grand_total = $animal_pickup_cost + $mobilization_cost + $ltp_cost + $vhc_cost + $carrier_cage_cost + $professional_fee;

    ////////////////////////////////////////////////////////////////

    $find_animal_transactions = "SELECT * FROM tbl_animals WHERE transaction_id = '$transaction_id'";
    $find_animal_transaction_result = mysqli_query($conn, $find_animal_transactions);
    $animal_transactions_row = mysqli_fetch_assoc($find_animal_transaction_result);
    $breed_id = $animal_transactions_row['breed_id'];
    $height = $animal_transactions_row['height'];
    $weight = $animal_transactions_row['weight'];
    $age = $animal_transactions_row['age'];
    $sex = $animal_transactions_row['sex'];
    $color = $animal_transactions_row['color'];
    $quantity = $animal_transactions_row['quantity'];
    $animal_img = $animal_transactions_row['image'];
    $encoded_image_url = base64_encode($animal_img);

    ////////////////////////////////////////////////////////////////

    $find_species_id = "SELECT species_id FROM tbl_breeds WHERE breed_id = '$breed_id'";
    $find_species_id_result =  mysqli_query($conn, $find_species_id);
    $find_species_id_row = mysqli_fetch_assoc($find_species_id_result);
    $species_id = $find_species_id_row['species_id'];

    $find_breed_name = "SELECT * FROM tbl_breeds WHERE breed_id = '$breed_id'";
    $find_breed_name_result = mysqli_query($conn, $find_breed_name);
    $find_breed_name_row = mysqli_fetch_assoc($find_breed_name_result);
    $breed_name = $find_breed_name_row['description'];

    $find_species_name = "SELECT * FROM tbl_species WHERE species_id = '$species_id'";
    $find_species_name_result = mysqli_query($conn, $find_species_name);
    $find_species_name_row = mysqli_fetch_assoc($find_species_name_result);
    $species_name = $find_species_name_row['description'];

    $find_transaction_attachments = mysqli_query($conn, "SELECT attachment FROM tbl_transactions_attachments WHERE transaction_id = '$transaction_id'");
    $images = [];
    while ($row = mysqli_fetch_assoc($find_transaction_attachments)) {
        $images[] = base64_encode($row['attachment']);
    }


    $transactionData = [
        'transaction_id' => $transaction_id,
        'transaction_date_filed' => $date_filed_value,
        'departure_date' => $date_of_departure,
        'arrival_date' => $date_of_arrival,
        'status' => $transaction_status,
        'sender_id' => $sender_id_value,
        'sender_last_name' => $slname_id_value,
        'sender_first_name' => $fname_id_value,
        'sender_contact' => $sNumber_id_value,
        'sender_email' => $sEmail_id_value,
        'receiver_id' => $receiver_id_value,
        'receiver_last_name' => $rlname_id_value,
        'receiver_first_name' => $rfname_id_value,
        'receiver_contact' => $rNumber_id_value,
        'receiver_email' => $rEmail_id_value,
        'receiver_address_id' => $rAddress_id_value,
        'pickup_location_id' => $puLoc_id_value,
        'dropoff_location' => $dropoff_location,
        'pickup_region' => $puRegion,
        'pickup_province' => $puProvince,
        'pickup_city' => $puCity,
        'pickup_barangay' => $puBarangay,
        'pickup_street' => $puStreet,
        'pickup_house_number' => $puHouse_number,
        'pickup_location_formatted' => $pickup_location,
        'payment_type' => $pType_value,
        'payment_method' => $pMethod_value,
        'initial_payment_cost' => $pInitial_cost,
        'final_payment_cost' => $pFinal_cost,
        'initial_payment_receipt' => base64_encode($pMethod_row['initial_payment_receipt']),
        'final_payment_receipt' => base64_encode($pMethod_row['final_payment_receipt']),
        'animal_pickup_cost' => $animal_pickup_cost,
        'mobilization_cost' => $mobilization_cost,
        'ltp_cost' => $ltp_cost,
        'vhc_cost' => $vhc_cost,
        'carrier_cage_cost' => $carrier_cage_cost,
        'professional_fee' => $professional_fee,
        'grand_total' => $grand_total,
        'breed_id' => $breed_id,
        'animal_height' => $height,
        'animal_weight' => $weight,
        'animal_age' => $age,
        'animal_sex' => $sex,
        'animal_color' => $color,
        'animal_quantity' => $quantity,
        'animal_image' => base64_encode($animal_img),
        'species_id' => $species_id,
        'breed_name' => $breed_name,
        'species_name' => $species_name,
        'other_images' => $images,
    ];
    
    header('Content-Type: application/json');
    echo json_encode($transactionData);
    exit;

} else {
    echo "<p>Test content</p>";
}
?>