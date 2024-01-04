<?php include 'processes/queries.php';?>
<?php include 'processes/session_validation.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	
	<link rel="icon" type="image/x-icon" href="images/app_icon.png">
	<title>Cancellations</title>
</head>
<body>
	
	<!-- Side Bar -->
	<section id="sidebar">
		
		<ul class="side-menu">
			<!-- Main -->
			<li class="divider" data-text="main"></li>
			<li><a href="dashboard.php"><i class='bx bxs-dashboard icon' ></i>Dashboard</a></li>
			<li>
				<a href="messages.php">
					<i class='bx bxs-message-square-dots icon' id="icon-notification" style="margin-right: -4px;"><span class="notification-badge"></span></i>
						Messages
				</a>
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
				<a href="#" class="active-dropdown"><i class='bx bxs-collection icon'></i> Transactions <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<li>
				<!-- Area Maintenance -->
				<a href="#"><i class='bx bx-current-location icon' ></i> Area Data <Datag></Datag> <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="maint_restrictedAreas.php">Restricted Areas</a></li>
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
					<li><a href="archived_clients.php">Clients</a></li>
					<li><a href="archived_administrators.php">Administrators</a></li>
					<!-- Animal Data -->
					<li class="divider" data-text="Animal Data"></li>
					<li><a href="archived_breeds.php">Breeds</a></li>
					<li><a href="archived_species.php">Species</a></li>
					<!-- Payment -->
					<li class="divider" data-text="Area Data"></li>
					<li><a href="archived_restricted_areas.php">Restricted Areas</a></li>
				</ul>
			</li>
			<li>
				<!-- Reports -->
				<a href="#"><i class='bx bxs-chart icon' ></i> Reports <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<h1 class="title">Cancellations</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>Transactions</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Cancellations</a></li>
			</ul>
			<!-- Breadcrumbs -->

			<!-- Cancellations -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<form action="#">
						<div class="form-group">
							<input type="text" placeholder="Search" id="table-search-client-cancellations">
							<i class='bx bx-search icon'></i>
						</div>
					</form>
					<div class="table-responsive">
						<table class="table table-sm table-hover table-striped table-bordered table-light" id="table-client-cancellations">
							<thead>
								<tr>
									<th>Transaction ID</th>
									<th>Client</th>
									<th>Reason</th>
									<th>Previous Status</th>
									<th>Date Filed</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php while($get_for_cancellation_transactions_results = mysqli_fetch_array($get_for_cancellation_transactions)) { 
									// Fetching records of foreign keys
									$clientID = $get_for_cancellation_transactions_results['client_id'];
									$dateID = $get_for_cancellation_transactions_results['date_id'];
									$animalID = $get_for_cancellation_transactions_results['animal_id'];
									$transactionID = $get_for_cancellation_transactions_results['transaction_id'];

									$get_payment_type = mysqli_query($conn, "SELECT * FROM tbl_payments WHERE transaction_id = '$transactionID'");
									$payment_type_result = mysqli_fetch_assoc($get_payment_type);
									$payment_type = $payment_type_result['payment_type'];

									$getReasonForCancellation = mysqli_query($conn, "SELECT * FROM tbl_cancelled_transactions WHERE transaction_id = '$transactionID'");
									$reasonForCancellationResult = mysqli_fetch_array($getReasonForCancellation);
									$reason_for_cancellation = $reasonForCancellationResult['reason_for_cancellation'];
									$previous_status = $reasonForCancellationResult['previous_status'];

									$get_clientRecords = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$clientID'");
									$get_clientRecords_result = mysqli_fetch_array($get_clientRecords);
									$client_name = $get_clientRecords_result['first_name'];

									$get_date_data = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE transaction_id = '$transactionID'");
									$get_date_data_results = mysqli_fetch_assoc($get_date_data);
									preg_match_all('/Applied Cancellation-(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $get_date_data_results['other_transaction_dates'], $matches);
									$lastSubmittedDateTime = end($matches[1]);
									$dateTimeObj = new DateTime($lastSubmittedDateTime);
									$formattedDateTime = $dateTimeObj->format('Y-m-d');
								?>
									<tr>
										<td><?php echo $transactionID; ?></td>
										<td class="table-image-text"><img src="data:image/jpeg;base64,<?php echo base64_encode($get_clientRecords_result['img_profile']); ?>" alt="Client Profile Image"> <span><?php echo $get_clientRecords_result['first_name']; ?></span></td>
										<td><?php echo $reason_for_cancellation ?></td>
										<td><?php echo $previous_status; ?></td>
										<td><?php echo $formattedDateTime ?></td>
										<td>
											<button class="btn-sm btn m-1 table-action-btn action-view" data-toggle="modal" data-target="#viewClientRequest" data-transaction-id="<?php echo $transactionID; ?>" onclick="viewClientRequest(this);"><i class="material-icons table-action-icon">visibility</i></button>
											<?php if($previous_status == 'for-approval' || $previous_status == 'for-downpayment' || $previous_status == 'i-receipt-submitted' || $previous_status == 'i-receipt-reattempt' || $previous_status == 'pending-pickup' || $previous_status == 'for-pickup' || $previous_status == 'pickup-unsuccessful' || ($previous_status == 'for-payment' && $payment_type == 'Full Payment') || ($previous_status == 'f-receipt-submitted' && $payment_type == 'Full Payment') || ($previous_status == 'f-receipt-reattempt' && $payment_type == 'Full Payment')){ ?>
												<button class="btn-sm btn m-1 table-action-btn action-approve" onclick="approveCancel('<?php echo $client_name; ?>', '<?php echo $transactionID; ?>')"><i class="material-icons table-action-icon">redo</i></button>
											<?php } else if (($previous_status == 'for-payment' && $payment_type = 'For Downpayment') || ($previous_status == 'f-receipt-submitted' && $payment_type = 'For Downpayment') || ($previous_status == 'f-receipt-reattempt' && $payment_type = 'For Downpayment') || $previous_status == 'pending-pickup' || $previous_status == 'pickup-success' || $previous_status == 'ongoing-medical' || $previous_status == 'for-booking'){ ?>
												<button class="btn-sm btn m-1 table-action-btn action-approve" data-toggle="modal" data-target="#addReturnLocationForm" data-client-id="<?php echo $clientID; ?>" data-transaction-id="<?php echo $transactionID; ?>" data-clientname="<?php echo $client_name; ?>" onclick="transportClientDetails(this)"><i class="material-icons table-action-icon">redo</i></button>
											<?php } ?>
											<button class="btn-sm btn m-1 table-action-btn action-deny" onclick="rejectCancel('<?php echo $client_name; ?>', '<?php echo $transactionID; ?>')"><i class="material-icons table-action-icon">thumb_down</i></button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Cancellations -->

			<!-- ADD TRANSPORT ATTACHMENTS -->
			<div class="modal fade" id="addReturnLocationForm" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content popup">
						<div class="modal-header">
							<h5 class="modal-title popup-title" id="exampleModalCenterTitle">Add Return Location</h5>
							<span aria-hidden="true" data-dismiss="modal" class="modal-exit">&times;</span>
						</div>
						<form id="returnLocationForm" action="cancellations.php" method="POST" autocomplete="off" enctype="multipart/form-data">
							<div class="modal-body" style="padding-bottom: 0px;">
								<div class="row form-modal" style="padding-right: 20px;">
									<div class="col col-md-12 ml-auto">
										<p class="pop-up-heading">Specify the return details:</p>
										<div class="form-group">
											<input type="hidden" name="client_name" id="client_name">
											<input type="hidden" name="client_id" id="client_id">
											<input type="hidden" name="transaction_id" id="transaction_id">
											<input type="text" name="dropoff_location" id="dropoff_location" placeholder="Dropoff address..." required>
										</div>
										<hr>
                                        <p class="pop-up-heading">Type in expected time of departure:</p>
                                        <div class="form-group">
                                            <label for="departureDateTime">Time of Departure:</label>
                                            <input type="datetime-local" class="form-control" id="departureDateTime" name="departureDateTime" required>
                                        </div>
                                        <hr>
                                        <p class="pop-up-heading">Type in expected time of arrival:</p>
                                        <div class="form-group">
                                            <label for="arrivalDateTime">Time of Arrival:</label>
                                            <input type="datetime-local" class="form-control" id="arrivalDateTime" name="arrivalDateTime" required>
                                        </div>
                                        <hr>
										<p class="pop-up-heading">Click the button to add attachments (if necessary):</p>
										<div class="form-group">
											<label for="transportAttachments">Choose Image:</label>
                                            <input type="file" class="form-control-file" accept=".jpg, .jpeg, .png, .pdf, .docx, .xls, .xlsx" id="transportAttachments" name="images[]" multiple>
                                        </div>
										<input type="hidden" id="addReturnLocationInput" name="addReturnLocation">
									</div>
									<div class="modal-footer popup-footer">
										<button type="button" class="btn btn-secondary action-cancel" data-dismiss="modal">Close</button>
										<button type="submit" id="addReturnLocationSubmit" class="btn action-view" name="addReturnLocation" onclick="returnLocation(event)">Proceed</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ADD TRANSPORT ATTACHMENTS -->

			<!-- MODAL TRANSACTION VIEWER -->
			<div class="modal fade" id="viewClientRequest" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog custom-modal-dialog" role="document">
					<div class="modal-content popup transaction-modal">
						<div class="modal-header transaction-modal">
							<h5 class="modal-title popup-title" id="exampleModalCenterTitle">Client Request</h5>
							<span aria-hidden="true" data-dismiss="modal" class="modal-exit">&times;</span>
							</button>
						</div>
						<div class="transactions-details-container">
							<?php include ('admin_transaction_viewer.php');?>
						</div>
					</div>
				</div>
			</div>
			<!-- MODAL TRANSACTION VIEWER -->
		</main>
		<!-- Main -->
	</section>
</body>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<!-- External JavaScript -->
	<script src="js/script.js"></script>
	<!-- External JavaScript -->
	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- SweetAlert -->
</html>