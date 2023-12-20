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
      header("Location: ../notifications.php?mark_read_notif_success=" . urlencode($mark_read_notif_success));
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
          $update_admin_success = "There ano changes done to Admin - $e_admin_name";
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

    // FETCH Client Cancellations
    $get_clientCancellations = mysqli_query($conn, "SELECT * FROM tbl_transactions");

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