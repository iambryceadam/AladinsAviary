
function showPassword() {
	var editAdminCB = document.getElementById("show-password-editAdmin");
    var editAdminPW = document.getElementById("e_admin_password");

    var addAdminCB = document.getElementById("show-password-addAdmin");
    var addAdminPW = document.getElementById("a_admin_password");

	if (addAdminCB.checked) {
		addAdminPW.type = "text";
    } else {
		addAdminPW.type = "password";
    }
    
    if (editAdminCB.checked) {
		editAdminPW.type = "text";
    } else {
		editAdminPW.type = "password";
    }


}

// Disable Form Resubmition
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}





// FETCH VIEW DATA
// Administrator
function viewAdmin(button) {
    var id = button.getAttribute('data-id');

    // Make an AJAX request to fetch the data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'processes/queries.php?fetch_admin_id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var adminData = JSON.parse(xhr.responseText);

            // Update the modal elements with the fetched data
			document.getElementById('v_admin_id').textContent = adminData.id;
			// If the current logged admin is a super admin
			if (adminData.currentAdmin_role == 0){
				document.getElementById('v_name').value = adminData.name;
				document.getElementById('v_username').value = adminData.username;
				document.getElementById('v_password').value = adminData.password;
			} 
			// If the current logged admin is a normal admin
			else {
				// If the selected admin is the logged admin
				if (id == adminData.currentAdmin_id){
					document.getElementById('v_name').value = adminData.name;
					document.getElementById('v_username').value = adminData.username;
					document.getElementById('v_password').value = adminData.password;
				} 
				// If the selected admin is not the logged admin
				else {
					document.getElementById('v_name').value = adminData.name;
					document.getElementById('v_username').value = '-';
					document.getElementById('v_password').value = '-';
				}
			}
            
            // Set the image source in the <img> element
            var imageData = adminData.imageData;
            var imageUrl = 'data:image/jpeg;base64,' + imageData;
            document.getElementById('v_image').setAttribute('src', imageUrl);
        }
    };
    xhr.send();
}

// Client
function viewClient(button) {
    var client_id = button.getAttribute('data-id');

    // Make an AJAX request to fetch the data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'processes/queries.php?fetch_client_id=' + client_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var clientData = JSON.parse(xhr.responseText);

            // Update the modal elements with the fetched data
			document.getElementById('v_client_id').textContent = clientData.client_id;
			document.getElementById('v_name').value = clientData.first_name + " " + clientData.last_name;
			document.getElementById('v_email').value = clientData.email;
			document.getElementById('v_client_contact').value = clientData.contact;

            
            //Set the image source in the <img> element
            var imageData = clientData.imageData;
            var imageUrl = 'data:image/jpeg;base64,' + imageData;
            document.getElementById('v_image').setAttribute('src', imageUrl);
        }
    };
    xhr.send();
}





// FETCH EDIT DATA
// Administrator
function editAdmin(button) {
    var id = button.getAttribute('data-id');

    // Make an AJAX request to fetch the data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'processes/queries.php?fetch_admin_id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var adminData = JSON.parse(xhr.responseText);
			
			document.getElementById('e_admin_id').value = adminData.id;
			document.getElementById('e_admin_name').value = adminData.name;
			document.getElementById('e_admin_username').value = adminData.username;
			document.getElementById('e_admin_password').value = adminData.password;
            
            // Set the image source in the <img> element
            var imageData = adminData.imageData;
            var imageUrl = 'data:image/jpeg;base64,' + imageData;
            document.getElementById('e_image').setAttribute('src', imageUrl);
        }
    };
    xhr.send();
}

// Dyanamically change add admin profile image based on selected image
function loadAddImagePreview(input, imageElementId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var imageElement = document.getElementById(imageElementId);
            if (imageElement) {
                imageElement.src = e.target.result;
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// Dyanamically change edit admin profile image based on selected image
function loadEditImagePreview(input, imageElementId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var imageElement = document.getElementById(imageElementId);
            if (imageElement) {
                imageElement.src = e.target.result;
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function confirmValidateBreedsFill(button){
	var id = button.getAttribute('data-id');
    // Make an AJAX request to fetch the data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'processes/queries.php?fetch_breeds_id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var speciesData = JSON.parse(xhr.responseText);
			document.getElementById('c_breed_id').value = speciesData.breed_id;
			document.getElementById('c_breed_description').value = speciesData.description;
        }
    };
    xhr.send();
}

// Species
function confirmValidateSpeciesFill(button){
	var id = button.getAttribute('data-id');
    // Make an AJAX request to fetch the data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'processes/queries.php?fetch_species_id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var speciesData = JSON.parse(xhr.responseText);
			document.getElementById('c_species_id').value = speciesData.species_id;
			document.getElementById('c_species_description').value = speciesData.description;
        }
    };
    xhr.send();
}

// VALIDATE TRANSFER TRANSACTIONS
// REQUEST APPROVAL

function validatePaymentAmountPattern(input){
	input.value = input.value.replace(/[^0-9\s]/g, '');
}

function costClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('client_name').value = cName;
	document.getElementById('client_id').value = cID;
	document.getElementById('transaction_id').value = tID;
}

function editCostDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('e_client_name').value = cName;
	document.getElementById('e_client_id').value = cID;
	document.getElementById('e_transaction_id').value = tID;
}

function refundClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('client_name').value = cName;
	document.getElementById('client_id').value = cID;
	document.getElementById('transaction_id').value = tID;
}

function insertInitialPaymentValidate(event) {
	var i_payment_cost = document.getElementById("i_payment_cost").value;
	var client_name = document.getElementById("client_name").value;
	var client_id = document.getElementById("client_id").value;
	var transaction_id = document.getElementById("transaction_id").value;

    if (i_payment_cost < 5000) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Payment cost cannot be less than P5,000',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Okay',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                //do nothing
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want<br>to approve request from ' + client_name + '?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("insertPaymentCost").submit();
            }
        });
    }
}

function editPaymentValidate(event) {
	var e_payment_cost = document.getElementById("e_payment_cost").value;
	var client_name = document.getElementById("e_client_name").value;
	var client_id = document.getElementById("e_client_id").value;
	var transaction_id = document.getElementById("e_transaction_id").value;

    if (e_payment_cost < 5000) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Payment cost cannot be less than P5,000',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Okay',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                //do nothing
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want<br>to approve request from ' + client_name + '?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("editPaymentCost").submit();
            }
        });
    }
}

function addInitialPaymentValidate(event) {
	var add_initial_cost = document.getElementById("add_initial_cost").value;
	var client_name = document.getElementById("client_name").value;
	var client_id = document.getElementById("client_id").value;
	var transaction_id = document.getElementById("transaction_id").value;

    if (add_initial_cost == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to add this amount to ' + client_name + '\s transaction cost?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("addInitalPaymentCost").submit();
            }
        });
    }
}

function addFinalPaymentValidate(event) {
	var add_final_cost = document.getElementById("add_final_cost").value;
	var client_name = document.getElementById("client_name").value;
	var client_id = document.getElementById("client_id").value;
	var transaction_id = document.getElementById("transaction_id").value;

    if (add_final_cost == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to add this amount to ' + client_name + '\s transaction cost?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("addFinalPaymentCost").submit();
            }
        });
    }
}

