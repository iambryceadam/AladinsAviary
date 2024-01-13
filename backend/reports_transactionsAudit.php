<?php include 'processes/queries.php';?>
<?php include 'processes/session_validation.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!-- Box Icons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<!-- Box Icons -->
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<!-- Bootstrap -->
	<!-- Google Icons -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Google Icons -->
	<!-- External Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<!-- External Stylesheet -->

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['species_description', 'occurrence_count'],
                <?php
                    // Your PHP code for SQL query
                    $sql = "SELECT s.description AS species_description, COUNT(*) AS occurrence_count
                            FROM tbl_transactions t
                            JOIN tbl_animals a ON t.animal_id = a.animal_id
                            JOIN tbl_breeds b ON a.breed_id = b.breed_id
                            JOIN tbl_species s ON b.species_id = s.species_id
                            GROUP BY s.description
                            ORDER BY occurrence_count DESC
                            LIMIT 5";

                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "['" . $row['species_description'] . "'," . $row['occurrence_count'] . "],";
                    }
                ?>
            ]);

            var options = {
                title: 'Top 5 Species Filed for Transactions',
				pieHole: 0.4,
				width: '10%',
				is3D: true,
				chartArea: {width: '80%', height: '80%'},
				legend: {
					alignment: 'center', // This is not a standard option, you may need to adjust positioning manually
					position: 'right', // You can change the position based on your preference
					textStyle: {fontSize: 16, color: 'black', bold: true}
				},
				titleTextStyle: {fontSize: 18, bold: true},
				responsive: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
	
	<link rel="icon" type="image/x-icon" href="images/app_icon.png">
	<title>Transactions Audit</title>
</head>
<body>
	
	<!-- Side Bar -->
	<section id="sidebar">
		
		<ul class="side-menu">
			<!-- Main -->
			<li class="divider" data-text="main"></li>
			<li><a href="dashboard.php"><i class='bx bxs-dashboard icon' ></i>Dashboard</a></li>
			<li>
				<?php
					if($get_admin_message_unread_count > 0){
						echo '
							<a href="messages.php" class="">
								<i class="bx bxs-message-square-dots icon" id="icon-notification" style="margin-right: -4px;"><span class="notification-badge"></span></i>
									Messages
							</a>
						';
					} else{
						echo '
						<a href="messages.php" class="">
							<i class="bx bxs-message-square-dots icon" id="icon-notification" style="margin-right: -4px; padding-right: 23px;"></span></i>
								Messages
						</a>
						';
					}
				?>
			</li>
			<li>
				<?php 
					if($get_admin_notif_active_count > 0){
						echo '
							<a href="notifications.php">
								<i class="bx bxs-bell icon" id="icon-notification" style="margin-right: -4px;">
									<span class="notification-badge"></span>
								</i>
								Notifications
							</a>
						';
					} else {
						echo '
							<a href="notifications.php">
								<i class="bx bxs-bell icon" id="icon-notification" style="margin-right: -4px; padding-right: 23px;">
								</i>
								Notifications
							</a>
						';
					}
				?>
			</li>

			<!-- Processes -->
			<li class="divider" data-text="processes"></li>
			<li>
				<!-- Transactions -->
				<a href="#" class=""><i class='bx bxs-collection icon'></i> Transactions <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<!-- Approval -->
					<li class="divider" data-text="Approval"></li>
					<li><a href="requests.php">Requests</a></li>
					<li><a href="cancellations.php">Cancellations</a></li>
					<!-- Transport -->
					<li class="divider" data-text="Shipment"></li>
					<li><a href="pickup.php">Pickup</a></li>
					<li><a href="return.php">Return</a></li>
					<!-- Payment -->
					<li class="divider" data-text="Payment"></li>
					<li><a href="initial_payment.php">Initial Payment</a></li>
					<li><a href="final_payment.php">Final Payment</a></li>
					<li><a href="fullCash_payment.php">Full Payment</a></li>
					<li><a href="refund.php">Refund</a></li>
					<!-- Process -->
					<li class="divider" data-text="Process"></li>
					<li><a href="booking.php">Booking</a></li>
					<li><a href="medical.php">Medical</a></li>
					<li><a href="transport.php">Transport</a></li>
					<li><a href="toReceive.php">To Receive</a></li>
					<!-- Summary -->
					<li class="divider" data-text="Summary"></li>
					<li><a href="completed.php">Completed</a></li>
					<li><a href="cancelled.php">Cancelled</a></li>
				</ul>
			</li>

			<!-- Manage -->
			<li class="divider" data-text="Manage"></li>
			<li>
				<!-- User Maintenance -->
				<a href="#"><i class='bx bxs-user-circle icon' ></i> User Accounts <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="maint_clients.php">Clients</a></li>
					<li><a href="maint_administrators.php">Administrators</a></li>
				</ul>
			</li>
			<li>
				<!-- Animal Maintenance -->
				<a href="#"><i class='bx bxs-dog icon'></i> Animal Data <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="maint_breeds.php">Breeds</a></li>
					<li><a href="maint_species.php">Species</a></li>
				</ul>
			</li>
			<!-- Analytics -->
			<li class="divider" data-text="Analytics"></li>
			<li>
				<!-- Archives -->
				<a href="#"><i class='bx bxs-box icon' ></i> Archives <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<!-- User Accounts -->
					<li class="divider" data-text="User Accounts"></li>
					<li><a href="archived_administrators.php">Administrators</a></li>
					<!-- Animal Data -->
					<li class="divider" data-text="Animal Data"></li>
					<li><a href="archived_breeds.php">Breeds</a></li>
					<li><a href="archived_species.php">Species</a></li>
					<!-- Payment -->
				</ul>
			</li>
			<li>
				<!-- Reports -->
				<a href="#" class="active-dropdown"><i class='bx bxs-chart icon' ></i> Reports <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="reports_auditTrail.php">Audit Trail</a></li>
					<li><a href="reports_transactionsAudit.php">Transactions Audit</a></li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- Side Bar -->

	<!-- Main Content -->
	<section id="content">
		<!-- Navigation Bar -->
		<nav>
			<a href="dashboard.php"><img src="images/app_icon.png" alt="App Icon" id="app-logo"></a>
			<i class='bx bx-menu toggle-sidebar'></i>
			
			<!-- Space -->
			<form action="#"><div class="form-group"></div></form>
			<!-- <input type="text" placeholder="Search...">
			<i class='bx bx-search icon' ></i> -->
			<p class="nav-link"></p>
			<p class="nav-link"></p>
			<!-- Space -->
			
			<!-- Profile -->
			<div class="profile">
				<?php while($get_admin_profile_result = mysqli_fetch_array($get_admin_profile)) { ?>
					<img src="data:image/jpeg;base64,<?php echo base64_encode($get_admin_profile_result['img_profile']); ?>" alt="Admin Profile Image">
				<?php } ?>
				<ul class="profile-link">
					<li><a href="processes/logout.php"><i class='bx bxs-exit' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- Navigation Bar -->

		<!-- Main -->
		<main>
			<!-- Page Header -->
			<h1 class="title">Transactions Audit</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>Reports</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Transactions Audit</a></li>
			</ul>
			<!-- Breadcrumbs -->
			
			<!-- Requests -->
			<div class="analytics-main-container">
				<div id="piechart" style="width: 40%; height: 350px; border-radius: 15px; background-color: white; border-style: solid; border-color: white;"></div>
				<div class="analytics-group-col">
					<div class="upper-analytics">
						<?php 
							$get_total_num_of_transactions = mysqli_query($conn, "SELECT COUNT(*) as transaction_count FROM tbl_transactions");
							$total_number_result = mysqli_fetch_assoc($get_total_num_of_transactions);
							$total_transactions_all = $total_number_result['transaction_count'];
							
							/////////////////////////////////////////////////////////////////////
							
							$get_payment_data = mysqli_query($conn, "SELECT * FROM tbl_payments");
							$get_payment_data_results = mysqli_fetch_all($get_payment_data, MYSQLI_ASSOC);

							$initial_total_cost = 0;
							$final_total_cost = 0;
							$total_transactions_selected = 0;

							foreach ($get_payment_data_results as $payment) {
								$initial_cost = empty($payment['initial_payment_cost']) ? 0 : $payment['initial_payment_cost'];
								$final_cost = empty($payment['final_payment_cost']) ? 0 : $payment['final_payment_cost'];

								// Only include transactions with non-zero values in either initial_payment_cost or final_payment_cost
								if ($initial_cost != 0 || $final_cost != 0) {
									$initial_total_cost += $initial_cost;
									$final_total_cost += $final_cost;
									$total_transactions_selected++;
								}
							}

							// Calculate the average per transaction
							$average_transaction_cost = 0;
							if ($total_transactions_selected > 0) {
								$average_transaction_cost = ($initial_total_cost + $final_total_cost) / $total_transactions_selected;
								$average_transaction_cost = number_format($average_transaction_cost, 2); // Limit to 2 decimals
							}
							
							$get_total_num_of_transactions = mysqli_query($conn, "SELECT COUNT(*) as total_transaction_count FROM tbl_transactions");
							$total_transaction_result = mysqli_fetch_assoc($get_total_num_of_transactions);
							$total_transactions_all = $total_transaction_result['total_transaction_count'];

							// Get the number of refunded transactions
							$get_refunded_transactions = mysqli_query($conn, "SELECT COUNT(DISTINCT transaction_id) as refunded_transaction_count FROM tbl_refunds");
							$refunded_transaction_result = mysqli_fetch_assoc($get_refunded_transactions);
							$refunded_transactions = $refunded_transaction_result['refunded_transaction_count'];

							// Calculate the refund rate
							$refund_rate = 0;
							if ($total_transactions_all > 0) {
								$refund_rate = ($refunded_transactions / $total_transactions_all) * 100;
								$refund_rate = number_format($refund_rate, 2); // Limit to 2 decimals
							}
							$get_refund_data = mysqli_query($conn, "SELECT SUM(refund_amount) as total_refund_amount, COUNT(DISTINCT transaction_id) as refunded_transaction_count FROM tbl_refunds");
							$refund_data_result = mysqli_fetch_assoc($get_refund_data);

							$total_refund_amount = $refund_data_result['total_refund_amount'];
							$refunded_transaction_count = $refund_data_result['refunded_transaction_count'];

							// Calculate the average refund cost
							$average_refund_cost = 0;
							if ($refunded_transaction_count > 0) {
								$average_refund_cost = $total_refund_amount / $refunded_transaction_count;
								$average_refund_cost = number_format($average_refund_cost, 2); // Limit to 2 decimals
							}
						?>
						<div class="container-analytics-cards">
							<h5>Total Number of transactions</h5>
							<br>
							<h2 class="data-analytics-num"><?php echo $total_transactions_all ?></h2>
						</div>
						<div class="container-analytics-cards">
							<h5>Average Transaction Cost</h5>
							<br>
							<h2 class="data-analytics-num">P<?php echo $average_transaction_cost ?></h2>
						</div>
					</div>
					<div class="upper-analytics">
						<div class="container-analytics-cards">
							<h5>Refund Rate</h5>
							<br>
							<h2 class="data-analytics-num"><?php echo $refund_rate?>%</span</h2>
						</div>
						<div class="container-analytics-cards">
							<h5>Average Refund Cost</h5>
							<br>
							<h2 class="data-analytics-num">P<?php echo $average_refund_cost ?></h2>
						</div>
					</div>
				</div>
			</div>
			
			<br>
			<div class="card table-card">
				<div class="card-body table-card-body">
					<div class="table-search-action">
						<form action="#">
							<div class="form-group" style="flex: 95;">
								<input type="text" placeholder="Search" id="table-search-admin">
								<i class='bx bx-search icon'></i>
							</div>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-sm table-hover table-striped table-bordered table-light" id="table-admin">
							<thead>
								<tr>
									<th>Transaction ID</th>
									<th>Sender's Name</th>
									<th>Receiver's Name</th>
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
							<?php 
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
							while($get_all_available_transactions_results = mysqli_fetch_array($get_all_available_transactions)) { 
								$tID = $get_all_available_transactions_results['transaction_id'];
								$clientID = $get_all_available_transactions_results['client_id'];
								$dateID = $get_all_available_transactions_results['date_id'];
								$animalID = $get_all_available_transactions_results['animal_id'];
								$receiverID = $get_all_available_transactions_results['receiver_id'];
								$transaction_status = $get_all_available_transactions_results['status'];
								

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

								$get_animalRecords = mysqli_query($conn, "SELECT * FROM tbl_animals WHERE animal_id = '$animalID'");
								$get_animalRecords_result = mysqli_fetch_array($get_animalRecords);
							?>
								<tr>
									<td><?php echo $tID; ?></td>
									<td><?php echo $client_name; ?></td>
									<td><?php echo $receiver_name; ?></td>
									<td><?php echo $breed_name; ?></td>
									<td><?php echo $species_name; ?></td>
									<td><?php echo $payment_type; ?></td>
									<td><?php echo $payment_method; ?></td>
									<td><?php echo $transaction_cost; ?></td>
									<td><?php echo $date_filed; ?></td>
									<td><?php echo tStatusTXT($transaction_status); ?></td>
								</tr>
							<?php 
							$transaction_cost = 0;
							} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Requests -->
		</main>
		<!-- Notifications -->
		<!-- Main -->
	</section>
</body>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- External JavaScript -->
	<script src="js/script.js"></script>
	<!-- External JavaScript -->
	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- SweetAlert -->
</html>