<?php include 'processes/queries.php';?>
<?php include 'processes/session_validation.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="images/app_icon.png">
	<title>Dashboard</title>
</head>
<body>
	
	<!-- Side Bar -->
	<section id="sidebar">
		
		<ul class="side-menu">
			<!-- Main -->
			<li class="divider" data-text="main"></li>
			<li><a href="dashboard.php" class="active"><i class='bx bxs-dashboard icon' ></i>Dashboard</a></li>
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
				<!-- <img src="images/profile_icon.jpg" alt="Profile Icon"> -->
				<ul class="profile-link">
					<li><a href="processes/logout.php"><i class='bx bxs-exit'></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- Navigation Bar -->

		<!-- Main -->
		<main>
			<!-- Page Header -->
			<h1 class="title">Dashboard</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>Main</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>
			<!-- Breadcrumbs -->
			
			<!-- Analytics -->
			<div class="row row-analytics">
				<div class="col-md-3">
					<div class="card card-analytics">
						<div class="card-body card-body-analytics">
							<h6 class="card-title card-title-analytics">Transactions for Today</h6>
							<h3 class="card-title card-content-analytics"><i class='bx bx-receipt icon-analytics'></i> <?php echo $transactions_today; ?></h3>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-analytics">
						<div class="card-body card-body-analytics">
							<h6 class="card-title card-title-analytics">Transactions this Month</h6>
							<h3 class="card-title card-content-analytics"><i class='bx bx-calendar-alt icon-analytics' ></i></i> <?php echo $transactions_month; ?></h3>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-analytics">
						<div class="card-body card-body-analytics">
							<h6 class="card-title card-title-analytics">Completed Today</h6>
							<h3 class="card-title card-content-analytics"><i class='bx bx-box icon-analytics'></i><?php echo $completed_today ?></h3>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-analytics">
						<div class="card-body card-body-analytics">
							<h6 class="card-title table-card-title">Completed this Month</h6>
							<h3 class="card-title card-content-analytics"><i class='bx bx-calendar-check icon-analytics'></i></i><?php echo $completed_count_this_month; ?></h3>
						</div>
					</div>
				</div>
			</div>
			<!-- Analytics -->

			<!-- Brief Information -->
			<div class="row">
				<div class="col-md-4">
					<div class="card card-analytics">
						<div class="card-body card-body-analytics">
							<h4 class="card-title table-card-title">Recent Requests</h4>
							<p class="card-description table-card-description">
								<?php echo $get_allrequests_dashboard_count; ?> pending request(s) for approval this day.
							</p>
							<?php if ($get_allrequests_dashboard_count = 0) { ?>
								<p class="card-description table-card-description no-entry-description">
									There are currently no filed transactions.
								</p>
							<?php } ?>
							<?php while($get_requests_dashboard_result = mysqli_fetch_array($get_requests_dashboard)) { ?>
								<a href="requests.php">
									<div class="card card-dashboardRR">
										<div class="card-body card-body-dashboardRR d-flex align-items-center">
											<?php 
												$get_requests_client_id = $get_requests_dashboard_result['client_id'];
												$get_requests_client = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id='$get_requests_client_id'"); 
											?>
											<?php while($get_requests_client_result = mysqli_fetch_array($get_requests_client)) { ?>
												<div class="dashboard-image-container">
													<img class="recentReq-img" src="data:image/jpeg;base64,<?php echo base64_encode($get_requests_client_result['img_profile']); ?>" alt="Client Profile Image" style="border-radius: 100%;">
												</div>

												<div class="dashboard-title-desc">
													<h7 class="card-title notif-title"><?php echo $get_requests_client_result['first_name']; ?></h7>
													<p class="card-text notif-text"> has filed a request for transport.</p> 
												</div>
											<?php } ?>
										</div>
									</div>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-analytics">
						<div class="card-body card-body-analytics">
							<h4 class="card-title table-card-title">Recent Messages</h4>
							<p class="card-description table-card-description">
								There are <?php echo $get_messages_dashboard_count; ?> unread message(s) from clients.
							</p>
							<?php if ($get_messages_dashboard_count == 0) { ?>
								<p class="card-description table-card-description no-entry-description">
									There are currently no new messages.
								</p>
							<?php } ?>
							<?php while($get_messages_dashboard_result = mysqli_fetch_array($get_messages_dashboard)) { ?>
								<a href="messages.php">
									<div class="card card-dashboardRR">
										<div class="card-body card-body-dashboardRR d-flex align-items-center">

											<?php 
												$get_messages_client_id = $get_messages_dashboard_result['user_sender_id'];
												$get_messages_client = mysqli_query($conn, "SELECT * FROM tbl_clients WHERE client_id='$get_messages_client_id'"); 
											?>
											<?php while($get_messages_client_result = mysqli_fetch_array($get_messages_client)) { ?>
												<div class="dashboard-image-container">
													<img class="recentReq-img" src="data:image/jpeg;base64,<?php echo base64_encode($get_messages_client_result['img_profile']); ?>" alt="Client Profile Image" style="border-radius: 100%;">
												</div>
												
												<div class="dashboard-title-desc">
													<h7 class="card-title notif-title"><?php echo $get_messages_client_result['first_name']; ?></h7>
													<p class="card-text notif-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
														<?php echo $get_messages_dashboard_result['message']; ?>
													</p> 
												</div>
											<?php } ?>
										</div>
									</div>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-analytics">
						<div class="card-body card-body-analytics">
							<h4 class="card-title table-card-title">Recent Created Accounts</h4>
							<p class="card-description table-card-description">
								There are <?php echo $get_clients_dashboard_count; ?> newly created account(s) this day!
							</p>
							<?php if ($get_clients_dashboard_count == 0) { ?>
								<p class="card-description table-card-description no-entry-description">
									There are currently no new accounts.
								</p>
							<?php } ?>
							<?php while($get_clients_dashboard_result = mysqli_fetch_array($get_clients_dashboard)) { ?>
								<a href="maint_clients.php">
									<div class="card card-dashboardRR">
										<div class="card-body card-body-dashboardRR d-flex align-items-center">
											<div class="dashboard-image-container">
												<img class="recentReq-img" src="data:image/jpeg;base64,<?php echo base64_encode($get_clients_dashboard_result['img_profile']); ?>" alt="Client Profile Image" style="border-radius: 100%;">
											</div>
											<div class="dashboard-title-desc">
												<h7 class="card-title notif-title"><?php echo $get_clients_dashboard_result['first_name'].' '.$get_clients_dashboard_result['last_name']; ?></h7>
												<p class="card-text notif-text"><?php echo $get_clients_dashboard_result['email']; ?></p> 
											</div>
										</div>
									</div>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- Brief Information -->
			
		</main>
		<!-- Main -->
	</section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="js/script.js"></script>
</html>