function insertRefundValidate(event) {
	var refund_cost = document.getElementById("refund_cost").value;
	var refundAtachments = document.getElementById("refundAtachments").files;

    if (refund_cost == "" || refundAtachments.length === 0) {
		event.preventDefault();
        Swal.fire({
			showCancelButton: false,
            icon: "warning",
            html: 'Refund cost and atachments cannot be empty',
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Okay',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            //do nothing
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Confirm refund?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("refundCostForm").submit();
            }
        });
    }
}

function cancelClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('cancel_client_name').value = cName;
	document.getElementById('cancel_client_id').value = cID;
	document.getElementById('cancel_transaction_id').value = tID;
}

function SPcancelClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('cr_client_name').value = cName;
	document.getElementById('cr_client_id').value = cID;
	document.getElementById('cr_transaction_id').value = tID;
}

function SPRcancelClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('c_client_name').value = cName;
	document.getElementById('c_client_id').value = cID;
	document.getElementById('c_transaction_id').value = tID;
}


function cancelTransactionValidate(event) {
	var rfcText = document.getElementById("rfctext").value;
	var client_name = document.getElementById("cancel_client_name").value;

    if (rfcText == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to cancel ' + client_name + '\'s animal transportation request?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("insertRFC").submit();
            }
        });
    }
}

function cancelTransactionValidateWReturn(event) {
	var rfcText = document.getElementById("rfctext").value;
	var client_name = document.getElementById("c_client_name").value;

    if (rfcText == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to cancel ' + client_name + '\'s animal transportation request?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("insertRFCwReturn").submit();
            }
        });
    }
}

function cancelTransactionValidateWRefund(event) {
	var rfcText = document.getElementById("rfctextwRefund").value;
	var client_name = document.getElementById("cr_client_name").value;

    if (rfcText == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to cancel ' + client_name + '\'s animal transportation request?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("insertRFCwRefund").submit();
            }
        });
    }
}

function viewClientRequest(button) {
    var id = button.getAttribute('data-transaction-id');
    console.log('Transaction ID:', id);

    // Make an AJAX request to fetch the data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'processes/transaction_viewing.php?transaction_id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Request was successful, parse and update the HTML
                var transactionData = JSON.parse(xhr.responseText);

                // Update the HTML elements with the retrieved data
                document.getElementById('tID_text').textContent = transactionData.transaction_id;
                document.getElementById('tDateFiled_text').textContent = transactionData.transaction_date_filed;
                document.getElementById('departure_date').textContent = transactionData.departure_date;
				document.getElementById('arrival_date').textContent = transactionData.arrival_date;

                // Sender Info
                document.getElementById('senderID_text').textContent = transactionData.sender_id;
                document.getElementById('senderName_text').textContent = transactionData.sender_first_name + " " + transactionData.sender_last_name;
                document.getElementById('senderContact_text').textContent = transactionData.sender_contact;
                document.getElementById('senderEmail_text').textContent = transactionData.sender_email;

                // Receiver Info
                document.getElementById('receiverID_text').textContent = transactionData.receiver_id;
                document.getElementById('receiverName_text').textContent = transactionData.receiver_first_name + " " + transactionData.receiver_last_name;
                document.getElementById('receiverContact_text').textContent = transactionData.receiver_contact;
                document.getElementById('receiverEmail_text').textContent = transactionData.receiver_email;
                //document.getElementById('receiverAddressID_text').textContent = transactionData.receiver_address_id;

                // Pickup Location Info
                document.getElementById('pickupLocationFormatted_text').textContent = transactionData.pickup_location_formatted;
				//document.getElementById('dropoffAddress').textContent = transactionData.dropoff_location_id ? 'Ninoy Aquino International Airport (MNL) Terminal 4 - Barangay 183 - Pasay, Pasay City' : 'Not Yet Decided';
				document.getElementById('dropoffAddress').textContent = transactionData.dropoff_location;
                // Payment Info
                document.getElementById('paymentType_text').textContent = transactionData.payment_type;
                document.getElementById('paymentMethod_text').textContent = transactionData.payment_method;
                document.getElementById('animal_pickup').textContent = transactionData.animal_pickup_cost;
                document.getElementById('mobilization_info').textContent = transactionData.mobilization_cost;
                document.getElementById('ltp_info').textContent = transactionData.ltp_cost;
                document.getElementById('vhc_info').textContent = transactionData.vhc_cost;
				document.getElementById('cage_info').textContent = transactionData.carrier_cage_cost;
				document.getElementById('professional_fee').textContent = transactionData.professional_fee;
				document.getElementById('grand_total').textContent = transactionData.grand_total;

                // Animal Info
				document.getElementById('animalImage').src = 'data:image/png;base64,' + transactionData.animal_image;
				document.getElementById('speciesName_text').textContent = transactionData.species_name;
				document.getElementById('breedName_text').textContent = transactionData.breed_name;
                document.getElementById('animalHeight_text').textContent = transactionData.animal_height;
                document.getElementById('animalWeight_text').textContent = transactionData.animal_weight;
                document.getElementById('animalAge_text').textContent = transactionData.animal_age;
                document.getElementById('animalSex_text').textContent = transactionData.animal_sex;
                document.getElementById('animalColor_text').textContent = transactionData.animal_color;
                document.getElementById('animalQuantity_text').textContent = transactionData.animal_quantity;
				document.getElementById('transactionStatus').textContent = getTransactionStatusText(transactionData.status);
				document.getElementById('other_transactions_attachments').innerHTML = '';
				var imagesHTML = '';

				transactionData.other_images.forEach(function (imageData, index) {
					var imgTag = '<img src="data:image/png;base64,' +
						imageData +
						'"alt="" onclick="openImageModal(this.src, ' + index + ')" id="initial-receipt-img" class="initial-receipt-img"></img>';
					
					imagesHTML += imgTag;
				});

				document.getElementById('other_transactions_attachments').innerHTML = imagesHTML;
				document.getElementById('dynamic-admin-payment-container').innerHTML = '';

				var cost_container = document.getElementById('dynamic-admin-cost-container');
				var cage_modif_display = document.getElementById('cage_modif_display');
				
				if (transactionData.payment_type == "Down Payment" && (transactionData.initial_payment_receipt === "" && transactionData.final_payment_receipt === "")) {
					document.getElementById('dynamic-admin-payment-container').innerHTML = '<div class="FADetails-data-label">' +
						'<p>Cost Details</p>' +
						'</div>' +
						'<div class="FADetails-data-details">' +
						'<p class="data-text" id="">Down Payment Cost</p>' +
						'<p class="data-text" id="initialPaymentCost_text">' + transactionData.initial_payment_cost + '</p>' +
						'</div>' +
						'<hr>' +
						'<div class="FADetails-data-details">' +
						'<p class="data-text" id="">Final Payment Cost</p>' +
						'<p class="data-text" id="finalPaymentCost_text">' + transactionData.final_payment_cost + '</p>' +
						'</div>' +
						'<hr>' +
						'<div class="FADetails-data-label">' +
						'<p>Payment Preview</p>' +
						'</div>' +
						'<div class="FADetails-data-attachments">' +
						'<p>No payments have been submitted by the user yet.</p>' +
						'</div>';
				} else if (transactionData.payment_type == "Down Payment" && (transactionData.initial_payment_receipt !== "" || transactionData.final_payment_receipt !== "")) {
					document.getElementById('dynamic-admin-payment-container').innerHTML =
					  '<div class="FADetails-data-label">' +
					  '<p>Cost Details</p>' +
					  '</div>' +
					  '<div class="FADetails-data-details">' +
					  '<p class="data-text" id="">Down Payment Cost</p>' +
					  '<p class="data-text" id="initialPaymentCost_text">' +
					  transactionData.initial_payment_cost +
					  '</p>' +
					  '</div>' +
					  '<hr>' +
					  '<div class="FADetails-data-details">' +
					  '<p class="data-text" id="">Final Payment Cost</p>' +
					  '<p class="data-text" id="finalPaymentCost_text">' +
					  transactionData.final_payment_cost +
					  '</p>' +
					  '</div>' +
					  '<hr>' +
					  '<div class="FADetails-data-label">' +
					  '<p>Payment Preview</p>' +
					  '</div>' +
					  '<div class="FADetails-data-attachments">' +
					  '<img src="data:image/png;base64,' +
						transactionData.initial_payment_receipt +
						'" id="initialPaymentReceipt" class="initial-receipt-admin-img" alt="" onclick="openImageModal(this.src)"></img>' +
						'<img src="data:image/png;base64,' +
						transactionData.final_payment_receipt +
						'" id="finalPaymentReceipt" class="initial-receipt-admin-img" alt="" onclick="openImageModal(this.src)"></img>' +
						'<img src="data:image/png;base64,' +
						transactionData.additional_initial_receipt +
						'" id="finalPaymentReceipt" class="initial-receipt-admin-img" alt="" onclick="openImageModal(this.src)"></img>' +
						'<img src="data:image/png;base64,' +
						transactionData.additional_final_receipt +
						'" id="finalPaymentReceipt" class="initial-receipt-admin-img" alt="" onclick="openImageModal(this.src)"></img>' +
					  '</div>';
				} else if (transactionData.payment_type == "Full Payment" && (transactionData.final_payment_receipt === "")) {
					document.getElementById('dynamic-admin-payment-container').innerHTML = '<div class="FADetails-data-label">' +
						'<p>Cost Details</p>' +
						'</div>' +
						'<div class="FADetails-data-details">' +
						'<p class="data-text" id="">Payment Cost</p>' +
						'<p class="data-text" id="finalPaymentCost_text">' + transactionData.final_payment_cost + '</p>' +
						'</div>' +
						'<hr>' +
						'<div class="FADetails-data-label">' +
						'<p>Payment Preview</p>' +
						'</div>' +
						'<div class="FADetails-data-attachments">' +
						'<p>No payments have been submitted by the user yet.</p>' +
						'</div>';
				} else if (transactionData.payment_type == "Full Payment" && (transactionData.final_payment_receipt !== "")) {
					document.getElementById('dynamic-admin-payment-container').innerHTML =
					  '<div class="FADetails-data-label">' +
					  '<p>Payment Status</p>' +
					  '</div>' +
					  '<div class="FADetails-data-details">' +
					  '<p class="data-text" id="">Payment Cost</p>' +
					  '<p class="data-text" id="finalPaymentCost_text">' +
					  transactionData.final_payment_cost +
					  '</p>' +
					  '</div>' +
					  '<hr>' +
					  '<div class="FADetails-data-label">' +
					  '<p>Payment Preview</p>' +
					  '</div>' +
					  '<div class="FADetails-data-attachments">' +
						'<img src="data:image/png;base64,' +
						transactionData.final_payment_receipt +
						'" id="finalPaymentReceipt" class="initial-receipt-admin-img" alt="" onclick="openImageModal(this.src)"></img>' +
						'<img src="data:image/png;base64,' +
						transactionData.additional_final_receipt +
						'" id="finalPaymentReceipt" class="initial-receipt-admin-img" alt="" onclick="openImageModal(this.src)"></img>' +
					  '</div>';
				}

				if(transactionData.status == 'for-approval'){
					cost_container.style.display = 'none';
				} else{
					cost_container.style.display = 'block';
				}

				if(transactionData.carrier_cage_cost == 0){
					cage_modif_display.style.display = 'none';
				} else{
					cage_modif_display.style.display = 'flex';
				}

            } else {
                // Handle errors here, for example:
                console.error('Error fetching transaction data. Status:', xhr.status);
            }
        }
    };
    xhr.send();
}

