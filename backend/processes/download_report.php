<?php
include "connection.php";

$output = "";

if(isset($_POST['download_report'])){

    function tStatusTXT($status) {
        switch ($status) {
            case 'for-approval':
                return 'Pending For Approval';
            case 'for-downpayment':
                return 'Awaiting your Down Payment';
            case 'for-payment':
                return 'Awaiting your Payment';
            case 'i-receipt-submitted':
                return 'Initial Payment Receipt Submitted';
            case 'f-receipt-submitted':
                return 'Payment Receipt Submitted';
            case 'i-receipt-reattempt':
                return 'Initial Payment Receipt Invalid';
            case 'f-receipt-reattempt':
                return 'Payment Receipt Invalid';
            case 'pending-pickup':
                return 'Pending for Pickup';
            case 'for-pickup':
                return 'Ready for Pickup';
            case 'pickup-success':
                return 'Pickup Successful';
            case 'pickup-unsuccessful':
                return 'Pickup Unsuccessful';
            case 'ongoing-medical':
                return 'Ongoing Medical Processing';
            case 'for-booking':
                return 'Currently being Booked';
            case 'for-transport':
                return 'Transporting to Destination';
            case 'for-receiving':
                return 'Animal Ready to be Received';
            case 'completed':
                return 'Transaction Completed';
            case 'for-cancellation':
                return 'Reviewing Cancellation';
            case 'pending-return':
                return 'Pending for Return';
            case 'for-return':
                return 'On Transit back to the sender';
            case 'confirmation-return':
                return 'Awaiting Return Confirmation';
            case 'cancelled':
                return 'Transaction Cancelled';
            default:
                return '404 STATUS';
        }
    }

    $get_all_available_transactions1 = mysqli_query($conn, "SELECT * FROM tbl_transactions");
    $i = 1;

    if (mysqli_num_rows($get_all_available_transactions1) > 0) {
        $output .= '
        <table class="table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Sender\'s Name</th>
                    <th>Receiver\'s Name</th>
                    <th>Breed</th>
                    <th>Species</th>
                    <th>Payment Type</th>
                    <th>Payment Method</th>
                    <th>Transaction Cost</th>
                    <th>Date Filed</th>
                    <th>Transaction Status</th>
                </tr>
            </thead>
            <tbody>
        ';

        while ($get_all_available_transactions_results1 = mysqli_fetch_array($get_all_available_transactions1)) {

            $tID = $get_all_available_transactions_results1['transaction_id'];
            $clientID = $get_all_available_transactions_results1['client_id'];
            $dateID = $get_all_available_transactions_results1['date_id'];
            $animalID = $get_all_available_transactions_results1['animal_id'];
            $receiverID = $get_all_available_transactions_results1['receiver_id'];
            $transaction_status = $get_all_available_transactions_results1['status'];
            

            $get_clientRecords = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$clientID'");
            $get_clientRecords_result = mysqli_fetch_array($get_clientRecords);
            $client_name = $get_clientRecords_result['first_name'] . " " . $get_clientRecords_result['last_name'];

            $get_receiver_records =  mysqli_query($conn, "SELECT * FROM tbl_receivers WHERE receiver_id = '$receiverID'");
            $get_receiver_records_result = mysqli_fetch_array($get_receiver_records);
            $receiver_name = $get_receiver_records_result['first_name'] . " " . $get_receiver_records_result['last_name'];

            $get_breed_id = mysqli_query($conn, "SELECT breed_id FROM tbl_animals WHERE transaction_id = '$tID'");
            $breed_id_result = mysqli_fetch_assoc($get_breed_id);
            $breedID = $breed_id_result['breed_id'];

            $get_breed_data = mysqli_query($conn, "SELECT species_id, description FROM tbl_breeds WHERE breed_id = '$breedID'");
            $breed_data_result = mysqli_fetch_assoc($get_breed_data);
            $breed_name = $breed_data_result['description'];
            $speciesID = $breed_data_result['species_id'];

            $get_species_name = mysqli_query($conn, "SELECT description FROM tbl_species WHERE species_id = '$speciesID'");
            $species_name_result = mysqli_fetch_assoc($get_species_name);
            $species_name = $species_name_result['description'];

            $get_payment_type = mysqli_query($conn, "SELECT * FROM tbl_payments WHERE transaction_id = '$tID'");
            $get_payment_type_results = mysqli_fetch_assoc($get_payment_type);
            $initial_cost = 0;
            $final_cost = 0;
            $payment_type = $get_payment_type_results['payment_type'];
            $payment_method = $get_payment_type_results['payment_method'];
            if (empty($get_payment_type_results['initial_payment_cost']) || $get_payment_type_results['initial_payment_cost'] === null) {
                $initial_cost == 0;
            } else {
                $initial_cost = $get_payment_type_results['initial_payment_cost'];
            }

            if (empty($get_payment_type_results['final_payment_cost']) || $get_payment_type_results['final_payment_cost'] === null){
                $final_cost == 0;
            } else {
                $final_cost = $get_payment_type_results['final_payment_cost'];
            }

            $transaction_cost = $initial_cost + $final_cost;
            
            $get_dateRecords = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE date_id = '$dateID'");
            $get_dateRecords_result = mysqli_fetch_array($get_dateRecords);
            $date_filed = $get_dateRecords_result['date_filed_request'];

            preg_match_all('/Completed-(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $get_dateRecords_result['other_transaction_dates'], $matches);
            $lastSubmittedDateTime = end($matches[1]);
            $dateTimeObj = new DateTime($lastSubmittedDateTime);
            $formattedDateTime = $dateTimeObj->format('Y-m-d');

            $output .= '
                <tr>
                    <td>' .  $tID . '</td>
                    <td>' . $client_name . '</td>
                    <td>' . $receiver_name . '</td>
                    <td>' . $breed_name . '</td>
                    <td>' . $species_name . '</td>
                    <td>' . $payment_type . '</td>
                    <td>' . $payment_method . '</td>
                    <td>' .  $transaction_cost  . '</td>
                    <td>' . $date_filed  . '</td>
                    <td>' . tStatusTXT($transaction_status) . '</td>
                </tr>
            ';
        }

        $output .= '
            </tbody>
        </table>
        ';

        // Set headers before any output
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=reports.xls');

        // Output the final content
        echo $output;
    } else {
        $transaction_approved_succes = "No data retrieved";
        header("location: ../reports_transactionsAudit.php?transaction_approved_success=". urldecode($transaction_approved_succes));
    }
}

?>