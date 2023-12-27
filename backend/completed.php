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
	<title>Completed</title>
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
					<li class="divider" data-text="Transport"></li>
					<li><a href="pickup.php">Pickup</a></li>
					<li><a href="return.php">Return</a></li>
					<!-- Payment -->
					<li class="divider" data-text="Payment"></li>
					<li><a href="initial_payment.php">Initial Payment</a></li>
					<li><a href="final_payment.php">Final Payment</a></li>
					<li><a href="fullCash_payment.php">Full Payment</a></li>
					<!-- Process -->
					<li class="divider" data-text="Process"></li>
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
				<!-- Pricing Maintenance -->
				<a href="#"><i class='bx bxs-purchase-tag icon' ></i> Pricing Data <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="maint_cagePricing.php">Cage Pricing</a></li>
					<li><a href="maint_pickupPricing.php">Pickup Pricing</a></li>
					<li><a href="maint_transportPricing.php">Transport Pricing</a></li>
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
			<h1 class="title">Completed</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>Transactions</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Completed</a></li>
			</ul>
			<!-- Breadcrumbs -->

			<!-- Pickup -->
			<!-- Pending Payments -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<h4 class="card-title table-card-title">Completed Transactions</h4>
					<p class="card-description table-card-description">
						Transactions from this record are completed, transactions are ordered by latest completed transactions to earliest transactions.
					</p>
					<div class="table-search-dropdown">
						<form action="#">
							<div class="form-group" style="flex: 95;">
								<input type="text" placeholder="Search" id="table-search-client-completed">
								<i class='bx bx-search icon'></i>
							</div>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-sm table-hover table-striped table-bordered table-light" id="table-client-completed">
							<thead>
								<tr>
									<th>Transaction ID</th>
									<th>Client</th>
									<th>Animal Description</th>
									<th>Date Completed</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php while($get_for_completed_transactions_results = mysqli_fetch_array($get_for_completed_transactions)) { 
									// Fetching records of foreign keys
									$clientID = $get_for_completed_transactions_results['client_id'];
									$dateID = $get_for_completed_transactions_results['date_id'];
									$animalID = $get_for_completed_transactions_results['animal_id'];
									$transactionID = $get_for_completed_transactions_results['transaction_id'];

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

									$get_animalRecords = mysqli_query($conn, "SELECT * FROM tbl_animals WHERE animal_id = '$animalID'");
									$get_animalRecords_result = mysqli_fetch_array($get_animalRecords);
								?>
									<tr>
										<td><?php echo $transactionID; ?></td>
										<td class="table-image-text"><img src="data:image/jpeg;base64,<?php echo base64_encode($get_clientRecords_result['img_profile']); ?>" alt="Client Profile Image"> <span><?php echo $get_clientRecords_result['first_name']; ?></span></td>
										<td><?php echo $breed_name . ' ' . $species_name ?></td>
										<td><?php echo $get_dateRecords_result['date_completed']; ?></td>
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
			<!-- Pending Payments -->

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