function openImageModal(base64Image) {
    var modal = document.getElementById('imageModalClient');
    var modalImage = document.getElementById('modalImage');

    modalImage.src = base64Image;
    modal.style.display = 'block';
}

function closeImageModal() {
    var modal = document.getElementById('imageModalClient');
    modal.style.display = 'none';
}

function getTransactionStatusText(status) {
		switch (status) {
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

function approveInitialPayment(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to approve ' + name + '\'s initial payment?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?approveInitialPayment=' + tID + '&cid=' + cID;
		}
	});
}

function approvePayment(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to approve ' + name + '\'s payment?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?approvePayment=' + tID + '&cid=' + cID;
		}
	});
}

function rejectInitialPayment(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>reject ' + name + '\'s initial?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?rejectInitialPayment=' + tID + '&cid=' + cID;
		}
	});
}

function rejectFinalPayment(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>reject ' + name + '\'s final payment?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?rejectFinalPayment=' + tID + '&cid=' + cID;
		}
	});
}

function rejectFullPayment(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>reject ' + name + '\'s final payment?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?rejectFullPayment=' + tID + '&cid=' + cID;
		}
	});
}


function initiatePickup(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>proceed with ' + name + '\'s pickup?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?initiatePickup=' + tID + '&cid=' + cID;
		}
	});
}


function reattemptPickup(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>re-attempt the pickup for ' + name + '\'s animal?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?reattemptPickup=' + tID + '&cid=' + cID;
		}
	});
}

function successPickup(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>confirm successful pickup for ' + name + '\'s animal?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?successPickup=' + tID + '&cid=' + cID;
		}
	});
}

function proceedForMedical(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>proceed with ' + name + '\'s animal to for medical?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?forMedical=' + tID  + '&cid=' + cID;
		}
	});
}

function medicalClientDetailswPrice(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('pmedical_cName').value = cName;
	document.getElementById('pmedical_cID').value = cID;
	document.getElementById('pmedical_tID').value = tID;
} 

function medicalClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('medical_cName').value = cName;
	document.getElementById('medical_cID').value = cID;
	document.getElementById('medical_tID').value = tID;
} 

function documentsClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('documents_cName').value = cName;
	document.getElementById('documents_cID').value = cID;
	document.getElementById('documents_tID').value = tID;
}

