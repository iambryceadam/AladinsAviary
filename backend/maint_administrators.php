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
	<title>Administrators</title>
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
				<a href="#" class="active-dropdown"><i class='bx bxs-user-circle icon' ></i> User Accounts <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<h1 class="title">Administrators</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>User Accounts</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Administrators</a></li>
			</ul>
			<!-- Breadcrumbs -->

			<!-- Administrator Accounts -->
			<div class="card table-card">
				<div class="card-body table-card-body">
					<h4 class="card-title table-card-title">Administrator Accounts</h4>
					<p class="card-description table-card-description">
						Displaying all administrator accounts from earliest created administrator accounts to recently created administrator accounts.
					</p>
					<div class="table-search-action">
						<form action="#">
							<div class="form-group" style="flex: 95;">
								<input type="text" placeholder="Search" id="table-search-admin">
								<i class='bx bx-search icon'></i>
							</div>
						</form>
						<?php
							if($_SESSION['role'] == 0){
								echo('
								<button type="button" class="form-action" data-toggle="modal" data-target="#addAdministrator"><i class="bx bx-plus icon"></i></button>
								');
							}
						?>
					</div>
					<div class="table-responsive">
						<table class="table table-sm table-hover table-striped table-bordered table-light" id="table-admin">
							<thead>
								<tr>
									<th>Administrator ID</th>
									<th>Profile</th>
									<th>Name</th>
									<th>Username</th>
									<th>Password</th>
									<th>Created</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<!-- Main Administrator -->
								<?php while($get_mainAdmin_result = mysqli_fetch_array($get_mainAdmin)) { ?>
									<tr>
										<td><?php echo $get_mainAdmin_result['admin_id']; ?></td>
										<td class="table-image-text">
											<div class="table-image-container">
												<img src="data:image/jpeg;base64,<?php echo base64_encode($get_mainAdmin_result['img_profile']); ?>" alt="Admin Profile Image">
											</div>
										</td>
										<td><?php echo "<i class='bx bx-spa table-cell-main-admin'></i>".$get_mainAdmin_result['name']; ?></td>
										<td><?php if($_SESSION['role'] != 0){echo 'username hidden';}else{echo $get_mainAdmin_result['username'];}?></td>
										<td><?php if($_SESSION['role'] != 0){echo 'password hidden';}else{echo $get_mainAdmin_result['password'];}?></td>
										<td><?php echo $get_mainAdmin_result['created_on'];?></td>
										<td>
											<?php
												$mainAdminID = $get_mainAdmin_result['admin_id'];
												if ($_SESSION['role'] == 0) {
													echo '<button class="btn-sm btn m-1 table-action-btn action-approve" data-toggle="modal" data-target="#viewAdministrator" data-id="' . $mainAdminID . '" onclick="viewAdmin(this)"><i class="material-icons table-action-icon">visibility</i></button>';
													echo '<button class="btn-sm btn m-1 table-action-btn action-view" data-toggle="modal" data-target="#editAdministrator" data-id="' . $mainAdminID . '" onclick="editAdmin(this)"><i class="material-icons table-action-icon">edit</i></button>';
												} else {
													echo '<button class="btn-sm btn m-1 table-action-btn action-approve" data-toggle="modal" data-target="#viewAdministrator" data-id="' . $mainAdminID . '" onclick="viewAdmin(this)"><i class="material-icons table-action-icon">visibility</i></button>';
												}
											?>
										</td>
									</tr>
                                <?php } ?>
								<!-- Main Administrator -->

								<!-- Other Administrators -->
								<?php while($get_otherAdmins_result = mysqli_fetch_array($get_otherAdmins)) { ?>
									<tr>
										<td><?php echo $get_otherAdmins_result['admin_id']; ?></td>
										<td class="table-image-text">
											<div class="table-image-container">
												<img class="table-image-cell" src="data:image/jpeg;base64,<?php echo base64_encode($get_otherAdmins_result['img_profile']); ?>" alt="Profile Icon">
											</div>
										</td>
										<td><?php if($_SESSION['admin_id'] == $get_otherAdmins_result['admin_id']){echo $get_otherAdmins_result['name']." (You)";}else{echo $get_otherAdmins_result['name'];} ?></td>
										<td><?php if($_SESSION['role'] == 0 || $_SESSION['admin_id'] == $get_otherAdmins_result['admin_id']){echo $get_otherAdmins_result['username'];}else{echo 'username hidden';}?></td>
										<td><?php if($_SESSION['role'] == 0 || $_SESSION['admin_id'] == $get_otherAdmins_result['admin_id']){echo $get_otherAdmins_result['password'];}else{echo 'password hidden';}?></td>
										<td><?php echo $get_otherAdmins_result['created_on'];?></td>	
										<td>
											<?php
												$secondaryAdminID = $get_otherAdmins_result['admin_id'];
												if ($_SESSION['role'] == 0) {
													echo '<button class="btn-sm btn m-1 table-action-btn action-approve" data-toggle="modal" data-target="#viewAdministrator" data-id="' . $secondaryAdminID . '" onclick="viewAdmin(this)"><i class="material-icons table-action-icon">visibility</i></button>';
													echo '<button class="btn-sm btn m-1 table-action-btn action-view" data-toggle="modal" data-target="#editAdministrator" data-id="' . $secondaryAdminID . '" onclick="editAdmin(this)"><i class="material-icons table-action-icon">edit</i></button>';
													echo '<button class="btn-sm btn m-1 table-action-btn action-deny" onclick="archiveAdministrator(\'' . $get_otherAdmins_result['name'] . '\', \'' . $get_otherAdmins_result['admin_id'] . '\')"><i class="material-icons table-action-icon">archive</i></button>';
												} else {
													echo '<button class="btn-sm btn m-1 table-action-btn action-approve" data-toggle="modal" data-target="#viewAdministrator" data-id="' . $secondaryAdminID . '" onclick="viewAdmin(this)"><i class="material-icons table-action-icon">visibility</i></button>';
												}
											?>
										</td>
									</tr>
                                <?php } ?>
								<!-- Other Administrators -->
							</tbody>
						</table>
						<?php if ($administrator_count == 0) { ?>
							<p class="card-description table-card-description no-entry-description">
								There are currently no entries in this table.
							</p>
						<?php } ?>
						<p class="card-description table-card-description no-entry-description" id="search_no_match">
							There are no entries that match with your search.
						</p>
					</div>
				</div>
			</div>
			<!-- Administrator Accounts -->

			<!-- View Administrator -->
			<div class="modal fade" id="viewAdministrator" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content popup">
						<div class="modal-header">
							<h5 class="modal-title popup-title" id="v_admin_id"></h5>
							<span aria-hidden="true" data-dismiss="modal" class="modal-exit">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row form-modal" style="padding-right: 20px;">
								<div class="col col-md-4 ml-auto view-admin-image-div">
									<div class="image-container">
										<img id="v_image" src="" alt="Admin Profile" class="view-admin-image">
									</div>
								</div>
								<div class="col col-md-8 ml-auto">
									<div class="row mb-3 ml-auto">
										<p class="pop-up-heading" style="padding-left: 0px;">Administrator Name:</p>
										<input type="text" class="form-control" placeholder="Name" name="name" id="v_name" required readonly>
									</div>
									<div class="row mb-3 ml-auto">
										<div class="col form-col mr-3">
											<p class="pop-up-heading">Username:</p>
											<input type="text" class="form-control" placeholder="Username" name="username" id="v_username" required readonly>
										</div>
										<div class="col form-col">
											<p class="pop-up-heading">Password:</p>
											<input type="text" class="form-control" placeholder="Password" name="password" id="v_password" required readonly>
										</div>
										<input type="hidden" id="addAdministratorInput" name="addAdministrator">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- View Administrator -->

			<!-- Add Administrator -->
			<div class="modal fade" id="addAdministrator" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content popup">
						<div class="modal-header">
							<h5 class="modal-title popup-title" id="exampleModalCenterTitle">Add Administrator</h5>
							<span aria-hidden="true" data-dismiss="modal" class="modal-exit">&times;</span>
							</button>
						</div>
						<form id="addAdminForm" action="maint_administrators.php" method="POST" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" id="a_admin_id" name="a_admin_id">
							<input type="hidden" name="default_image_path" value="images/default_pfp.png">
							<div class="modal-body" style="padding-bottom: 0px;">
								<div class="row form-modal" style="padding-right: 20px;">
									<div class="col col-md-4 ml-auto add-admin-image-div">
										<div class="image-container">
											<img id="a_image" name="a_image" src="images/default_pfp.png" alt="Admin Profile" class="add-admin-image" style="cursor: pointer;" onclick="document.getElementById('a_image_input').click();">
											<input type="file" name="a_image_input" id="a_image_input" accept="image/*" onchange="loadAddImagePreview(this, 'a_image');" style="display: none;">
										</div>
									</div>
									<div class="col col-md-8 ml-auto">
										<div class="pop-up-prompt" id="add_admin_error"></div>
										<div class="row mb-3 ml-auto">
											<p class="pop-up-heading" style="padding-left: 0px;">Administrator Name:</p>
											<input type="text" class="form-control" required pattern="[a-zA-Z0-9\s]+" oninput="validateAddAdminInputPattern(this)" placeholder="Name" name="a_admin_name" id="a_admin_name">
										</div>
										<div class="row mb-3 ml-auto">
											<div class="col form-col mr-3">
												<p class="pop-up-heading">Username:</p>
												<input type="text" class="form-control" required pattern="[a-zA-Z0-9]+" oninput="validateAddAdminInputPattern(this)" title="Only letters and numbers are allowed" placeholder="Username" name="a_admin_username" id="a_admin_username">
											</div>
											<div class="col form-col">
												<p class="pop-up-heading">Password:</p>
												<input type="password" class="form-control" required pattern="[a-zA-Z0-9]+" oninput="validateAddAdminInputPattern(this)" placeholder="Password" name="a_admin_password" id="a_admin_password" required>
											</div>
										</div>
										<div class="row mb-8 ml-auto">
											<div class="col form-col mr-3"></div>
											<div class="col form-col mr-3">
												<div class="checkbox-container" style="margin-left: 5px;">
													<input type="checkbox" id="show-password-addAdmin" onchange="showPassword()" style="padding-top: 3px;">
													<label for="show-password-cb" style="font-size: 12px; padding-bottom: 15px; position: fixed; margin-left: 5px; margin-top: 2px;">Show Password</label>
												</div>
											</div>
										</div>
										<input type="hidden" id="addAdministratorInput" name="addAdministrator">
									</div>
									<div class="modal-footer popup-footer">
										<button type="button" class="btn btn-secondary action-cancel" data-dismiss="modal">Cancel</button>
										<button type="reset" class="btn btn-secondary action-cancel">Clear</button>
										<button type="submit" class="btn action-view" name="addAdministrator" onclick="addAdministratorValidate(event)">Add</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Add Administrator -->

			<!-- Edit Administrator -->
			<div class="modal fade" id="editAdministrator" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content popup">
						<div class="modal-header">
							<h5 class="modal-title popup-title" id="exampleModalCenterTitle">Edit Administrator</h5>
							<span aria-hidden="true" data-dismiss="modal" class="modal-exit">&times;</span>
							</button>
						</div>
						<form id="editAdminForm" action="maint_administrators.php" method="POST" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" id="e_admin_id" name="e_admin_id">
							<div class="modal-body" style="padding-bottom: 0px;">
								<div class="row form-modal" style="padding-right: 20px;">
									<div class="col col-md-4 ml-auto edit-admin-image-div">
										<div class="image-container">
											<img id="e_image" name="e_image" src="" alt="Admin Profile" class="edit-admin-image" style="cursor: pointer;" onclick="document.getElementById('e_image_input').click();">
											<input type="file" name="e_image_input" id="e_image_input" accept="image/*" onchange="loadEditImagePreview(this, 'e_image');" style="display: none;">
										</div>
									</div>
									<div class="col col-md-8 ml-auto">
										<div class="pop-up-prompt" id="update_admin_error"></div>
										<div class="row mb-3 ml-auto">
											<p class="pop-up-heading" style="padding-left: 0px;">Administrator Name:</p>
											<input type="text" class="form-control" required pattern="[a-zA-Z0-9\s]+" oninput="validateEditAdminInputPattern(this)" placeholder="Name" name="e_admin_name" id="e_admin_name">
										</div>
										<div class="row mb-3 ml-auto">
											<div class="col form-col mr-3">
												<p class="pop-up-heading">Username:</p>
												<input type="text" class="form-control" required pattern="[a-zA-Z0-9\s]+" oninput="validateEditAdminInputPattern(this)" placeholder="Username" name="e_admin_username" id="e_admin_username">
											</div>
											<div class="col form-col">
												<p class="pop-up-heading">Password:</p> 
												<input type="password" class="form-control" required pattern="[a-zA-Z0-9\s]+" oninput="validateEditAdminInputPattern(this)" placeholder="Password" name="e_admin_password" id="e_admin_password">
											</div>
										</div>
										<div class="row mb-8 ml-auto">
											<div class="col form-col mr-3"></div>
											<div class="col form-col mr-3">
												<div class="checkbox-container" style="margin-left: 5px;">
													<input type="checkbox" id="show-password-editAdmin" onchange="showPassword()" style="padding-top: 3px;">
													<label for="show-password-cb" style="font-size: 12px; padding-bottom: 15px; position: fixed; margin-left: 5px; margin-top: 2px;">Show Password</label>
												</div>
											</div>
										</div>
										<input type="hidden" id="editAdministratorInput" name="editAdministrator">
									</div>
									<div class="modal-footer popup-footer">
										<button type="button" class="btn btn-secondary action-cancel" data-dismiss="modal">Close</button>
										<button type="submit" class="btn action-view" name="editAdministrator" id="editAdminSubmit" onclick="editAdministratorValidate(event)">Save Changes</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Edit Administrator -->
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