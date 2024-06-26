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
	<title>Breeds</title>
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
				<a href="#" class=" "><i class='bx bxs-collection icon'></i> Transactions <i class='bx bx-chevron-right icon-right' ></i></a>
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
				<a href="#" class="active-dropdown"><i class='bx bxs-dog icon'></i> Animal Data <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<h1 class="title">Breeds</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>Animal Data</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Breeds</a></li>
			</ul>
			<!-- Breadcrumbs -->

			<!-- Validate Animal Breeds -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<h4 class="card-title table-card-title">Validate Animal Breeds</h4>
					<p class="card-description table-card-description">
						Displaying all animal breed entries from earliest submitted to recently submitted animal breeds.
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
									<th>Breed ID</th>
									<th>Submitted By</th>
									<th>Description</th>
									<th>Species</th>
									<th>Submitted On</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php while($get_breeds_validate_result = mysqli_fetch_array($get_breeds_validate)) { 
									$clientID = $get_breeds_validate_result['submitted_by'];
									$get_clientRecords = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$clientID'");
									$get_clientRecords_result = mysqli_fetch_array($get_clientRecords);

									$speciesId = $get_breeds_validate_result['species_id'];
									$get_speciesRecords = mysqli_query($conn, "SELECT * FROM tbl_species WHERE species_id = '$speciesId'");
									$get_speciesRecords_result = mysqli_fetch_array($get_speciesRecords);
								?>
									<tr>
										<td><?php echo $get_breeds_validate_result['breed_id']; ?></td>
										<td class="table-image-text"><img src="data:image/jpeg;base64,<?php echo base64_encode($get_clientRecords_result['img_profile']); ?>" alt="Client Profile Image"> <?php echo $get_clientRecords_result['first_name']; ?></td>
										<td><?php echo $get_breeds_validate_result['description']; ?></td>
										<td><?php echo $get_speciesRecords_result['description']; ?></td>
										<td><?php echo $get_breeds_validate_result['submitted_on']; ?></td>
										<td>
											<button class="btn-sm btn m-1 table-action-btn action-approve" data-toggle="modal" data-target="#confirmValidateBreeds" onclick="confirmValidateBreedsFill(this)" data-id="<?php echo $get_breeds_validate_result['breed_id']; ?>"><i class="material-icons table-action-icon">redo</i></button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php if ($validate_breeds_count == 0) { ?>
							<p class="card-description table-card-description no-entry-description">
								There are currently no entries in this table.
							</p>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- Validate Animal Breeds -->

			<!-- Validated Animal Breeds -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<h4 class="card-title table-card-title">Validated Animal Breeds</h4>
					<p class="card-description table-card-description">
						Displaying all animal breed entries from earliest approved to recently approved animal breeds.
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
									<th>Breed ID</th>
									<th>Submitted By</th>
									<th>Description</th>
									<th>Species</th>
									<th>Approved On</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php while($get_breeds_validated_result = mysqli_fetch_array($get_breeds_validated)) {
									$clientID = $get_breeds_validated_result['submitted_by'];
									$get_clientRecords = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id = '$clientID'");
									$get_clientRecords_result = mysqli_fetch_array($get_clientRecords);	

									$speciesId = $get_breeds_validated_result['species_id'];
									$get_speciesRecords = mysqli_query($conn, "SELECT * FROM tbl_species WHERE species_id = '$speciesId'");
									$get_speciesRecords_result = mysqli_fetch_array($get_speciesRecords);
								?>
									<tr>
										<td><?php echo $get_breeds_validated_result['breed_id']; ?></td>
										<td class="table-image-text"><img src="data:image/jpeg;base64,<?php echo base64_encode($get_clientRecords_result['img_profile']); ?>" alt="Client Profile Image"> <?php echo $get_clientRecords_result['first_name']; ?></td>
										<td><?php echo $get_breeds_validated_result['description'] ?? "---"; ?></td>
										<td><?php echo $get_speciesRecords_result['description'] ?? "---"; ?></td>
										<td><?php echo $get_breeds_validated_result['approved_on']; ?></td>
										<td>
											<button class="btn-sm btn m-1 table-action-btn action-deny" onclick="archiveBreed('<?php echo $get_breeds_validated_result['description']; ?>', '<?php echo $get_breeds_validated_result['breed_id']; ?>')"><i class="material-icons table-action-icon">archive</i></button>
											
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php if ($validated_breeds_count == 0) { ?>
							<p class="card-description table-card-description no-entry-description">
								There are currently no entries in this table.
							</p>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- Validated Animal Species -->

			<!-- Confirm Validate Breeds -->
			<div class="modal fade" id="confirmValidateBreeds" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content popup">
						<div class="modal-header">
							<h5 class="modal-title popup-title" id="exampleModalCenterTitle">Confirm Entry</h5>
							<span aria-hidden="true" data-dismiss="modal" class="modal-exit">&times;</span>
							</button>
						</div>
						<form id="validateBreedsForm" action="maint_breeds.php" method="POST" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" id="e_admin_id" name="e_admin_id">
							<div class="modal-body" style="padding-bottom: 0px;">
								<div class="row form-modal">
									<div class="col ml-auto">
										<div class="pop-up-prompt" id="update_admin_success"></div>
										<div class="pop-up-prompt" id="update_admin_error"></div>
										<div class="row mb-3 ml-auto">
											<p class="pop-up-heading" style="padding-left: 0px;">Breed Description:</p>
											<input type="text" class="form-control" placeholder="Breed Description" name="c_breed_description" id="c_breed_description" required>
										</div>
										<input type="hidden" id="c_breed_id" name="c_breed_id">
										<!-- <input type="text" id="c_submitted_by" name="c_submitted_by">
										<input type="text" id="c_submitted_on" name="c_submitted_on"> -->
									</div>
									<input type="hidden" id="validateBreedsSubmit" name="validateBreeds"/>
									<div class="modal-footer popup-footer">
										<button type="button" class="btn btn-secondary action-cancel" data-dismiss="modal">Close</button>
										<button type="submit" class="btn action-view" name="validateBreeds" id="confirmValidateBreedsSubmit" onclick="confirmValidateBreed(event)">Save to Records</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Confirm Validate Breeds -->
		</main>
		<!-- Main -->
	</section>
</body>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap -->
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- SweetAlert -->
<!-- External JavaScript -->
<script src="js/script.js"></script>
<!-- External JavaScript -->
</html>