function uploadDocumentsAttachments(event){
	var documentAttachments = document.getElementById("documentAttachments").files;
	var client_name = document.getElementById("documents_cName").value;
	var transaction_id = document.getElementById("documents_tID").value;

    if (documentAttachments.length === 0) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Please add a document before proceeding to the next stage of the transaction',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Okay',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        })
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to complete the processing of document procedure for this transaction?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("documentAttachmentsForm").submit();
            }
        });
    }
}

function uploadMedicalAttachmentswPrice(event){
	var medicalAttachments = document.getElementById("pmedicalAttachments").files;
	var client_name = document.getElementById("pmedical_cName").value;
	var transaction_id = document.getElementById("pmedical_tID").value;

    if (medicalAttachments.length === 0) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Final price and medical attachments are required',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Okay',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                //do nothing
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to complete this medical procedure for ' + client_name + '\'s animal?<br>',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("medicalAttachmentsFormwPrice").submit();
            }
        });
    }
}

function uploadMedicalAttachments(event){
	var medicalAttachments = document.getElementById("medicalAttachments").files;
	var client_name = document.getElementById("medical_cName").value;
	var transaction_id = document.getElementById("medical_tID").value;

    if (medicalAttachments.length === 0) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Medical attachments are required',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Okay',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                //do nothing
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to complete this medical procedure for ' + client_name + '\'s animal?<br>',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("medicalAttachmentsForm").submit();
            }
        });
    }
}

function uploadAttachments(event){

    event.preventDefault();
    Swal.fire({
        icon: "warning",
        html: 'Are you sure you want to proceed to the next transaction status (For Medical)?',
        showCancelButton: true,
        confirmButtonColor: '#f7941d',
        cancelButtonColor: '#8D8D8D',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        width: '380px',
        customClass: {
            popup: 'swal-popup',
            confirmButton: 'swal-btn',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.getElementById("pickupAttachmentsForm").submit();
        }
    });
    
}


function proceedAfterMedical(name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>proceed with ' + name + '\'s transaction?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?proceedAfterMedical=' + tID;
		}
	});
}

function proceedFinalPay(event) {
	var f_payment_cost = document.getElementById("f_payment_cost").value;
	var client_name = document.getElementById("client_name").value;
	var client_id = document.getElementById("client_id").value;
	var transaction_id = document.getElementById("transaction_id").value;

    if (f_payment_cost == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to<br>proceed with ' + client_name + '\'s transaction?<br>(' +  client_id + ' ' + transaction_id + ')',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("insertFinalCostForm").submit();
            }
        });
    }
}

function approveFinalPayment(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to approve ' + name + '\'s payment?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?approveFinalPayment=' + tID + '&cid=' + cID;
		}
	});
}

function transportClientDetails(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('client_name').value = cName;
	document.getElementById('client_id').value = cID;
	document.getElementById('transaction_id').value = tID;
}

function returnLocation(event){
	var transportAttachments = document.getElementById("transportAttachments").files;
	var client_name = document.getElementById("client_name").value;
	var transaction_id = document.getElementById("transaction_id").value;
	var dropoff_location = document.getElementById("dropoff_location").value;

    if (dropoff_location == ""){
		Swal.fire({
            icon: "warning",
            html: 'Please add a dropoff address for ' + client_name + '\'s animal',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Ok',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        })
	} else if (transportAttachments.length === 0) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Confirm return details?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("returnLocationForm").submit();
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Confirm return details?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("returnLocationForm").submit();
            }
        });
    }
}

function transportClientDetails_down(button){
	var cName = button.getAttribute('data-clientname');
	var cID = button.getAttribute('data-client-id');
	var tID = button.getAttribute('data-transaction-id');
	document.getElementById('down_client_name').value = cName;
	document.getElementById('down_client_id').value = cID;
	document.getElementById('down_transaction_id').value = tID;
}

function uploadTransportAttachments(event){
	var transportAttachments = document.getElementById("transportAttachments").files;
	var client_name = document.getElementById("client_name").value;
	var transaction_id = document.getElementById("transaction_id").value;
	var dropoff_location = document.getElementById("dropoff_location").value;

    if (dropoff_location == ""){
		Swal.fire({
            icon: "warning",
            html: 'Please add a dropoff address for ' + client_name + '\'s animal',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Ok',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        })
	} else if (transportAttachments.length === 0) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to transport ' + client_name + '\'s animal without attachments?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("transportAttachmentsForm").submit();
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to transport ' + client_name + '\'s animal?<br>' + transaction_id,
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("transportAttachmentsForm").submit();
            }
        });
    }
}

function uploadBookingAttachments_down(event){
	var transportAttachments = document.getElementById("down_transportAttachments").files;
	var client_name = document.getElementById("down_client_name").value;
	var transaction_id = document.getElementById("down_transaction_id").value;
	var dropoff_location = document.getElementById("down_dropoff_location").value;

    if (dropoff_location == ""){
		Swal.fire({
            icon: "warning",
            html: 'Please add a dropoff address for ' + client_name + '\'s animal',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Ok',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        })
	} else if (transportAttachments.length === 0) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to transport ' + client_name + '\'s animal without attachments?<br>' + transaction_id,
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("addBookingAttachmentsDown").submit();
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to transport ' + client_name + '\'s animal?<br>' + transaction_id,
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("addBookingAttachmentsDown").submit();
            }
        });
    }
}

function uploadBookingAttachments(event){
	var transportAttachments = document.getElementById("transportAttachments").files;
	var client_name = document.getElementById("client_name").value;
	var transaction_id = document.getElementById("transaction_id").value;
	var dropoff_location = document.getElementById("dropoff_location").value;

    if (dropoff_location == ""){
		Swal.fire({
            icon: "warning",
            html: 'Please add a dropoff address for ' + client_name + '\'s animal',
            showCancelButton: false,
            confirmButtonColor: '#8D8D8D',
            confirmButtonText: 'Ok',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        })
	} else if (transportAttachments.length === 0) {
		event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to transport ' + client_name + '\'s animal without attachments?<br>' + transaction_id,
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("addBookingAttachments").submit();
            }
        });
	} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want to transport ' + client_name + '\'s animal?<br>' + transaction_id,
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("addBookingAttachments").submit();
            }
        });
    }
}

function transportCompleted(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure that ' + name + '\'s animal is ready for receiving?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?transportCompleted=' + tID + '&cid=' + cID;
		}
	});
}

function receiveByContact(name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Move transaction to receive by contact?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?receiveByContact=' + tID;
		}
	});
}

function animalReceived(name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure that ' + name + '\'s animal has been successfully received by the receiver?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?animalReceived=' + tID;
		}
	});
}

function approveCancel(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to cancel ' + name + '\'s animal transportation request?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?approveCancel=' + tID + '&cid=' + cID;
		}
	});
}

function finishReturn(name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to cancel ' + name + '\'s animal transportation request?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?finishReturn=' + tID;
		}
	});
}

function cancelToReturn(name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to cancel ' + name + '\'s animal transportation request?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?cancelToReturn=' + tID;
		}
	});
}

function proceedForReturn(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Proceed to for return?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?proceedForReturn=' + tID + '&cid=' + cID;
		}
	});
}

function unsuccessfulReturn (cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Return attempt unsuccessful?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?unsuccessfulReturn=' + tID + '&cid=' + cID;
		}
	});
}

