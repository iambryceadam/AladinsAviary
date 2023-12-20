
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
			document.getElementById('v_first_name').value = clientData.first_name;
			document.getElementById('v_last_name').value = clientData.last_name;
			document.getElementById('v_email').value = clientData.email;

            
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

function insertInitialPaymentValidate(event) {
	var i_payment_cost = document.getElementById("i_payment_cost").value;
	var client_name = document.getElementById("client_name").value;
	var client_id = document.getElementById("client_id").value;
	var transaction_id = document.getElementById("transaction_id").value;

    if (i_payment_cost == "") {} 
    else {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            html: 'Are you sure you want<br>to approve request from ' + client_name + '?<br>(' +  client_id + ' ' + transaction_id + ')',
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

/*
function approveTransportRequest(name){
	Swal.fire({
		icon: "warning",
		html: 'Are you sure you want<br>to approve request from ' + name + '?',
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
			window.location.href='processes/queries.php?archiveAdmin=' + true;
		}
	});
}
*/

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
	var table = document.getElementById('table-client');
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
	// Maintenance - Admin Table Search
	var searchInput = document.getElementById('table-search-admin');
	var table = document.getElementById('table-admin');
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

	if (add_admin_success) {
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






