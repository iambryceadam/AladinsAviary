<?php include 'processes/queries.php';?>
<?php include 'processes/session_validation.php';?>
<?php require_once 'processes/send_message.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="images/app_icon.png">
	<title>Messages</title>
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
							<a href="messages.php" class="active">
								<i class="bx bxs-message-square-dots icon" id="icon-notification" style="margin-right: -4px;"><span class="notification-badge"></span></i>
									Messages
							</a>
						';
					} else{
						echo '
						<a href="messages.php" class="active">
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
				<a href="#"><i class='bx bxs-collection icon' ></i> Transactions <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<h1 class="title">Messages</h1>
			<!-- Page Header -->

			<!-- Breadcrumbs -->
			<ul class="breadcrumbs">
				<li><p>Main</p></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Messages</a></li>
			</ul>
			<!-- Breadcrumbs -->
			<div id="imageModal" class="modal chat-image-modal">
				<div class="modal-image-container">
					<div>
						<span class="close-image-button"><i class='bx bxs-x-square'></i></span>
					</div>
					<img class="modal-content" id="modalImage">
				</div>
			</div>
			<div class="chat-container">
				<div class="list-main-container">
					<div class="search">
						<span class="text">Select a user to start chat</span>
						<input type="text" placeholder="Enter name to search...">
						<button><i class="fas fa-search"></i></button>
					</div>
					<div class="top-current">
						<p><strong>Current Chat</strong></p>
						<div class="active-user" id="active-user">
							<!-- Add this div with text at the desired location -->
							<div id="no-user-selected">
								<p>No chat selected yet</p>
							</div>
						</div>
						<hr>
					</div>
					<div class="search-list-main">
						<p><strong>Search User</strong></p>
						<div class="search-list" id="search-list"><p>Start typing to search a user</p></div>

						<hr>
					</div>
					<div id="user-list" class="user-list"></div>
				</div>
				<div class="right-chat-container">
					<div id="chat-box"></div>
					<form id="message-form" action="messages.php" method="post" enctype="multipart/form-data">
						<input type="text" class="user-input" name="message" id="message" placeholder="Message..."/>
						<div id="imagePreviewContainer"></div>
						<span id="cancelImageButton" class="cancel-image-button"><i class='bx bxs-x-circle'></i></span>
						<label for="chatImage" class="chatImage" style="cursor: pointer"><i class='bx bx2 bxs-image-add'></i></label>
						<input type="file" name="chatImage" id="chatImage" accept=".jpg, .jpeg, .png" style="display: none;" />
						<input type="hidden" name="imageData" id="imageData" value=""> <!-- Add this line -->
						<button type="submit" name="send" value="send" id="send">
							<i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i>
						</button>
						<input type="hidden" name="receiver_id" id="receiver-id-input" value="">
					</form>
					</div>
				</div>
			</div>
		</main>
		<!-- Notifications -->
		<!-- Main -->
	</section>
</body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<!-- External JavaScript -->
	<script src="js/chat.js"></script>
	<script src="js/script.js"></script>
	<!-- External JavaScript -->
	<!-- SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- SweetAlert -->
</html>