function confirmReturn (cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Proceed to confirm return?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?confirmReturn=' + tID + '&cid=' + cID;
		}
	});
}

function rejectRequest(name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want to<br>cancel ' + name + '\'s request for animal transportation?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?rejectRequest=' + tID;
		}
	});
}

function pickupUnsuccessful(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Confirm ' + name + '\'s<br> unsuccessful animal pickup?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?unsuccessfulPickup=' + tID + '&cid=' + cID;
		}
	});
}

function rejectCancel(cID, name, tID){
	Swal.fire({
		icon: "warning",
		html: 'Reject ' + name + '\'s<br> request for cancellation?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?rejectCancel=' + tID + '&cid=' + cID;
		}
	});
}

// VALIDATE ADD FUNCTIONS
// Administrator
function validateAddAdminInputPattern(input){
	input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
}

function addAdministratorValidate(event) {
    var image = document.getElementById("a_image_input");
    var name = document.getElementById("a_admin_name").value;
    var username = document.getElementById("a_admin_username").value;
    var password = document.getElementById("a_admin_password").value;

	event.preventDefault();
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to add Admin - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
			popup: 'swal-popup',
			confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			var form = document.getElementById("addAdminForm").submit();
		}
	});
}





// VALIDATE EDIT FUNCTIONS
// Administrator
function validateEditAdminInputPattern(input){
	input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
}

function editAdministratorValidate(event) {
    var e_admin_name = document.getElementById("e_admin_name").value;
    var e_admin_username = document.getElementById("e_admin_username").value;
    var e_admin_password = document.getElementById("e_admin_password").value;

    if (e_admin_name == "" || e_admin_username == "" || e_admin_password == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want<br>to edit Admin - ' + e_admin_name + '?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("editAdminForm").submit();
            }
        });
    }
}

// Species
function confirmValidateSpecies(event) {
    var c_species_description = document.getElementById("c_species_description").value;

    if (c_species_description == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want<br>to save Species - ' + c_species_description + ' to records?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("validateSpeciesForm").submit();
            }
        });
    }
}

function confirmValidateBreed(event) {
    var c_breed_description = document.getElementById("c_breed_description").value;

    if (c_breed_description == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want<br>to save Breed - ' + c_breed_description + ' to records?',
            showCancelButton: true,
            confirmButtonColor: '#f7941d',
            cancelButtonColor: '#8D8D8D',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            width: '380px',
            customClass: {
                popup: 'swal-popup',
                confirmButton: 'swal-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById("validateBreedsForm").submit();
            }
        });
    }
}

// ARCHIVE FUNCTIONS
function archiveAdministrator(name, delID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to archive Admin - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?archiveAdmin=' + delID;
		}
	});
}

function archiveSpecies(name, delID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to archive Species - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?archiveSpecies=' + delID;
		}
	});
}

function archiveBreed(name, delID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to archive Breed - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?archiveBreed=' + delID;
		}
	});
}






// a FUNCTIONS
function deleteAdministrator(name, delID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to permanently delete Admin - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?deleteAdmin=' + delID;
		}
	});
}

function deleteAllArchivedAdministrators(){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to permanently delete all archived Administrator accounts?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?deleteAllArchivedAdmin=' + true;
		}
	});
}

function deleteBreed(name, delID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to permanently delete Breed - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?deleteBreed=' + delID;
		}
	});
}

function deleteSpecies(name, delID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to permanently delete Species - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?deleteSpecies=' + delID;
		}
	});
}




// RETRIEVE
// Retrieve Admin
function retrieveAdministrator(name, retrieveID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to retrieve Admin - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?retrieveAdmin=' + retrieveID;
		}
	});
}

function retrieveAllArchivedAdministrators(){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to retrieve all archived Administrator accounts?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?retrieveAllArchivedAdmin=' + true;
		}
	});
}

// Retrieve Breed
function retrieveBreed(name, retrieveID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to retrieve Breed - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?retrieveBreed=' + retrieveID;
		}
	});
}

// Retrieve Species
function retrieveSpecies(name, retrieveID){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to retrieve Species - ' + name + '?',
		showCancelButton: true,
		confirmButtonColor: '#f7941d',
		cancelButtonColor: '#8D8D8D',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		width: '380px',
		customClass: {
		  popup: 'swal-popup',
		  confirmButton: 'swal-btn',
		}
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href='processes/queries.php?retrieveSpecies=' + retrieveID;
		}
	});
}





// TABLE SEARCH
document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Client Table Search
	var searchInput = document.getElementById('table-search-clients');
	var table = document.getElementById('table-admin');
	var startDateInput = document.getElementById('start_date');
    var endDateInput = document.getElementById('end_date');
	var noMatchDisplay = document.getElementById('search_no_match');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	function filterRows() {
        var searchText = searchInput.value.toLowerCase();
        var startDate = startDateInput.value;
        var endDate = endDateInput.value;
        var noMatchFound = true;

        if (rows.length > 0) {
            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].textContent.toLowerCase();
                var dateFiled = rows[i].querySelector('td:nth-child(3)').textContent;

                if (rowData.includes(searchText) &&
                    (startDate === '' || dateFiled >= startDate) &&
                    (endDate === '' || dateFiled <= endDate)
                ) {
                    rows[i].style.display = '';
                    noMatchFound = false;
                } else {
                    rows[i].style.display = 'none';
                }
            }

            if (noMatchFound) {
                noMatchDisplay.style.display = 'block';
            } else {
                noMatchDisplay.style.display = 'none';
            }
        } else {
            noMatchDisplay.style.display = 'none';
        }
    }

    searchInput.addEventListener('input', filterRows);
    startDateInput.addEventListener('input', filterRows);
    endDateInput.addEventListener('input', filterRows);
});

