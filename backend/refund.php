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
	<title>Refund</title>
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
			<h1 class="title">Refund</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>Transactions</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Refund</a></li>
			</ul>
			<!-- Breadcrumbs -->

			<!-- Pickup -->
			<!-- Pending Payments -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<h4 class="card-title table-card-title">Pending Refunds</h4>
					<p class="card-description table-card-description">
						Transactions from this record are eligible for refund, once refund has been successful, transaction will be transferred to successful refunds.
					</p>
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
									<th>Client</th>
									<th>Date Approved</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php while($get_pending_refund_result =  mysqli_fetch_array($get_pending_refund)){
									$transactionID = $get_pending_refund_result['transaction_id'];

                                    $get_data = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE transaction_id = '$transactionID'");
                                    $get_data_result = mysqli_fetch_assoc($get_data);

									$clientID = $get_data_result['client_id'];
									$dateID = $get_data_result['date_id'];
									$paymentID = $get_data_result['payment_id'];

									$get_breed_id = mysqli_query($conn, "SELECT breed_id FROM tbl_animals WHERE transaction_id = '$transactionID'");
									$breed_id_result = mysqli_fetch_assoc($get_breed_id);
									$breedID = $breed_id_result['breed_id'];

									$get_breed_data = mysqli_query($conn, "SELECT species_id, description FROM tbl_breeds WHERE breed_id = '$breedID'");
									$breed_data_result = mysqli_fetch_assoc($get_breed_data);
									$breed_name = $breed_data_result['description'];
									$speciesID = $breed_data_result['species_id'];

									$get_species_name = mysqli_query($conn, "SELECT description FROM tbl_species WHERE species_id = '$speciesID'");
									$species_name_result = mysqli_fetch_assoc($get_species_name);
									$species_name = $species_name_result['description'];

									$get_clientRecords = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$clientID'");
									$get_clientRecords_result = mysqli_fetch_array($get_clientRecords);
									$client_name = $get_clientRecords_result['first_name'];

									$get_dateRecords = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE date_id = '$dateID'");
									$get_dateRecords_result = mysqli_fetch_array($get_dateRecords);

									$get_date_data = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE transaction_id = '$transactionID'");
									$get_date_data_results = mysqli_fetch_assoc($get_date_data);
									preg_match_all('/Approved-(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $get_date_data_results['other_transaction_dates'], $matches);
									$lastSubmittedDateTime = end($matches[1]);
									$dateTimeObj = new DateTime($lastSubmittedDateTime);
									$formattedDateTime = $dateTimeObj->format('Y-m-d');
								
								?>
								<tr>
									<td><?php echo $transactionID; ?></td>
									<td class="table-image-text"><img src="data:image/jpeg;base64,<?php echo base64_encode($get_clientRecords_result['img_profile']); ?>" alt="Client Profile Image"> <span><?php echo $get_clientRecords_result['first_name']; ?></span></td>
									<td><?php echo $formattedDateTime ?></td>
									<td>
									    <button class="btn-sm btn m-1 table-action-btn action-view" data-toggle="modal" data-target="#viewClientRequest" data-transaction-id="<?php echo $transactionID; ?>" onclick="viewClientRequest(this);"><i class="material-icons table-action-icon">visibility</i></button>
                                        <button class="btn-sm btn m-1 table-action-btn action-approve" data-toggle="modal" data-target="#addRefund" data-client-id="<?php echo $clientID; ?>" data-transaction-id="<?php echo $transactionID; ?>" data-clientname="<?php echo $client_name; ?>" onclick="refundClientDetails(this)"><i class="material-icons table-action-icon">thumb_up</i></button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Pending Payments -->

			<!-- On Transit -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<h4 class="card-title table-card-title">Submitted Refunds</h4>
					<p class="card-description table-card-description">
						Transactions from this record are submitted refunds, awaiting client approval.
					</p>
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
									<th>Client</th>
									<th>Payment Method</th>
									<th>Date Refunded</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php while($get_submitted_refund_result =  mysqli_fetch_array($get_submitted_refund)){
									$transactionID = $get_submitted_refund_result['transaction_id'];

                                    $get_data = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE transaction_id = '$transactionID'");
                                    $get_data_result = mysqli_fetch_assoc($get_data);

									$clientID = $get_data_result['client_id'];
									$dateID = $get_data_result['date_id'];
									$paymentID = $get_data_result['payment_id'];

                                    $get_payment_method = mysqli_query($conn, "SELECT * FROM tbl_payments WHERE transaction_id = '$transactionID'");
                                    $payment_method_result = mysqli_fetch_assoc($get_payment_method);
                                    $payment_method = $payment_method_result['payment_method'];

									$get_breed_id = mysqli_query($conn, "SELECT breed_id FROM tbl_animals WHERE transaction_id = '$transactionID'");
									$breed_id_result = mysqli_fetch_assoc($get_breed_id);
									$breedID = $breed_id_result['breed_id'];

									$get_breed_data = mysqli_query($conn, "SELECT species_id, description FROM tbl_breeds WHERE breed_id = '$breedID'");
									$breed_data_result = mysqli_fetch_assoc($get_breed_data);
									$breed_name = $breed_data_result['description'];
									$speciesID = $breed_data_result['species_id'];

									$get_species_name = mysqli_query($conn, "SELECT description FROM tbl_species WHERE species_id = '$speciesID'");
									$species_name_result = mysqli_fetch_assoc($get_species_name);
									$species_name = $species_name_result['description'];

									$get_clientRecords = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$clientID'");
									$get_clientRecords_result = mysqli_fetch_array($get_clientRecords);
									$client_name = $get_clientRecords_result['first_name'];

									$get_dateRecords = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE date_id = '$dateID'");
									$get_dateRecords_result = mysqli_fetch_array($get_dateRecords);

									$get_date_data = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE transaction_id = '$transactionID'");
									$get_date_data_results = mysqli_fetch_assoc($get_date_data);
									preg_match_all('/Refund Amount Updated-(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $get_date_data_results['other_transaction_dates'], $matches);
									$lastSubmittedDateTime = end($matches[1]);
									$dateTimeObj = new DateTime($lastSubmittedDateTime);
									$formattedDateTime = $dateTimeObj->format('Y-m-d');
								?>
								<tr>
									<td><?php echo $transactionID; ?></td>
									<td class="table-image-text"><img src="data:image/jpeg;base64,<?php echo base64_encode($get_clientRecords_result['img_profile']); ?>" alt="Client Profile Image"> <span><?php echo $get_clientRecords_result['first_name']; ?></span></td>
									<td><?php echo $payment_method; ?></td>
									<td><?php echo $formattedDateTime ?></td>
									<td>
										<button class="btn-sm btn m-1 table-action-btn action-view" data-toggle="modal" data-target="#viewClientRequest" data-transaction-id="<?php echo $transactionID; ?>" onclick="viewClientRequest(this);"><i class="material-icons table-action-icon">visibility</i></button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- On Transit -->

			<!-- Reattempt Payments -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<h4 class="card-title table-card-title">Successful Refunds</h4>
					<p class="card-description table-card-description">
                        Transactions from this record are successful refunds
					</p>
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
									<th>Client</th>
									<th>Payment Method</th>
									<th>Date Payment</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php while($get_refunded_transactions_results =  mysqli_fetch_array($get_refunded_transactions)){
									$transactionID = $get_refunded_transactions_results['transaction_id'];

                                    $get_data = mysqli_query($conn, "SELECT * FROM tbl_transactions WHERE transaction_id = '$transactionID'");
                                    $get_data_result = mysqli_fetch_assoc($get_data);

									$clientID = $get_data_result['client_id'];
									$dateID = $get_data_result['date_id'];
									$paymentID = $get_data_result['payment_id'];

                                    $get_payment_method = mysqli_query($conn, "SELECT * FROM tbl_payments WHERE transaction_id = '$transactionID'");
                                    $payment_method_result = mysqli_fetch_assoc($get_payment_method);
                                    $payment_method = $payment_method_result['payment_method'];

									$get_breed_id = mysqli_query($conn, "SELECT breed_id FROM tbl_animals WHERE transaction_id = '$transactionID'");
									$breed_id_result = mysqli_fetch_assoc($get_breed_id);
									$breedID = $breed_id_result['breed_id'];

									$get_breed_data = mysqli_query($conn, "SELECT species_id, description FROM tbl_breeds WHERE breed_id = '$breedID'");
									$breed_data_result = mysqli_fetch_assoc($get_breed_data);
									$breed_name = $breed_data_result['description'];
									$speciesID = $breed_data_result['species_id'];

									$get_species_name = mysqli_query($conn, "SELECT description FROM tbl_species WHERE species_id = '$speciesID'");
									$species_name_result = mysqli_fetch_assoc($get_species_name);
									$species_name = $species_name_result['description'];

									$get_clientRecords = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$clientID'");
									$get_clientRecords_result = mysqli_fetch_array($get_clientRecords);
									$client_name = $get_clientRecords_result['first_name'];

									$get_dateRecords = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE date_id = '$dateID'");
									$get_dateRecords_result = mysqli_fetch_array($get_dateRecords);

									$get_date_data = mysqli_query($conn, "SELECT * FROM tbl_transactions_dates WHERE transaction_id = '$transactionID'");
									$get_date_data_results = mysqli_fetch_assoc($get_date_data);
									preg_match_all('/Refunded-(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $get_date_data_results['other_transaction_dates'], $matches);
									$lastSubmittedDateTime = end($matches[1]);
									$dateTimeObj = new DateTime($lastSubmittedDateTime);
									$formattedDateTime = $dateTimeObj->format('Y-m-d');
								?>
								<tr>
									<td><?php echo $transactionID; ?></td>
									<td class="table-image-text"><img src="data:image/jpeg;base64,<?php echo base64_encode($get_clientRecords_result['img_profile']); ?>" alt="Client Profile Image"> <span><?php echo $get_clientRecords_result['first_name']; ?></span></td>
									<td><?php echo $payment_method; ?></td>
									<td><?php echo $formattedDateTime ?></td>
									<td>
										<button class="btn-sm btn m-1 table-action-btn action-view" data-toggle="modal" data-target="#viewClientRequest" data-transaction-id="<?php echo $transactionID; ?>" onclick="viewClientRequest(this);"><i class="material-icons table-action-icon">visibility</i></button>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Reattempt Payments -->
			<!-- Pickup -->

            <!-- Input Cost -->
			<div class="modal fade" id="addRefund" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content popup">
						<div class="modal-header">
							<h5 class="modal-title popup-title" id="exampleModalCenterTitle">Refund</h5>
							<span aria-hidden="true" data-dismiss="modal" class="modal-exit">&times;</span>
							</button>
						</div>
						<form id="refundCostForm" action="refund.php" method="POST" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" id="e_admin_id" name="e_admin_id">
							<div class="modal-body" style="padding-bottom: 0px;">
								<div class="row form-modal" style="padding-right: 20px;">
									<div class="col col-md-12 ml-auto">
										<div class="pop-up-prompt" id="update_admin_error"></div>
										<div class="row mb-3 ml-auto">
											<p class="pop-up-heading">Insert Refund Amount:</p>
											<input type="text" class="form-control" required pattern="[a-zA-Z0-9\s]+" oninput="validatePaymentAmountPattern(this)" placeholder="Refund Cost..." name="refund_cost" id="refund_cost">
											<input type="hidden" name="client_name" id="client_name">
											<input type="hidden" name="client_id" id="client_id">
											<input type="hidden" name="transaction_id" id="transaction_id">
										</div>
                                    </div>
                                    <hr>
                                    <div class="col col-md-12 ml-auto">
                                        <div class="modal-body" style="padding-bottom: 0px;">
                                            <div class="row form-modal" style="padding-right: 20px;">
                                                <div class="col col-md-12 ml-auto">
                                                <p class="pop-up-heading">Click the button to add refund attachments:</p>
                                                    <div class="form-group">
                                                        <label for="refundAtachments">Choose Image:</label>
                                                        <input type="file" class="form-control-file" accept=".jpg, .jpeg, .png, .pdf, .docx, .xls, .xlsx" id="refundAtachments" name="images[]" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
										<input type="hidden" id="insertRefundCostInput" name="insertRefundCost">
									</div>
									<div class="modal-footer popup-footer">
										<button type="button" class="btn btn-secondary action-cancel" data-dismiss="modal">Close</button>
										<button type="submit" id="insertRefundCostSubmit" class="btn action-view" name="insertRefundCost" onclick="insertRefundValidate(event)">Proceed</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Input Cost -->

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
		<!-- Notifications -->
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