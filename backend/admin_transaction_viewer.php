
<?php $transaction_id = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : ""; ?>
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
	<title>Requests</title>
</head>
<body>
    <div id="imageModalClient" class="modal chat-image-modal-client">
        <div class="modal-image-client-container">
            <div>
                <span class="close-image-client-button" onclick="closeImageModal()"><i class='bx bxs-x-square'></i></span>
            </div>
            <img class="modal-content-chat" id="modalImage">
        </div>
    </div>
        <main>
            <div class="FADetails-admin-container">
                <div class="FADetails-sub-container">
                    <div class="FADetails-left-main">
                        <div class="FADetails-left-header">
                            <h2>Transaction Details</h2>
                            <p class="data-text">Displaying transaction details of client request.</p>
                        </div>

                        <div class="FADetails-data-details">
                            <p class="data-text">Transaction ID:</p>
                            <p class="data-text" id="tID_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Date of Filing:</p>
                            <p class="data-text" id="tDateFiled_text"></p>
                        </div>

                        <div class="FADetails-data-details">
                            <p class="data-text">Date of Departure:</p>
                            <p class="data-text" id="departure_date"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Date of Arrvial:</p>
                            <p class="data-text" id="arrival_date"></p>
                        </div>

                        <!-- Sender Details -->
                        <div class="FADetails-data-label">
                            <p>Sender Details</p>
                        </div>

                        <div class="FADetails-data-details">
                            <p class="data-text">Client ID:</p>
                            <p class="data-text" id="senderID_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Client Name:</p>
                            <p class="data-text" id="senderName_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Contact Number:</p>
                            <p class="data-text" id="senderContact_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Email:</p>
                            <p class="data-text" id="senderEmail_text"></p>
                        </div>

                        <!-- Receiver Details -->
                        <div class="FADetails-data-label">
                            <p>Receiver Details</p>
                        </div>

                        <div class="FADetails-data-details">
                            <p class="data-text">Receiver ID:</p>
                            <p class="data-text" id="receiverID_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Receiver Name:</p>
                            <p class="data-text" id="receiverName_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Contact Number:</p>
                            <p class="data-text" id="receiverContact_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Email:</p>
                            <p class="data-text" id="receiverEmail_text"></p>
                        </div>

                        <!-- Pickup & Dropoff Details -->
                        <div class="FADetails-data-label">
                            <p>Pickup & Dropoff Details</p>
                        </div>

                        <div class="FADetails-data-details">
                            <p class="data-text">Pickup Address:</p>
                            <p class="data-text address-text" id="pickupLocationFormatted_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Dropoff Address:</p>
                            <p class="data-text address-text" id="dropoffAddress">Not Yet Decided</p>
                        </div>

                        <!-- Payment Details -->
                        <div class="FADetails-data-label">
                            <p>Payment Details</p>
                        </div>

                        <div class="FADetails-data-details">
                            <p class="data-text">Payment Type:</p>
                            <p class="data-text" id="paymentType_text"></p>
                        </div>
                        <div class="FADetails-data-details">
                            <p class="data-text">Payment Method:</p>
                            <p class="data-text" id="paymentMethod_text"></p>
                        </div>
                        <div class="FADetails-data-label">
                            <p>Other Transaction Attachments</p>
                        </div>
                        <div class="FADetails-data-attachments" id="other_transactions_attachments">
                            
                        </div>
                        <br>
                    </div>

                    <div class="FADetails-right-main">
                        <h2>Animal Details</h2>
                        <div class="FADetails-animal-deets-main">
                            <div class="animal-image-container">
                                <img src="" id="animalImage" class="animal-image" alt="Cannot load image data">
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Animal Species:</p>
                                <p class="data-text" id="speciesName_text"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Animal Breed:</p>
                                <p class="data-text" id="breedName_text"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Animal's Height:</p>
                                <p class="data-text" id="animalHeight_text"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Animal's Weight:</p>
                                <p class="data-text" id="animalWeight_text"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Age:</p>
                                <p class="data-text" id="animalAge_text"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Sex:</p>
                                <p class="data-text" id="animalSex_text"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Quantity:</p>
                                <p class="data-text" id="animalQuantity_text"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text">Animal's Color:</p>
                                <p class="data-text" id="animalColor_text"></p>
                            </div>
                        </div>

                        <div class="FADetails-data-label">
                            <p>Transaction Status</p>
                        </div>

                        <div class="FADetails-data-details">
                            <p class="data-text" id="transactionStatus"></p>
                        </div>

                        <div class="dynamic-admin-cost-container" id="dynamic-admin-cost-container">
                            <div class="FADetails-data-label">
                                <p>Cost Breakdown</p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text" id="">Animal Pickup</p>
                                <p class="data-text" id="animal_pickup"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text" id="">Mobilization</p>
                                <p class="data-text" id="mobilization_info"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text" id="">Land Transportation Permit (LTP)</p>
                                <p class="data-text" id="ltp_info"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text" id="">Veterinary Health Certificate (VHC)</p>
                                <p class="data-text" id="vhc_info"></p>
                            </div>
                            <div class="FADetails-data-details" id="cage_modif_display">
                                <p class="data-text" id="">Carrier Cage</p>
                                <p class="data-text" id="cage_info"></p>
                            </div>
                            <div class="FADetails-data-details">
                                <p class="data-text" id="">Professional Fee</p>
                                <p class="data-text" id="professional_fee"></p>
                            </div>
                            <hr>
                            <div class="FADetails-data-details">
                                <p class="data-text" id="">Grand Total</p>
                                <p class="data-text" id="grand_total"></p>
                            </div>
                            <hr>
                        </div>
                        <div class="dynamic-admin-payment-container" id="dynamic-admin-payment-container"></div>
                    </div>
                </div>
            </div>
        </main>
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