document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('table-search-admin');
    var startDateInput = document.getElementById('start_date');
    var endDateInput = document.getElementById('end_date');
    var table = document.getElementById('table-admin');
    var noMatchDisplay = document.getElementById('search_no_match');
    var tbody = table.querySelector('tbody');
    var rows = tbody.getElementsByTagName('tr');

    function filterRows() {
        var searchText = searchInput.value.toLowerCase();
        var startDate = startDateInput.value;
        var endDate = endDateInput.value;
        var noMatchFound = true;

        if (rows.length > 0) {
            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].textContent.toLowerCase();
                var dateFiled = rows[i].querySelector('td:nth-child(9)').textContent;

                if (rowData.includes(searchText) &&
                    (startDate === '' || dateFiled >= startDate) &&
                    (endDate === '' || dateFiled <= endDate)
                ) {
                    rows[i].style.display = '';
                    noMatchFound = false;
                } else {
                    rows[i].style.display = 'none';
                }
            }

            if (noMatchFound) {
                noMatchDisplay.style.display = 'block';
            } else {
                noMatchDisplay.style.display = 'none';
            }
        } else {
            noMatchDisplay.style.display = 'none';
        }
    }

    searchInput.addEventListener('input', filterRows);
    startDateInput.addEventListener('input', filterRows);
    endDateInput.addEventListener('input', filterRows);
	
	document.getElementById('download-btn').addEventListener('click', function() {
		var table = document.getElementById('table-admin');
		var tbody = table.querySelector('tbody');
		var rows = tbody.getElementsByTagName('tr');
		var filteredData = [];
	
		// Extract the headers
		var headers = [];
		var headerRow = table.querySelector('thead tr');
		for (var i = 0; i < headerRow.cells.length; i++) {
			headers.push(headerRow.cells[i].textContent.trim());
		}
		filteredData.push(headers);
	
		// Iterate through the visible rows and extract the data
		for (var i = 0; i < rows.length; i++) {
			if (rows[i].style.display !== 'none') {
				var rowData = [];
				for (var j = 0; j < rows[i].cells.length; j++) {
					rowData.push(rows[i].cells[j].textContent.trim());
				}
				filteredData.push(rowData);
			}
		}
	
		// Create a worksheet with styling
		var ws = XLSX.utils.aoa_to_sheet(filteredData);
	
		// Add style for bold headers and centered text
		ws['!cols'] = headers.map(function() {
			return { wch: 15 }; // Set a fixed width for headers
		});
	
		ws['!rows'] = [{ hpx: 20, // Set row height for headers
			s: { // Style object
				font: { bold: true }, // Bold text
				alignment: { horizontal: 'center', vertical: 'center' } // Centered text
			}
		}];
	
		// Create a workbook and add the worksheet
		var wb = XLSX.utils.book_new();
		XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
	
		// Save the workbook as an Excel file
		XLSX.writeFile(wb, 'filtered_data.xlsx');
	});
});


////////////////////////////////////////////////////////////////////////////////////

document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Breeds Table Search (Validate)
	var searchInput = document.getElementById('table-search-validate-breeds');
	var table = document.getElementById('table-validate-breeds');
	var noMatchDisplay = document.getElementById('search_no_match_breeds_validate');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	searchInput.addEventListener('input', function() {
	  var searchText = this.value.toLowerCase();
	  var noMatchFound = true; // Flag to track if any matches were found
  
	  // Loop through table rows and hide/show based on search input
	  if (rows.length > 0) {
		for (var i = 0; i < rows.length; i++) {
		  var rowData = rows[i].textContent.toLowerCase();
  
		  if (rowData.includes(searchText)) {
			rows[i].style.display = '';
			noMatchFound = false; // A match was found
		  } else {
			rows[i].style.display = 'none';
		  }
		}
		// Update the visibility of the "search_no_match" element
		if (noMatchFound) {
		  noMatchDisplay.style.display = 'block'; // No matches found, display the message
		} else {
		  noMatchDisplay.style.display = 'none'; // Matches found, hide the message
		}
	  } else {
		noMatchDisplay.style.display = 'none';
	  }
	});
});

document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Breeds Table Search (Validated)
	var searchInput = document.getElementById('table-search-validated-breeds');
	var table = document.getElementById('table-validated-breeds');
	var noMatchDisplay = document.getElementById('search_no_match_breeds_validated');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	searchInput.addEventListener('input', function() {
	  var searchText = this.value.toLowerCase();
	  var noMatchFound = true; // Flag to track if any matches were found
  
	  // Loop through table rows and hide/show based on search input
	  if (rows.length > 0) {
		for (var i = 0; i < rows.length; i++) {
		  var rowData = rows[i].textContent.toLowerCase();
  
		  if (rowData.includes(searchText)) {
			rows[i].style.display = '';
			noMatchFound = false; // A match was found
		  } else {
			rows[i].style.display = 'none';
		  }
		}
		// Update the visibility of the "search_no_match" element
		if (noMatchFound) {
		  noMatchDisplay.style.display = 'block'; // No matches found, display the message
		} else {
		  noMatchDisplay.style.display = 'none'; // Matches found, hide the message
		}
	  } else {
		noMatchDisplay.style.display = 'none';
	  }
	});
});

document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Species Table Search (Validate)
	var searchInput = document.getElementById('table-search-validate-species');
	var table = document.getElementById('table-validate-species');
	var noMatchDisplay = document.getElementById('search_no_match_species_validate');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	searchInput.addEventListener('input', function() {
	  var searchText = this.value.toLowerCase();
	  var noMatchFound = true; // Flag to track if any matches were found
  
	  // Loop through table rows and hide/show based on search input
	  if (rows.length > 0) {
		for (var i = 0; i < rows.length; i++) {
		  var rowData = rows[i].textContent.toLowerCase();
  
		  if (rowData.includes(searchText)) {
			rows[i].style.display = '';
			noMatchFound = false; // A match was found
		  } else {
			rows[i].style.display = 'none';
		  }
		}
		// Update the visibility of the "search_no_match" element
		if (noMatchFound) {
		  noMatchDisplay.style.display = 'block'; // No matches found, display the message
		} else {
		  noMatchDisplay.style.display = 'none'; // Matches found, hide the message
		}
	  } else {
		noMatchDisplay.style.display = 'none';
	  }
	});
});

document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Species Table Search (Validated)
	var searchInput = document.getElementById('table-search-validated-species');
	var table = document.getElementById('table-validated-species');
	var noMatchDisplay = document.getElementById('search_no_match_species_validated');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	searchInput.addEventListener('input', function() {
	  var searchText = this.value.toLowerCase();
	  var noMatchFound = true; // Flag to track if any matches were found
  
	  // Loop through table rows and hide/show based on search input
	  if (rows.length > 0) {
		for (var i = 0; i < rows.length; i++) {
		  var rowData = rows[i].textContent.toLowerCase();
  
		  if (rowData.includes(searchText)) {
			rows[i].style.display = '';
			noMatchFound = false; // A match was found
		  } else {
			rows[i].style.display = 'none';
		  }
		}
		// Update the visibility of the "search_no_match" element
		if (noMatchFound) {
		  noMatchDisplay.style.display = 'block'; // No matches found, display the message
		} else {
		  noMatchDisplay.style.display = 'none'; // Matches found, hide the message
		}
	  } else {
		noMatchDisplay.style.display = 'none';
	  }
	});
});

document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Archived Administrators Table Search
	var searchInput = document.getElementById('table-search-archived-admin');
	var table = document.getElementById('table-archived-admin');
	var noMatchDisplay = document.getElementById('search_no_match');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	searchInput.addEventListener('input', function() {
	  var searchText = this.value.toLowerCase();
	  var noMatchFound = true; // Flag to track if any matches were found
  
	  // Loop through table rows and hide/show based on search input
	  if (rows.length > 0) {
		for (var i = 0; i < rows.length; i++) {
		  var rowData = rows[i].textContent.toLowerCase();
  
		  if (rowData.includes(searchText)) {
			rows[i].style.display = '';
			noMatchFound = false; // A match was found
		  } else {
			rows[i].style.display = 'none';
		  }
		}
		// Update the visibility of the "search_no_match" element
		if (noMatchFound) {
		  noMatchDisplay.style.display = 'block'; // No matches found, display the message
		} else {
		  noMatchDisplay.style.display = 'none'; // Matches found, hide the message
		}
	  } else {
		noMatchDisplay.style.display = 'none';
	  }
	});
});

