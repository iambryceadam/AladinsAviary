<?php
    // Start Session
    session_start();

    // Database connection
    require('connection.php');

    // Variables
    $prompt = array();





    // Administrator Login
    if (isset($_POST['login'])) {

      // Declaration
      $username = "";
      $password = "";

      // Get admin input and modify input
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $username = trim($username);
      $username = trim($username);
      $username = stripcslashes($username);
      $password = stripcslashes($password);
      
      // Check if the input is in the database records
      $query_adminAccount = mysqli_query($conn,"SELECT * FROM tbl_administrator WHERE username = '$username' AND password = '$password'") or die ("Failed to query database");
      $query_adminAccount_result = mysqli_fetch_array($query_adminAccount);

      $query_adminAccount_exist = mysqli_query($conn,"SELECT * FROM tbl_administrator WHERE username = '$username'") or die ("Failed to query database");
      $query_adminAccount_exist_result = mysqli_fetch_array($query_adminAccount_exist);

      // Check if the account exists
      if (!isset($query_adminAccount_exist_result)){
        array_push($prompt, "Account does not exist, please enter a valid administrator account.");
      } else {
        // If the account exists
        if (isset($query_adminAccount_result)){
          $_SESSION['admin_id'] = $query_adminAccount_result['admin_id'];
          $_SESSION['role'] = $query_adminAccount_result['role'];
          $_SESSION['administrator'] = $query_adminAccount_result['name'];
          $_SESSION['username'] = $query_adminAccount_result['username'];
          // Redirect to dashboard page
          header("location: dashboard.php");
        } else {
          array_push($prompt, "You have entered an incorrect password.");
        }
      }
    }

    // TRANSACTIONS
    // REQUEST APPROVAL
    if(isset($_POST['insertPaymentCost'])){
      $i_payment_cost = mysqli_real_escape_string($conn, $_POST['i_payment_cost']);
      $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);

      $get_payment_type = mysqli_query($conn, "SELECT payment_type FROM tbl_payments WHERE transaction_id = '$transaction_id'");
      $payment_type_result = mysqli_fetch_assoc($get_payment_type);
      $payment_type = $payment_type_result['payment_type'];

      if($payment_type == "Down Payment"){
        mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-downpayment' WHERE transaction_id = '$transaction_id'");
        mysqli_query($conn, "UPDATE tbl_payments SET initial_payment_cost = $i_payment_cost WHERE transaction_id = '$transaction_id'");
        $transaction_approved_succes = "Successfully approved transaction";
        header("Location: requests.php?transaction_approved_success=". urldecode($transaction_approved_succes));
      } else if($payment_type == "Full Payment"){
        mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-payment' WHERE transaction_id = '$transaction_id'");
        mysqli_query($conn, "UPDATE tbl_payments SET final_payment_cost = $i_payment_cost WHERE transaction_id = '$transaction_id'");
        $transaction_approved_succes = "Successfully approved transaction";
        header("Location: requests.php?transaction_approved_success=". urldecode($transaction_approved_succes));
      }
    }

    if(isset($_GET['approveInitialPayment'])){
      $tID = $_GET['approveInitialPayment'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'processing-documents' WHERE transaction_id = '$tID'");
      $initial_payment_approved_success = "Successfully approved initial payment";
      header("Location: ../initial_payment.php?initial_payment_approved_success=" . urldecode($initial_payment_approved_success));
    }

    if(isset($_GET['approvePayment'])){
      $tID = $_GET['approvePayment'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'processing-documents' WHERE transaction_id = '$tID'");
      $payment_approved_success = "Successfully approved Payment";
      header("Location: ../fullCash_payment.php?payment_approved_success=" . urldecode($payment_approved_success));
    }

    if(isset($_GET['rejectInitialPayment'])){
      $tID = $_GET['rejectInitialPayment'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'i-receipt-reattempt' WHERE transaction_id = '$tID'");
      $payment_approved_success = "Successfully rejected Payment";
      header("Location: ../initial_payment.php?payment_approved_success=" . urldecode($payment_approved_success));
    }

    if(isset($_GET['rejectFinalPayment'])){
      $tID = $_GET['rejectFinalPayment'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'f-receipt-reattempt' WHERE transaction_id = '$tID'");
      $payment_approved_success = "Successfully rejected Payment";
      header("Location: ../final_payment.php?payment_approved_success=" . urldecode($payment_approved_success));
    }

    if(isset($_GET['rejectFullPayment'])){
      $tID = $_GET['rejectFullPayment'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'f-receipt-reattempt' WHERE transaction_id = '$tID'");
      $full_payment_reject_success = "Successfully rejected Payment";
      header("Location: ../fullCash_payment.php?full_payment_reject_success=" . urldecode($full_payment_reject_success));
    }

    if(isset($_GET['initiatePickup'])){
      $tID = $_GET['initiatePickup'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-pickup' WHERE transaction_id = '$tID'");
      $moved_for_pickup_success = "Successfully moved transaction for pick up";
      header("Location: ../pickup.php?moved_for_pickup_success=" . urldecode($moved_for_pickup_success));
    }
    

    if(isset($_GET['successPickup'])){
      $tID = $_GET['successPickup'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'pickup-success' WHERE transaction_id = '$tID'");
      $pickup_successful = "Successfully picked up animal";
      header("Location: ../pickup.php?pickup_successful=" . urldecode($pickup_successful));
    }

    if(isset($_GET['unsuccessfulPickup'])){
      $tID = $_GET['unsuccessfulPickup'];
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'pickup-unsuccessful' WHERE transaction_id = '$tID'");
      $pickup_unsuccessful = "Pickup attempt Unsuccessful";
      header("Location: ../pickup.php?pickup_unsuccessful=" . urldecode($pickup_unsuccessful));
    } 

    if(isset($_GET['forMedical'])){
      $tID = $_GET['forMedical'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'ongoing-medical' WHERE transaction_id = '$tID'");
      $proceed_for_medical = "Successfully proceeded to next step (For Medical))";
      header("Location: ../pickup.php?pickup_successful=" . urldecode($proceed_for_medical));
    }

    if(isset($_GET['ongoingMedical'])){
      $tID = $_GET['ongoingMedical'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'ongoing-medical' WHERE transaction_id = '$tID'");
      $ongoing_medical = "Successfully proceeded to next step (On-going Medical))";
      header("Location: ../medical.php?ongoing_medical=" . urldecode($ongoing_medical));
    }

    if (isset($_POST['insertMedicalAttachments'])) {
        $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
        $currentDate = date('mdY');
        mysqli_query($conn, "UPDATE tbl_transactions SET status = 'pending-transport' WHERE transaction_id = '$transaction_id'");
    
        if (!empty($_FILES['images']['name'][0])) {
            $fileNames = $_FILES['images']['name'];
            $fileTmpNames = $_FILES['images']['tmp_name'];
    
            for ($i = 0; $i < count($fileNames); $i++) {
                $fileName = mysqli_real_escape_string($conn, $fileNames[$i]);
                $fileTmpName = $fileTmpNames[$i];
                $attachmentTag = "Medical";
    
                $fileContent = file_get_contents($fileTmpName);
                $fileContent = mysqli_real_escape_string($conn, $fileContent);

                $customAttachmentsID = generateCustomAttachmentsID($conn, $currentDate);
    
                $insertQuery = "INSERT INTO tbl_transactions_attachments (attachment_id, transaction_id, attachment, attachment_tag) VALUES ('$customAttachmentsID', '$transaction_id', '$fileContent', '$attachmentTag')";
                mysqli_query($conn, $insertQuery);
            }
        }
        $complete_medical = "Successfully proceeded to the next step (Completed Medical)";
        header("Location: ?complete_medical=" . urldecode($complete_medical));
    }

    if (isset($_POST['submitDocumentsAttachments'])) {
      $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
      $currentDate = date('mdY');
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-booking' WHERE transaction_id = '$transaction_id'");
  
      // Process shipment attachments
      if (!empty($_FILES['document_images']['name'][0])) {
          $fileNames = $_FILES['document_images']['name'];
          $fileTmpNames = $_FILES['document_images']['tmp_name'];
  
          for ($i = 0; $i < count($fileNames); $i++) {
              $fileName = mysqli_real_escape_string($conn, $fileNames[$i]);
              $fileTmpName = $fileTmpNames[$i];
              $attachmentTag = "Documents";
  
              $fileContent = file_get_contents($fileTmpName);
              $fileContent = mysqli_real_escape_string($conn, $fileContent);
  
              $customAttachmentsID = generateCustomAttachmentsID($conn, $currentDate);
  
              $insertQuery = "INSERT INTO tbl_transactions_attachments (attachment_id, transaction_id, attachment, attachment_tag) VALUES ('$customAttachmentsID', '$transaction_id', '$fileContent', '$attachmentTag')";
              mysqli_query($conn, $insertQuery);
          }
      }
  
      $complete_documents = "Uploaded documents successfully";
      header("Location: ?complete_documents=" . urldecode($complete_documents));
    }
  
    if(isset($_POST['insertShipmentAttachments'])){
      $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
      $dropoff_location = mysqli_real_escape_string($conn, $_POST['dropoff_location']);
      $currentDate = date('mdY');
      $dropoff_location = mysqli_real_escape_string($conn, $_POST['dropoff_location']);
      $departureDateTime = mysqli_real_escape_string($conn, $_POST['departureDateTime']);
      $arrivalDateTime = mysqli_real_escape_string($conn, $_POST['arrivalDateTime']);
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-transport' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_locations SET dropoff_address = '$dropoff_location' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_transactions_dates SET time_departure = '$departureDateTime', time_arrival = '$arrivalDateTime'  WHERE transaction_id = '$transaction_id'");

      if (!empty($_FILES['images']['name'][0])) {
          $fileNames = $_FILES['images']['name'];
          $fileTmpNames = $_FILES['images']['tmp_name'];
  
          for ($i = 0; $i < count($fileNames); $i++) {
              $fileName = mysqli_real_escape_string($conn, $fileNames[$i]);
              $fileTmpName = $fileTmpNames[$i];
              $attachmentTag = "Transport";
  
              $fileContent = file_get_contents($fileTmpName);
              $fileContent = mysqli_real_escape_string($conn, $fileContent);

              $customAttachmentsID = generateCustomAttachmentsID($conn, $currentDate);
  
              $insertQuery = "INSERT INTO tbl_transactions_attachments (attachment_id, transaction_id, attachment, attachment_tag) VALUES ('$customAttachmentsID', '$transaction_id', '$fileContent', '$attachmentTag')";
              mysqli_query($conn, $insertQuery);
          }
      }
      $booking_success = "Successfully booked animal for transport";
      header("Location: ?booking_success=" . urldecode($booking_success));
    }

    if(isset($_POST['insertBookingAttachmentsDown'])){
      $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
      $dropoff_location = mysqli_real_escape_string($conn, $_POST['dropoff_location']);
      $f_payment_cost = mysqli_real_escape_string($conn, $_POST['f_payment_cost']);
      $currentDate = date('mdY');
      $departureDateTime = mysqli_real_escape_string($conn, $_POST['departureDateTime']);
      $arrivalDateTime = mysqli_real_escape_string($conn, $_POST['arrivalDateTime']);
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-payment' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_payments SET final_payment_cost = '$f_payment_cost' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_locations SET dropoff_address = '$dropoff_location' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_transactions_dates SET time_departure = '$departureDateTime', time_arrival = '$arrivalDateTime'  WHERE transaction_id = '$transaction_id'");

      if (!empty($_FILES['images']['name'][0])) {
          $fileNames = $_FILES['images']['name'];
          $fileTmpNames = $_FILES['images']['tmp_name'];
  
          for ($i = 0; $i < count($fileNames); $i++) {
              $fileName = mysqli_real_escape_string($conn, $fileNames[$i]);
              $fileTmpName = $fileTmpNames[$i];
              $attachmentTag = "Transport";
  
              $fileContent = file_get_contents($fileTmpName);
              $fileContent = mysqli_real_escape_string($conn, $fileContent);

              $customAttachmentsID = generateCustomAttachmentsID($conn, $currentDate);
  
              $insertQuery = "INSERT INTO tbl_transactions_attachments (attachment_id, transaction_id, attachment, attachment_tag) VALUES ('$customAttachmentsID', '$transaction_id', '$fileContent', '$attachmentTag')";
              mysqli_query($conn, $insertQuery);
          }
      }
      $booking_success = "Successfully booked animal for transport";
      header("Location: ?booking_success=" . urldecode($booking_success));
  }

    if(isset($_POST['insertBookingAttachments'])){
      $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
      $dropoff_location = mysqli_real_escape_string($conn, $_POST['dropoff_location']);
      $currentDate = date('mdY');
      $dropoff_location = mysqli_real_escape_string($conn, $_POST['dropoff_location']);
      $departureDateTime = mysqli_real_escape_string($conn, $_POST['departureDateTime']);
      $arrivalDateTime = mysqli_real_escape_string($conn, $_POST['arrivalDateTime']);
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'pending-pickup' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_locations SET dropoff_address = '$dropoff_location' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_transactions_dates SET time_departure = '$departureDateTime', time_arrival = '$arrivalDateTime'  WHERE transaction_id = '$transaction_id'");

      if (!empty($_FILES['images']['name'][0])) {
          $fileNames = $_FILES['images']['name'];
          $fileTmpNames = $_FILES['images']['tmp_name'];
  
          for ($i = 0; $i < count($fileNames); $i++) {
              $fileName = mysqli_real_escape_string($conn, $fileNames[$i]);
              $fileTmpName = $fileTmpNames[$i];
              $attachmentTag = "Transport";
  
              $fileContent = file_get_contents($fileTmpName);
              $fileContent = mysqli_real_escape_string($conn, $fileContent);

              $customAttachmentsID = generateCustomAttachmentsID($conn, $currentDate);
  
              $insertQuery = "INSERT INTO tbl_transactions_attachments (attachment_id, transaction_id, attachment, attachment_tag) VALUES ('$customAttachmentsID', '$transaction_id', '$fileContent', '$attachmentTag')";
              mysqli_query($conn, $insertQuery);
          }
      }
      $booking_success = "Successfully booked animal for transport";
      header("Location: ?booking_success=" . urldecode($booking_success));
  }

    function generateCustomAttachmentsID($conn, $currentDate) {
      // Get the maximum transaction number from the database
      $checkTransaction = "SELECT MAX(CAST(SUBSTRING(attachment_id, 13) AS UNSIGNED)) AS max_number FROM tbl_transactions_attachments";
      $result = mysqli_query($conn, $checkTransaction);
      $get_max_number = mysqli_fetch_assoc($result);
      $maxNumber = $get_max_number['max_number'];
  
      if (!is_null($maxNumber)) {
          $transactionNumber = (int)$maxNumber + 1;
      } else {
          $transactionNumber = 1;
      }
  
      $customTransactionID = "TRAT" . $currentDate . $transactionNumber;
      return $customTransactionID;
  }
    /*
    if(isset($_GET['completeMedical'])){
      $tID = $_GET['completeMedical'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'completed-medical' WHERE transaction_id = '$tID'");
      $complete_medical = "Successfully proceeded to next step (Completed Medical))";
      header("Location: ../medical.php?complete_medical=" . urldecode($complete_medical));
    }
    */
    
    if(isset($_GET['proceedAfterMedical'])){
      $tID = $_GET['proceedAfterMedical'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'pending-transport' WHERE transaction_id = '$tID'");
      $for_transport_success = "Successfully proceeded to next step (Pending Transport)";
      header("Location: ../medical.php?for_transport_success=" . urldecode($for_transport_success));
    }
    
    if(isset($_POST['insertFinalCost'])){
      $f_payment_cost = mysqli_real_escape_string($conn, $_POST['f_payment_cost']);
      $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);

      $get_payment_type = mysqli_query($conn, "SELECT payment_type FROM tbl_payments WHERE transaction_id = '$transaction_id'");
      $payment_type_result = mysqli_fetch_assoc($get_payment_type);
      $payment_type = $payment_type_result['payment_type'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-payment' WHERE transaction_id = '$transaction_id'");
      mysqli_query($conn, "UPDATE tbl_payments SET final_payment_cost = $f_payment_cost WHERE transaction_id = '$transaction_id'");
      $set_final_pay_success = "Successfully updated transaction";
      header("Location: medical.php?set_final_pay_success=". urldecode($set_final_pay_success));
    }

    if(isset($_GET['approveFinalPayment'])){
      $tID = $_GET['approveFinalPayment'];
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'pending-pickup' WHERE transaction_id = '$tID'");
      $for_transport_success = "Successfully proceeded to next step (Pending Pickup)";
      header("Location: ../final_payment.php?for_transport_success=" . urldecode($for_transport_success));
    }

    if(isset($_GET['transportCompleted'])){
      $tID = $_GET['transportCompleted'];
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'for-receiving' WHERE transaction_id = '$tID'");
      $for_receiving_success = "Successfully proceeded to next step (For Receiving))";
      header("Location: ../transport.php?for_receiving_success=" . urldecode($for_receiving_success));
    }

    if(isset($_GET['animalReceived'])){
      $tID = $_GET['animalReceived'];
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'completed' WHERE transaction_id = '$tID'");
      $completed_transaction_success = "Transaction has been successfully completed";
      header("Location: ../toReceive.php?completed_transaction_success=" . urldecode($completed_transaction_success));
    }

    if(isset($_GET['receiveByContact'])){
      $tID = $_GET['receiveByContact'];
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'contact-receiving' WHERE transaction_id = '$tID'");
      $completed_transaction_success = "Successfully changed to receive by contact";
      header("Location: ../toReceive.php?completed_transaction_success=" . urldecode($completed_transaction_success));
    }

    if(isset($_GET['approveCancel'])){
      $tID = $_GET['approveCancel'];
      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'cancelled' WHERE transaction_id = '$tID'");
      $cancelled_transaction_success = "Transaction has been successfully cancelled";
      header("Location: ../cancelled.php?cancelled_transaction_success=" . urldecode($cancelled_transaction_success));
    }

    if(isset($_POST['rfc'])){
      $currentDate = date('mdY');
      $customCancelID = generateCustomCancellationID($conn, $currentDate);
      $rfctext = mysqli_real_escape_string($conn, $_POST['rfctext']);
      $transaction_id = mysqli_real_escape_string($conn, $_POST['cancel_transaction_id']);

      $get_status_before_cancel = mysqli_query($conn, "SELECT status FROM tbl_transactions WHERE transaction_id = '$transaction_id'");
      $status_before_cancel_result = mysqli_fetch_assoc($get_status_before_cancel);
      $status_before_cancel = $status_before_cancel_result['status'];

      mysqli_query($conn, "UPDATE tbl_transactions SET status = 'cancelled' WHERE transaction_id = '$transaction_id'"); 
      mysqli_query($conn, "INSERT INTO tbl_cancelled_transactions (cancellation_id, transaction_id, reason_for_cancellation, previous_status) values ('$customCancelID', '$transaction_id', '$rfctext', '$status_before_cancel')");
      $cancelled_transaction_success = "Transaction has been successfully cancelled";
      header("Location: ?cancelled_transaction_success=" . urldecode($cancelled_transaction_success));
    }

    function generateCustomCancellationID($conn, $currentDate) {
      // Get the maximum transaction number from the database
      $checkTransaction = "SELECT MAX(CAST(SUBSTRING(cancellation_id, 13) AS UNSIGNED)) AS max_number FROM tbl_cancelled_transactions";
      $result = mysqli_query($conn, $checkTransaction);
      $get_max_number = mysqli_fetch_assoc($result);
      $maxNumber = $get_max_number['max_number'];
  
      if (!is_null($maxNumber)) {
          $transactionNumber = (int)$maxNumber + 1;
      } else {
          $transactionNumber = 1;
      }
  
      $customTransactionID = "CNRS" . $currentDate . $transactionNumber;
      return $customTransactionID;
  }

    // ADD
    // Add Admin
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addAdministrator"])) {
      // Check if an image file is uploaded
      if (!empty($_FILES["a_image_input"]["name"])) {
          $image = $_FILES['a_image_input'];
          $image_name = mysqli_real_escape_string($conn, $image['name']);
          $image_data = file_get_contents($image['tmp_name']);
          $image_data = mysqli_real_escape_string($conn, $image_data);
      } else {
          // No image provided, use the default image path
          $image_path = "images/default_pfp.png";
          $escapedImageData = file_get_contents($image_path);
          $image_data = $conn->real_escape_string($escapedImageData); 
      }
  
      // Get input and modify input
      $name = mysqli_real_escape_string($conn, trim($_POST['a_admin_name']));
      $username = mysqli_real_escape_string($conn, trim($_POST['a_admin_username']));
      $password = mysqli_real_escape_string($conn, trim($_POST['a_admin_password']));
  
      // Check if username already exists
      $checkDuplicateAdmin = "SELECT username FROM tbl_administrator WHERE username='$username'";
      $checkDuplicateAdminResult = mysqli_query($conn, $checkDuplicateAdmin);
      $duplicateAdminCount = mysqli_num_rows($checkDuplicateAdminResult);
  
      $checkDuplicateArchivedAdmin = "SELECT username FROM tbl_archived_administrator WHERE username='$username'";
      $checkDuplicateArchivedAdminResult = mysqli_query($conn, $checkDuplicateArchivedAdmin);
      $duplicateArchivedAdminCount = mysqli_num_rows($checkDuplicateArchivedAdminResult);
  
      // Check if username already exists
      if ($duplicateAdminCount > 0 || $duplicateArchivedAdminCount > 0) {
          $add_admin_error = "Username is already in use, please enter a unique username.";
          header("Location: maint_administrators.php?add_admin_error=".urlencode($add_admin_error));
      } else {
          $prefix = "ADMN";
          $currentDate = date("mdY");
  
          // Load the last count and date from a file
          $filename = "last_count.txt";
          $fileContents = (file_exists($filename)) ? file_get_contents($filename) : '';
          list($lastDate, $lastCount) = explode('|', $fileContents);
  
          // Check if it's a new day
          if ($currentDate != $lastDate) {
              // It's a new day, reset the count to 1
              $count = 1;
          } else {
              // It's the same day, increment the count
              $count = $lastCount + 1;
          }
  
          // Save the current date and count to the file
          file_put_contents($filename, "$currentDate|$count");
  
          $admin_id = $prefix . $currentDate . sprintf("%03d", $count); // Pad count with leading zeros
  
          // Add input to the database
          $add_administrator = "INSERT INTO tbl_administrator (admin_id, name, username, password, img_profile) VALUES ('$admin_id', '$name', '$username', '$password', '$image_data')";
          $add_administrator_result = mysqli_query($conn, $add_administrator);
  
          if ($add_administrator_result) {
              $add_admin_success = "Successfully added Administrator - $name";
              header("Location: maint_administrators.php?add_admin_success=".urlencode($add_admin_success));
          }
      }
    }






    //EDIT
    //Mark Notifications as Read
    if (isset($_GET['markAllNotifAsRead'])) {
      mysqli_query($conn, "UPDATE tbl_admin_notif SET status=1");
      $mark_read_notif_success = "Successfully marked notifications as read";
      header("Location: ../notifications.php?mark_read_notif_success=" . urldecode($mark_read_notif_success));
    }

    // Edit Admin
    if (isset($_POST['editAdministrator'])) {
      $e_admin_id = $_POST['e_admin_id'];
      $e_admin_name = mysqli_real_escape_string($conn, $_POST['e_admin_name']);
      $e_admin_username = mysqli_real_escape_string($conn, $_POST['e_admin_username']);
      $e_admin_password = mysqli_real_escape_string($conn, $_POST['e_admin_password']);
      $e_admin_name = trim($e_admin_name);
      $e_admin_username = trim($e_admin_username);
      $e_admin_password = trim($e_admin_password);
      $e_admin_name = stripcslashes($e_admin_name);
      $e_admin_username = stripcslashes($e_admin_username);
      $e_admin_password = stripcslashes($e_admin_password);

      // Check Input Change
      $checkChange = "SELECT * FROM tbl_administrator WHERE admin_id='$e_admin_id'";
      $checkChangeResult = mysqli_query($conn, $checkChange);
      $checkChangeFetch = mysqli_fetch_assoc($checkChangeResult);

      // Check for duplicate usernames
      $checkDuplicates = "SELECT username FROM tbl_administrator WHERE username='$e_admin_username' AND NOT admin_id='$e_admin_id'";
      $checkDuplicatesResult = mysqli_query($conn, $checkDuplicates);
      $duplicateCount = mysqli_num_rows($checkDuplicatesResult);

      $checkDuplicateArchivedAdmin = "SELECT username FROM tbl_archived_administrator WHERE username='$e_admin_username'";
      $checkDuplicateArchivedAdminResult = mysqli_query($conn, $checkDuplicateArchivedAdmin);
      $duplicateArchivedAdminCount = mysqli_num_rows($checkDuplicateArchivedAdminResult);

      if ($duplicateCount > 0) {
          $update_admin_error = "Username is already in use, please enter a unique username.";
          $update_admin_error_id = $e_admin_id;
          header("Location: maint_administrators.php?update_admin_error=" . urlencode($update_admin_error) . "&update_admin_error_id=" . urlencode($update_admin_error_id));
          exit; // Exit after redirect
      }

      if ($duplicateArchivedAdminCount > 0) {
        $update_admin_error = "Username is already in use, please enter a unique username.";
        $update_admin_error_id = $e_admin_id;
        header("Location: maint_administrators.php?update_admin_error=" . urlencode($update_admin_error) . "&update_admin_error_id=" . urlencode($update_admin_error_id));
        exit; // Exit after redirect
      }

      // Check if the image input is changed
      if (isset($_FILES['e_image_input']) && $_FILES['e_image_input']['error'] !== UPLOAD_ERR_NO_FILE) {
        $e_image = $_FILES['e_image_input'];
        $e_image_name = mysqli_real_escape_string($conn, $e_image['name']);
        $e_image_data = file_get_contents($e_image['tmp_name']);
        $e_image_data = mysqli_real_escape_string($conn, $e_image_data);

        // There are changes to the image
        mysqli_query($conn, "UPDATE tbl_administrator SET name='$e_admin_name', username='$e_admin_username', password='$e_admin_password', img_profile='$e_image_data' WHERE admin_id='$e_admin_id'");
        $update_admin_success = "Successfully saved changes to Admin - $e_admin_name";
      } else {
        // No changes to the image
        mysqli_query($conn, "UPDATE tbl_administrator SET name='$e_admin_name', username='$e_admin_username', password='$e_admin_password' WHERE admin_id='$e_admin_id'");
        
        // There are changes to the data
        if (
          $e_admin_name != $checkChangeFetch['name'] ||
          $e_admin_username != $checkChangeFetch['username'] ||
          $e_admin_password != $checkChangeFetch['password']
        ){
          $update_admin_success = "Successfully saved changes to Admin - $e_admin_name";
        } else {
          $update_admin_success = "There no changes done to Admin - $e_admin_name";
        }
        
      }

      // Redirect with success message
      header("Location: maint_administrators.php?update_admin_success=" . urlencode($update_admin_success));
      exit; // Exit after redirect
    }
    
  
  
  

    if (isset($_POST['validateSpecies'])) {
      header("Location: dashboard.php");
      
    }





    // ARCHIVE
    // Archive Admin
    if (isset($_GET['archiveAdmin'])) {
      $id = $_GET['archiveAdmin'];

      $transfer = "INSERT INTO tbl_archived_administrator (admin_id, name, username, password, img_profile, role, created_on) 
      SELECT admin_id, name, username, password, img_profile, role, created_on 
      FROM tbl_administrator WHERE admin_id = ?";

      // Use prepared statements to avoid SQL injection
      $uno = mysqli_prepare($conn, $transfer);
      mysqli_stmt_bind_param($uno, "s", $id);

      $dos = mysqli_prepare($conn, "DELETE FROM tbl_administrator WHERE admin_id = ?");
      mysqli_stmt_bind_param($dos, "s", $id);
    
      if (mysqli_stmt_execute($uno)) {
        if (mysqli_stmt_execute($dos)) {
          $archive_admin_success = "Successfully archived Administrator - $id";
          header("Location: ../maint_administrators.php?archive_admin_success=" . urldecode($archive_admin_success));
        }
      } else {
        // Handle the error
        $error_message = "Error: " . mysqli_error($conn);
        // You can log the error and redirect to an error page
        error_log($error_message);
        header("Location: ../error.php");
      }
    }

    // Archive Species
    if (isset($_GET['archiveSpecies'])) {
      $id = $_GET['archiveSpecies'];

      $transfer = "INSERT INTO tbl_archived_species (species_id, submitted_by, description, submitted_on, approved_on, status) 
      SELECT species_id, submitted_by, description, submitted_on, approved_on, status
      FROM tbl_species WHERE species_id = ?";

      // Use prepared statements to avoid SQL injection
      $uno = mysqli_prepare($conn, $transfer);
      mysqli_stmt_bind_param($uno, "s", $id);

      $dos = mysqli_prepare($conn, "DELETE FROM tbl_species WHERE species_id = ?");
      mysqli_stmt_bind_param($dos, "s", $id);
    
      if (mysqli_stmt_execute($uno)) {
        if (mysqli_stmt_execute($dos)) {
          $archive_species_success = "Successfully archived Species - $id";
          header("Location: ../maint_species.php?archive_species_success=" . urldecode($archive_species_success));
        }
      } else {
        // Handle the error
        $error_message = "Error: " . mysqli_error($conn);
        // You can log the error and redirect to an error page
        error_log($error_message);
        header("Location: ../error.php");
      }
    }

    // Archive Breeds
    if (isset($_GET['archiveBreed'])) {
      $id = $_GET['archiveBreed'];

      $transfer = "INSERT INTO tbl_archived_breeds (breed_id, species_id, submitted_by, description, submitted_on, approved_on, status) 
      SELECT breed_id, species_id, submitted_by, description, submitted_on, approved_on, status
      FROM tbl_breeds WHERE breed_id = ?";

      // Use prepared statements to avoid SQL injection
      $uno = mysqli_prepare($conn, $transfer);
      mysqli_stmt_bind_param($uno, "s", $id);

      $dos = mysqli_prepare($conn, "DELETE FROM tbl_breeds WHERE breed_id = ?");
      mysqli_stmt_bind_param($dos, "s", $id);
    
      if (mysqli_stmt_execute($uno)) {
        if (mysqli_stmt_execute($dos)) {
          $archive_breed_success = "Successfully archived Breed - $id";
          header("Location: ../maint_breeds.php?archive_breed_success=" . urldecode($archive_breed_success));
        }
      } else {
        // Handle the error
        $error_message = "Error: " . mysqli_error($conn);
        // You can log the error and redirect to an error page
        error_log($error_message);
        header("Location: ../error.php");
      }
    }



    // DELETE
    // Delete Admin
    if (isset($_GET['deleteAdmin'])) {
      $id = $_GET['deleteAdmin'];
      $query = mysqli_prepare($conn, "DELETE FROM tbl_archived_administrator WHERE admin_id = ?");
      mysqli_stmt_bind_param($query, "s", $id);

      if (mysqli_stmt_execute($query)) {
        $delete_admin_success = "Successfully deleted Admin - $id";
        header("Location: ../archived_administrators.php?delete_admin_success=".urldecode($delete_admin_success));
      }
    }

    // Delete All Archived Admin
    if (isset($_GET['deleteAllArchivedAdmin'])) {
      $query = "DELETE FROM tbl_archived_administrator";

      if (mysqli_query($conn, $query)) {
        $delete_allArchivedAdmin_success = "Successfully deleted all archived Administrators";
        header("Location: ../archived_administrators.php?delete_allArchivedAdmin_success=" . urlencode($delete_allArchivedAdmin_success));
      }
    }

    // Delete Breeds
    if (isset($_GET['deleteBreed'])) {
      $id = $_GET['deleteBreed'];
      $query = mysqli_prepare($conn, "DELETE FROM tbl_archived_breeds WHERE breed_id = ?");
      mysqli_stmt_bind_param($query, "s", $id);

      if (mysqli_stmt_execute($query)) {
        $delete_breed_success = "Successfully deleted Breed - $id";
        header("Location: ../archived_species.php?delete_breed_success=".urldecode($delete_breed_success));
      }
    }

    // Delete Species
    if (isset($_GET['deleteSpecies'])) {
      $id = $_GET['deleteSpecies'];
      $query = mysqli_prepare($conn, "DELETE FROM tbl_archived_species WHERE species_id = ?");
      mysqli_stmt_bind_param($query, "s", $id);

      if (mysqli_stmt_execute($query)) {
        $delete_species_success = "Successfully deleted Species - $id";
        header("Location: ../archived_species.php?delete_species_success=".urldecode($delete_species_success));
      }
    }




    // RETRIEVE
    // Retrieve Admin
    if (isset($_GET['retrieveAdmin'])) {
      $id = $_GET['retrieveAdmin'];

      $transfer = "INSERT INTO tbl_administrator (admin_id, name, username, password, img_profile, role, created_on) 
      SELECT admin_id, name, username, password, img_profile, role, created_on 
      FROM tbl_archived_administrator WHERE admin_id = ?";

      // Use prepared statements to avoid SQL injection
      $uno = mysqli_prepare($conn, $transfer);
      mysqli_stmt_bind_param($uno, "s", $id);

      $dos = mysqli_prepare($conn, "DELETE FROM tbl_archived_administrator WHERE admin_id = ?");
      mysqli_stmt_bind_param($dos, "s", $id);
    
      if (mysqli_stmt_execute($uno)) {
        if (mysqli_stmt_execute($dos)) {
          $retrieve_admin_success = "Successfully retrieved Administrator - $id";
          header("Location: ../archived_administrators.php?retrieve_admin_success=" . urldecode($retrieve_admin_success));
        }
      } else {
        // Handle the error
        $error_message = "Error: " . mysqli_error($conn);
        // You can log the error and redirect to an error page
        error_log($error_message);
        header("Location: ../error.php");
      }
    }

    // Retrieve All Archived Administrator
    if (isset($_GET['retrieveAllArchivedAdmin'])) {
      $insertQuery = "INSERT INTO tbl_administrator SELECT admin_id, name, username, password, img_profile, role, created_on  FROM tbl_archived_administrator";

      if (mysqli_query($conn, $insertQuery)) {
          // Step 2: Delete from the source table
          $deleteQuery = "DELETE FROM tbl_archived_administrator";

          if (mysqli_query($conn, $deleteQuery)) {
              $retrieve_allArchivedAdmin_success = "Successfully retrieved all archived Administrators";
              header("Location: ../archived_administrators.php?retrieve_allArchivedAdmin_success=" . urlencode($retrieve_allArchivedAdmin_success));
          } else {
              // Handle delete error
              echo "Error deleting records: " . mysqli_error($conn);
          }
      } else {
          // Handle insert error
          echo "Error inserting records: " . mysqli_error($conn);
      }
    }

    // Retrieve Breed
    if (isset($_GET['retrieveBreed'])) {
      $id = $_GET['retrieveBreed'];

      $transfer = "INSERT INTO tbl_breeds (breed_id, species_id, submitted_by, description , submitted_on, approved_on, status) 
      SELECT breed_id, species_id, submitted_by, description , submitted_on, approved_on, status
      FROM tbl_archived_breeds WHERE breed_id = ?";

      // Use prepared statements to avoid SQL injection
      $uno = mysqli_prepare($conn, $transfer);
      mysqli_stmt_bind_param($uno, "s", $id);

      $dos = mysqli_prepare($conn, "DELETE FROM tbl_archived_breeds WHERE breed_id = ?");
      mysqli_stmt_bind_param($dos, "s", $id);
    
      if (mysqli_stmt_execute($uno)) {
        if (mysqli_stmt_execute($dos)) {
          $retrieve_breed_success = "Successfully retrieved Breed - $id";
          header("Location: ../archived_species.php?retrieve_breed_success=" . urldecode($retrieve_breed_success));
        }
      } else {
        // Handle the error
        $error_message = "Error: " . mysqli_error($conn);
        // You can log the error and redirect to an error page
        error_log($error_message);
        header("Location: ../error.php");
      }
    }

    // Retrieve Species
    if (isset($_GET['retrieveSpecies'])) {
      $id = $_GET['retrieveSpecies'];

      $transfer = "INSERT INTO tbl_species (species_id, submitted_by, description , submitted_on, approved_on, status) 
      SELECT species_id, submitted_by, description , submitted_on, approved_on, status
      FROM tbl_archived_species WHERE species_id = ?";

      // Use prepared statements to avoid SQL injection
      $uno = mysqli_prepare($conn, $transfer);
      mysqli_stmt_bind_param($uno, "s", $id);

      $dos = mysqli_prepare($conn, "DELETE FROM tbl_archived_species WHERE species_id = ?");
      mysqli_stmt_bind_param($dos, "s", $id);
    
      if (mysqli_stmt_execute($uno)) {
        if (mysqli_stmt_execute($dos)) {
          $retrieve_species_success = "Successfully retrieved Species - $id";
          header("Location: ../archived_species.php?retrieve_species_success=" . urldecode($retrieve_species_success));
        }
      } else {
        // Handle the error
        $error_message = "Error: " . mysqli_error($conn);
        // You can log the error and redirect to an error page
        error_log($error_message);
        header("Location: ../error.php");
      }
    }





    // FETCH
    // FETCH Notifications
    $get_admin_notif = mysqli_query($conn, "SELECT * FROM tbl_admin_notif");
    $get_admin_notif_active = mysqli_query($conn, "SELECT * FROM tbl_admin_notif WHERE status = 0");
    $get_admin_notif_active_count = mysqli_num_rows($get_admin_notif_active);

    // FETCH Client Requests
    $get_clientRequests = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status = 'for-approval'");

    // FETCH Pending Initial Payments
    $get_pending_initial_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'for-downpayment'
    ");

    // FETCH Paid Initial Payments
    $get_paid_initial_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'i-receipt-submitted' AND p.payment_type = 'Down Payment'
    ");

    $get_rejected_initial_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'i-receipt-reattempt' AND p.payment_type = 'Down Payment'
    ");

    $get_rejected_final_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'f-receipt-reattempt' AND p.payment_type = 'Down Payment'
    ");

    // FETCH Pending Final Payments
    $get_pending_final_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'for-payment' AND t.status != 'f-receipt-reattempt' AND p.payment_type = 'Full Payment'
    ");

    $get_rejected_full_final_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'f-receipt-reattempt' AND p.payment_type = 'Full Payment'
    ");

    // FETCH Paid Final Payments
    $get_completed_final_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'f-receipt-submitted' AND p.payment_type = 'Full Payment'
    ");

    //FETCH Approved Initial Payment
    $get_approved_payments = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE (t.status = 'pending-pickup') 
      AND (p.payment_type = 'Down Payment' OR p.payment_type = 'Full Payment')
    ");


    // FETCH Pending Final Payments
    $get_pending_final_payment_data = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE t.status = 'for-payment' 
      AND p.payment_type = 'Down Payment'
    ");

    //FETCH Successful Final Payments
    $get_successful_final_payment_data = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE (t.status = 'f-receipt-submitted') 
      AND p.payment_type = 'Down Payment'
    ");

    // FETCH Ongoing Document Processing
    $get_ongoing_processing_documents = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='processing-documents'");

    // FETCH For Booking Transactions
    $get_for_booking_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='for-booking'");

    //FETCH for-pickup transactions
    $get_for_pickup_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status = 'for-pickup'");

    //FETCH picked-up transactions
    $get_picked_up_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='pickup-success'");

    //FETCH unsuccessful pickups
    $get_unsuccessful_pick_up_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='pickup-unsuccessful'");

    //FETCH Pending Medical Assessments
    $get_for_medical_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='for-medical'");

    //FETCH Ongoing Medical Assessments
    $get_ongoing_medical_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='ongoing-medical'");

    // FETCH Completed Medical Assessments
    $get_completed_medical_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='completed-medical'");

    $get_for_transport_transactions = mysqli_query($conn, "
    SELECT *
    FROM tbl_transactions AS t
    JOIN tbl_payments AS p ON t.payment_id = p.payment_id
    WHERE (t.status = 'payment-approved' AND p.payment_type = 'Down Payment' OR t.status = 'pending-transport' AND p.payment_type = 'Down Payment') 
      OR (t.status = 'pending-transport' AND p.payment_type = 'Full Payment')
      AND p.final_payment_receipt IS NOT NULL
    ");

    // FETCH for transport
    $get_ongoing_transport_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='for-transport'");

    // FETCH for receiving
    $get_for_receiving_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='for-receiving'");

    // FETCH for receiving
    $get_pending_for_receiving_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='client-receiving-confirmation'");

    // FETCH completed
    $get_for_completed_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='completed'");

    // FETCH pending cancellation
    $get_for_cancellation_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='for-cancellation'");

    // FETCH pending cancellation
    $get_cancelled_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='cancelled'");

    // FETCH pending cancellation
    $get_rejected_transactions = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='rejected'");

    // FETCH Client Completed
    $get_clientCompleted = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status");

    // FETCH Client Cancelled
    $get_clientCancelled = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status");

    // FETCH Admin Profile Image for User Logged Profile
    if(isset($_SESSION['admin_id'])){
      $admin_id = $_SESSION['admin_id'];
      $get_admin_profile = mysqli_query($conn, "SELECT * FROM tbl_administrator WHERE admin_id = '$admin_id'");
    }
    // FETCH Admin Data for Administrators Table
    $get_mainAdmin = mysqli_query($conn, "SELECT * FROM tbl_administrator WHERE role = 0");
    $get_otherAdmins = mysqli_query($conn, "SELECT * FROM tbl_administrator WHERE role = 1 ORDER BY created_on ASC");

    // FETCH Admin Data for Archived Administrators Table
    $get_archivedAdmin = mysqli_query($conn, "SELECT * FROM tbl_archived_administrator ORDER BY archived_on ASC");

    // FETCH Breeds Data for Animal Breeds Table
    $get_breeds_validate = mysqli_query($conn, "SELECT * FROM tbl_breeds WHERE status = 0 ORDER BY submitted_on ASC");
    $get_breeds_validated = mysqli_query($conn, "SELECT * FROM tbl_breeds WHERE status = 1 ORDER BY approved_on ASC");

    // FETCH Species Data for Animal Species Table
    $get_species_validate = mysqli_query($conn, "SELECT * FROM tbl_species WHERE status = 0 ORDER BY submitted_on ASC");
    $get_species_validated = mysqli_query($conn, "SELECT * FROM tbl_species WHERE status = 1 ORDER BY approved_on ASC");

    // FETCH Breeds Data for Archived Breeds Table
    $get_archivedBreeds = mysqli_query($conn, "SELECT * FROM tbl_archived_breeds ORDER BY archived_on ASC");

    // FETCH Species Data for Archived Species Table
    $get_archivedSpecies = mysqli_query($conn, "SELECT * FROM tbl_archived_species ORDER BY archived_on ASC");
    
    // FETCH Admin Data for View Administrator
    if (isset($_GET['fetch_admin_id'])) {
      $id = $_GET['fetch_admin_id'];
      $get_admin = mysqli_query($conn, "SELECT * FROM tbl_administrator WHERE admin_id = '$id'");
      $get_admin_result = mysqli_fetch_assoc($get_admin);
      
      $adminData = [
          'currentAdmin_id' => $_SESSION['admin_id'],
          'currentAdmin_role' => $_SESSION['role'],
          'id' => $get_admin_result['admin_id'],
          'name' => $get_admin_result['name'],
          'username' => $get_admin_result['username'],
          'password' => $get_admin_result['password'],
          'imageData' => base64_encode($get_admin_result['img_profile'])
      ];
      
      header('Content-Type: application/json');
      echo json_encode($adminData);
      exit;
    }

    $currentDate = date('Y-m-d');
    // FETCH Client Data for Clients Table
    $get_clients = mysqli_query($conn, "SELECT * FROM tbl_clients ORDER BY created_on DESC LIMIT 4");
    $get_clients_dashboard = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE created_on='$currentDate'");
    $get_clients_dashboard_count = mysqli_num_rows($get_clients_dashboard);

    $get_messages_dashboard = mysqli_query($conn, "SELECT * FROM tbl_messages WHERE user_receiver_id='ADMIN' ORDER BY timestamp LIMIT 4");
    $get_messagesCount_dashboard = mysqli_query($conn, "SELECT * FROM tbl_messages WHERE user_receiver_id='ADMIN'");
    $get_messages_dashboard_count = mysqli_num_rows($get_messagesCount_dashboard);

    $get_requests_dashboard = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='for-approval' LIMIT 4");
    $get_allrequests_dashboard = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE status='for-approval'");
    $get_allrequests_dashboard_count = mysqli_num_rows($get_allrequests_dashboard);

    // FETCH Client Data for View Client
    if (isset($_GET['fetch_client_id'])) {
      $id = $_GET['fetch_client_id'];
      $get_client = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$id'");
      $get_client_result = mysqli_fetch_assoc($get_client);
      
      $clientData = [
          'client_id' => $get_client_result['client_id'],
          'first_name' => $get_client_result['first_name'],
          'last_name' => $get_client_result['last_name'],
          'email' => $get_client_result['email'],
          'imageData' => base64_encode($get_client_result['img_profile'])
      ];
      
      header('Content-Type: application/json');
      echo json_encode($clientData);
      exit;
    }

    // FETCH Species Data for Confirm Validate Species
    if (isset($_GET['fetch_species_id'])) {
      $id = $_GET['fetch_species_id'];
      $get_species = mysqli_query($conn, "SELECT * FROM tbl_species_validate WHERE species_id = '$id'");
      $get_species_result = mysqli_fetch_assoc($get_species);
      
      $speciesData = [
          'species_id' => $get_species_result['species_id'],
          'submitted_by' => $get_species_result['submitted_by'],
          'description' => $get_species_result['description'],
          'submitted_on' => $get_species_result['submitted_on']
      ];
      
      header('Content-Type: application/json');
      echo json_encode($speciesData);
      exit;
    }
    
    // FETCH COUNT 
    // FETCH COUNT Admin Notifications
    $get_adminNotifications_count = "SELECT COUNT(*) FROM tbl_admin_notif";
    $get_adminNotifications_count_result = $conn->query($get_adminNotifications_count);
    $adminNotifications_row = $get_adminNotifications_count_result->fetch_row();
    $adminNotifications_count = $adminNotifications_row[0];

    // FETCH COUNT Clients
    $get_client_count = "SELECT COUNT(*) FROM tbl_clients";
    $get_client_count_result = $conn->query($get_client_count);
    $client_row = $get_client_count_result->fetch_row();
    $client_count = $client_row[0];

    // FETCH COUNT Administrators
    $get_administrator_count = "SELECT COUNT(*) FROM tbl_administrator";
    $get_administrator_count_result = $conn->query($get_administrator_count);
    $administrator_row = $get_administrator_count_result->fetch_row();
    $administrator_count = $administrator_row[0];

    // FETCH COUNT Validate Breeds
    $get_validate_breeds_count = "SELECT COUNT(*) FROM tbl_breeds WHERE status = 0";
    $get_validate_breeds_count_result = $conn->query($get_validate_breeds_count);
    $validate_breeds_row = $get_validate_breeds_count_result->fetch_row();
    $validate_breeds_count = $validate_breeds_row[0];

    // FETCH COUNT Validated Breeds
    $get_validated_breeds_count = "SELECT COUNT(*) FROM tbl_breeds WHERE status = 1";
    $get_validated_breeds_count_result = $conn->query($get_validated_breeds_count);
    $validated_breeds_row = $get_validated_breeds_count_result->fetch_row();
    $validated_breeds_count = $validated_breeds_row[0];

    // FETCH COUNT Validate Species
    $get_validate_species_count = "SELECT COUNT(*) FROM tbl_species WHERE status = 0";
    $get_validate_species_count_result = $conn->query($get_validate_species_count);
    $validate_species_row = $get_validate_species_count_result->fetch_row();
    $validate_species_count = $validate_species_row[0];

    // FETCH COUNT Validated Species
    $get_validated_species_count = "SELECT COUNT(*) FROM tbl_species WHERE status = 1";
    $get_validated_species_count_result = $conn->query($get_validated_species_count);
    $validated_species_row = $get_validated_species_count_result->fetch_row();
    $validated_species_count = $validated_species_row[0];

    // FETCH COUNT Archived Administrator Accounts
    $get_archivedAdmin_count = "SELECT COUNT(*) FROM tbl_archived_administrator";
    $get_archivedAdmin_count_result = $conn->query($get_archivedAdmin_count);
    $archivedAdmin_row = $get_archivedAdmin_count_result->fetch_row();
    $archivedAdmin_count = $archivedAdmin_row[0];

    // FETCH COUNT Archived Breeds
    $get_archivedBreeds_count = "SELECT COUNT(*) FROM tbl_archived_breeds";
    $get_archivedBreeds_count_result = $conn->query($get_archivedBreeds_count);
    $archivedBreeds_row = $get_archivedBreeds_count_result->fetch_row();
    $archivedBreeds_count = $archivedBreeds_row[0];

    // FETCH COUNT Archived Species
    $get_archivedSpecies_count = "SELECT COUNT(*) FROM tbl_archived_species";
    $get_archivedSpecies_count_result = $conn->query($get_archivedSpecies_count);
    $archivedSpecies_row = $get_archivedSpecies_count_result->fetch_row();
    $archivedSpecies_count = $archivedSpecies_row[0];

  
?>