document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Archived Breeds Table Search
	var searchInput = document.getElementById('table-search-archived-breeds');
	var table = document.getElementById('table-archived-breeds');
	var noMatchDisplay = document.getElementById('search_no_match');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	searchInput.addEventListener('input', function() {
	  var searchText = this.value.toLowerCase();
	  var noMatchFound = true; // Flag to track if any matches were found
  
	  // Loop through table rows and hide/show based on search input
	  if (rows.length > 0) {
		for (var i = 0; i < rows.length; i++) {
		  var rowData = rows[i].textContent.toLowerCase();
  
		  if (rowData.includes(searchText)) {
			rows[i].style.display = '';
			noMatchFound = false; // A match was found
		  } else {
			rows[i].style.display = 'none';
		  }
		}
		// Update the visibility of the "search_no_match" element
		if (noMatchFound) {
		  noMatchDisplay.style.display = 'block'; // No matches found, display the message
		} else {
		  noMatchDisplay.style.display = 'none'; // Matches found, hide the message
		}
	  } else {
		noMatchDisplay.style.display = 'none';
	  }
	});
});

document.addEventListener('DOMContentLoaded', function() {
	// Maintenance - Archived Species Table Search
	var searchInput = document.getElementById('table-search-archived-species');
	var table = document.getElementById('table-archived-species');
	var noMatchDisplay = document.getElementById('search_no_match');
	var tbody = table.querySelector('tbody'); // Get the tbody element
	var rows = tbody.getElementsByTagName('tr');
  
	searchInput.addEventListener('input', function() {
	  var searchText = this.value.toLowerCase();
	  var noMatchFound = true; // Flag to track if any matches were found
  
	  // Loop through table rows and hide/show based on search input
	  if (rows.length > 0) {
		for (var i = 0; i < rows.length; i++) {
		  var rowData = rows[i].textContent.toLowerCase();
  
		  if (rowData.includes(searchText)) {
			rows[i].style.display = '';
			noMatchFound = false; // A match was found
		  } else {
			rows[i].style.display = 'none';
		  }
		}
		// Update the visibility of the "search_no_match" element
		if (noMatchFound) {
		  noMatchDisplay.style.display = 'block'; // No matches found, display the message
		} else {
		  noMatchDisplay.style.display = 'none'; // Matches found, hide the message
		}
	  } else {
		noMatchDisplay.style.display = 'none';
	  }
	});
});





// SUCCESS POPUPS
window.onload = function() {
	const urlParams = new URLSearchParams(window.location.search);

	// Notifications Popups
	const mark_read_notif_success = urlParams.get('mark_read_notif_success');
	if (mark_read_notif_success) {
		Swal.fire({
		  text: mark_read_notif_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	}

	// Administrator Popups
	const add_admin_success = urlParams.get('add_admin_success');
	const update_admin_success = urlParams.get('update_admin_success');
	const archive_admin_success = urlParams.get('archive_admin_success');
	const delete_admin_success = urlParams.get('delete_admin_success');
	const delete_allArchivedAdmin_success = urlParams.get('delete_allArchivedAdmin_success');
	const retrieve_admin_success = urlParams.get('retrieve_admin_success');
	const retrieve_allArchivedAdmin_success = urlParams.get('retrieve_allArchivedAdmin_success');
	const initial_payment_approved_success = urlParams.get('initial_payment_approved_success');
	const transaction_approved_success = urlParams.get('transaction_approved_success');
	const payment_approved_success = urlParams.get('payment_approved_success');
	const moved_for_pickup_success = urlParams.get('moved_for_pickup_success');
	const pickup_successful = urlParams.get('pickup_successful');
	const proceed_for_medical = urlParams.get('proceed_for_medical');
	const ongoing_medical = urlParams.get('ongoing_medical');
	const complete_medical = urlParams.get('complete_medical');
	const for_transport_success = urlParams.get('for_transport_success');
	const set_final_pay_success = urlParams.get('set_final_pay_success');
	const for_receiving_success = urlParams.get('for_receiving_success');
	const completed_transaction_success = urlParams.get('completed_transaction_success');
	const cancelled_transaction_success = urlParams.get('cancelled_transaction_success');
	const pickup_unsuccessful = urlParams.get('pickup_unsuccessful');
	const complete_documents = urlParams.get('complete_documents');
	const booking_success = urlParams.get('booking_success');
	const full_payment_reject_success = urlParams.get('full_payment_reject_success');
	const reject_cancel = urlParams.get('reject_cancel');
	const to_return = urlParams.get('to_return');

	if(to_return){
		Swal.fire({
			text: to_return,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
		});
	}
	else if(reject_cancel){
		Swal.fire({
			text: reject_cancel,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
		});
	}
	else if(full_payment_reject_success){
		Swal.fire({
			text: full_payment_reject_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(booking_success){
		Swal.fire({
			text: booking_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(complete_documents){
		Swal.fire({
			text: complete_documents,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(pickup_unsuccessful){
		Swal.fire({
			text: pickup_unsuccessful,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(cancelled_transaction_success){
		Swal.fire({
			text: cancelled_transaction_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(completed_transaction_success){
		Swal.fire({
			text: completed_transaction_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(for_receiving_success){
		Swal.fire({
			text: for_receiving_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(set_final_pay_success){
		Swal.fire({
			text: set_final_pay_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(for_transport_success){
		Swal.fire({
			text: for_transport_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(complete_medical){
		Swal.fire({
			text: complete_medical,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	if(ongoing_medical){
		Swal.fire({
			text: ongoing_medical,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(proceed_for_medical){
		Swal.fire({
			text: proceed_for_medical,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(pickup_successful){
		Swal.fire({
			text: pickup_successful,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(moved_for_pickup_success){
		Swal.fire({
			text: moved_for_pickup_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(payment_approved_success){
		Swal.fire({
			text: payment_approved_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	}
	else if(transaction_approved_success){
		Swal.fire({
			text: transaction_approved_success,
			icon: 'success',
			showConfirmButton: false,
			timer: 2000,
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
		  }
	  });
	} else if(initial_payment_approved_success){
		Swal.fire({
		  text: initial_payment_approved_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		}
	});
	} else if (add_admin_success) {
		Swal.fire({
		  text: add_admin_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (update_admin_success) {
		Swal.fire({
		  text: update_admin_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (archive_admin_success) {
	  Swal.fire({
		text: archive_admin_success,
		icon: 'success',
		showConfirmButton: false,
		timer: 2000,
		customClass: {
			popup: 'swal-popup',
			confirmButton: 'swal-btn',
		}
	  });
	} else if (delete_admin_success) {
		Swal.fire({
		  text: delete_admin_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (delete_allArchivedAdmin_success) {
		Swal.fire({
		  text: delete_allArchivedAdmin_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (retrieve_admin_success) {
		Swal.fire({
		  text: retrieve_admin_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (retrieve_allArchivedAdmin_success) {
		Swal.fire({
		  text: retrieve_allArchivedAdmin_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	}

	// Breeds Popups
	const archive_breed_success = urlParams.get('archive_breed_success');
	const delete_breed_success = urlParams.get('delete_breed_success');
	const retrieve_breed_success = urlParams.get('retrieve_breed_success');

	if (archive_breed_success) {
		Swal.fire({
		  text: archive_breed_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (delete_breed_success) {
		Swal.fire({
		  text: delete_breed_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (retrieve_breed_success) {
		Swal.fire({
		  text: retrieve_breed_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	}

	// Species Popups
	const archive_species_success = urlParams.get('archive_species_success');
	const delete_species_success = urlParams.get('delete_species_success');
	const retrieve_species_success = urlParams.get('retrieve_species_success');

	if (archive_species_success) {
		Swal.fire({
		  text: archive_species_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (delete_species_success) {
		Swal.fire({
		  text: delete_species_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	} else if (retrieve_species_success) {
		Swal.fire({
		  text: retrieve_species_success,
		  icon: 'success',
		  showConfirmButton: false,
		  timer: 2000,
		  customClass: {
			  popup: 'swal-popup',
			  confirmButton: 'swal-btn',
		  }
		});
	}
};





// PROMPTS
// Maintenance - Administrators
// ADD
const urlParams = new URLSearchParams(window.location.search);
const add_admin_error = urlParams.get('add_admin_error');
const update_admin_error = urlParams.get('update_admin_error');

if (add_admin_error){
	$('#addAdministrator').modal('show');
	document.getElementById('add_admin_error').style.color = 'red';
 	document.getElementById('add_admin_error').innerHTML = add_admin_error;
}

if (update_admin_error){
	$('#editAdministrator').modal('show');
	document.getElementById('update_admin_error').style.color = 'red';
 	document.getElementById('update_admin_error').innerHTML = update_admin_error;

	const update_admin_error_id = urlParams.get('update_admin_error_id');

	// Make an AJAX request to fetch the data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'processes/queries.php?fetch_admin_id=' + update_admin_error_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var adminData = JSON.parse(xhr.responseText);
			
			document.getElementById('e_admin_id').value = adminData.id;
			document.getElementById('e_admin_name').value = adminData.name;
			document.getElementById('e_admin_username').value = adminData.username;
			document.getElementById('e_admin_password').value = adminData.password;
            
            // Set the image source in the <img> element
            var imageData = adminData.imageData;
            var imageUrl = 'data:image/jpeg;base64,' + imageData;
            document.getElementById('e_image').setAttribute('src', imageUrl);	
        }
    };
    xhr.send();
}

// function editAdmin(button) {
//     var id = button.getAttribute('data-id');

//     // Make an AJAX request to fetch the data
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', 'processes/queries.php?fetch_admin_id=' + id, true);
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             var adminData = JSON.parse(xhr.responseText);
			
// 			document.getElementById('e_admin_id').value = adminData.id;
// 			document.getElementById('e_admin_name').value = adminData.name;
// 			document.getElementById('e_admin_username').value = adminData.username;
// 			document.getElementById('e_admin_password').value = adminData.password;
            
//             // Set the image source in the <img> element
//             var imageData = adminData.imageData;
//             var imageUrl = 'data:image/jpeg;base64,' + imageData;
//             document.getElementById('e_image').setAttribute('src', imageUrl);
//         }
//     };
//     xhr.send();
// }

// UPDATE
// const update_admin_error = urlParams.get('update_admin_error');
// var admin_id = urlParams.get('admin_id');

// if (update_admin_error) {
//     document.getElementById('update_admin_error').style.color = 'red';
//     document.getElementById('update_admin_error').innerHTML = update_admin_error;
// }






// Website GUI Functions
// Sidebar Dropdown
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');

allDropdown.forEach(item=> {
	const a = item.parentElement.querySelector('a:first-child');
	a.addEventListener('click', function (e) {
		e.preventDefault();

		if(!this.classList.contains('active')) {
			allDropdown.forEach(i=> {
				const aLink = i.parentElement.querySelector('a:first-child');

				aLink.classList.remove('active');
				i.classList.remove('show');
			})
		}

		this.classList.toggle('active');
		item.classList.toggle('show');
	})
})

// Sidebar Collapse
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');

if(sidebar.classList.contains('hide')) {
	allSideDivider.forEach(item=> {
		item.textContent = '-'
	})
	allDropdown.forEach(item=> {
		const a = item.parentElement.querySelector('a:first-child');
		a.classList.remove('active');
		item.classList.remove('show');
	})
} else {
	allSideDivider.forEach(item=> {
		item.textContent = item.dataset.text;
	})
}

toggleSidebar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');

	if(sidebar.classList.contains('hide')) {
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})

		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
	} else {
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})

sidebar.addEventListener('mouseleave', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})
	}
})

sidebar.addEventListener('mouseenter', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})

// Profile Dropdown
const profile = document.querySelector('nav .profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.profile-link');

imgProfile.addEventListener('click', function () {
	dropdownProfile.classList.toggle('show');
})

// Menu
const allMenu = document.querySelectorAll('main .content-data .head .menu');

allMenu.forEach(item=> {
	const icon = item.querySelector('.icon');
	const menuLink = item.querySelector('.menu-link');

	icon.addEventListener('click', function () {
		menuLink.classList.toggle('show');
	})
})

window.addEventListener('click', function (e) {
	if(e.target !== imgProfile) {
		if(e.target !== dropdownProfile) {
			if(dropdownProfile.classList.contains('show')) {
				dropdownProfile.classList.remove('show');
			}
		}
	}

	allMenu.forEach(item=> {
		const icon = item.querySelector('.icon');
		const menuLink = item.querySelector('.menu-link');

		if(e.target !== icon) {
			if(e.target !== menuLink) {
				if (menuLink.classList.contains('show')) {
					menuLink.classList.remove('show')
				}
			}
		}
	})
})




// Notifications
const btn_all_notif = document.getElementById('btn-all-notif');
const btn_unread_notif = document.getElementById('btn-unread-notif');
const btn_mark_read_notif = document.getElementById('btn-mark-read-notif');
const elements = document.querySelectorAll('.notifications');

	// Toggle all notifications
	btn_all_notif.addEventListener('click', () => {
	elements.forEach(element => {
		element.style.display = 'block';
	});
	btn_all_notif.classList.add('active-notif-action');
	btn_unread_notif.classList.remove('active-notif-action');
	});

	// Toggle unread notifications
	btn_unread_notif.addEventListener('click', () => {
	elements.forEach(element => {
		if (element.classList.contains('unread')) {
			element.style.display = 'block';
		} else {
			element.style.display = 'none';
		}
	});
	btn_unread_notif.classList.add('active-notif-action');
	btn_all_notif.classList.remove('active-notif-action');
	});

	// Toggle mark all notifications as read modal
	btn_mark_read_notif.addEventListener('click', () => {
		Swal.fire({
			icon: "warning",
			html: 'Are you sure you want<br>to mark all notifications as read?',
			showCancelButton: true,
			confirmButtonColor: '#f7941d',
			cancelButtonColor: '#8D8D8D',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
			width: '380px',
			customClass: {
				popup: 'swal-popup',
				confirmButton: 'swal-btn',
			}
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href='processes/queries.php?markAllNotifAsRead=' + true;
			}
		});
	});






