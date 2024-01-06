var autoScrollEnabled = true;
var previousChatHeight = 0;

function updateUsersList() {
    // Load user list
    $.ajax({
        url: 'processes/getUsers.php',
        method: 'GET',
        success: function (data) {
            $('#user-list').html(data);
        }
    });
}

// Initial call to update user list
updateUsersList();

// Set interval to update user list every 5 seconds (for example)
const updateInterval = 5000; // 5 seconds in milliseconds
setInterval(updateUsersList, updateInterval);

document.addEventListener("DOMContentLoaded", function () {
    var users = document.querySelectorAll('.user');

    users.forEach(function (user) {
        var indicator = user.querySelector('.message-indicator');

        if (indicator.classList.contains('unread-indicator')) {
            user.style.fontWeight = 'bold'; // Example: Make the user name bold
        }
    });
});

$(document).ready(function () {
    var chatUpdateInterval; // Variable to store the interval ID
    updateUsersList();

    $(document).on('click', '.chat-sent-images', function () {
        var fullSizeImageURL = $(this).data('fullsize');
    
        // Set the source of the modal image
        $('#modalImage').attr('src', fullSizeImageURL);
    
        // Show the modal
        $('#imageModal').css('display', 'block');
    });
    
      // Close the modal when the close button is clicked
      $('#imageModal .close-image-button').click(function () {
        $('#imageModal').css('display', 'none');
      });
    
      // Close the modal when clicking outside the modal content
      $(window).click(function (event) {
        if (event.target.id === 'imageModal') {
          $('#imageModal').css('display', 'none');
        }
      });

    function updateChatLog(userId, scrollToBottom) {
        // Load chat box
        $.ajax({
            url: 'processes/getMessages.php',
            method: 'GET',
            data: { user_id: userId },
            success: function (data) {
                var chatBox = $('#chat-box');
                chatBox.html(data);

                markReadMessages();
                updateUsersList();

                // Scroll to bottom only if explicitly requested
                if (scrollToBottom) {
                    scrollChatToBottom(chatBox);
                }
            }
        });
    }

    function markReadMessages() {
        // Ajax call to mark messages as read
        $.ajax({
            url: 'processes/mark_read_messages.php',
            method: 'POST',
            data: { receiver_id: $('#receiver-id-input').val() },
            success: function () {
                console.log('Messages marked as read');
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    }

    // User click event
    $(document).on('click', '.user', function (event) {
        event.preventDefault();
        var userId = $(this).data('user-id');
        $('#receiver-id-input').val(userId);
        loadChat(userId);
    });

    // Click event handler for user elements
    $(document).on('click', '.user', function (event) {
        event.preventDefault();
        var userId = $(this).data('user-id');
        $('#receiver-id-input').val(userId);
        $('.user').removeClass('active');

        $(this).addClass('active');
        $.ajax({
            url: 'processes/getCurrentUser.php',
            method: 'GET',
            data: { receiver_id: userId },
            success: function (data) {
                // Append the HTML content of the clicked user to the active-user div
                $('#active-user').html(data);
                console.log('Current User Appended to active-user');
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    });

    if ($('#receiver-id-input').val() === '') {
        $('#no-user-selected').show();
    } else {
        $('#no-user-selected').hide();
    }

    function loadChat(userId) {
        clearInterval(chatUpdateInterval); // Clear previous interval
        updateChatLog(userId, true); // Load chat initially

        // Create a MutationObserver to listen for changes in the chat box
        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                var chatBox = $('#chat-box');
                var currentHeight = chatBox.prop("scrollHeight");

                if (autoScrollEnabled && currentHeight !== previousChatHeight) {
                    scrollChatToBottom(chatBox);
                    previousChatHeight = currentHeight;
                }
            });
        });

        // Configure and start the observer
        var chatBox = document.getElementById('chat-box');
        var observerConfig = { childList: true, subtree: true };
        observer.observe(chatBox, observerConfig);

        // Update chat in real-time
        chatUpdateInterval = setInterval(function () {
            updateChatLog(userId, false);
        }, 2000);
    }

    $('#cancelImageButton').hide();

    // Add a click event for the "Cancel" button to clear the selected image
    $('#cancelImageButton').click(function () {
        $('#chatImage').val(''); // Clear the selected image from the file input
        $('#imagePreviewContainer').html(''); // Clear the image preview
        $('#imageData').val(''); // Clear the image data
        // Hide the "Cancel" button again
        $(this).hide();
    });

    $('#chatImage').change(function () {
        // Check if an image is selected
        if (this.files.length > 0) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Create an img element for the preview
                var imgPreview = $('<img>').attr('src', e.target.result).addClass('image-preview');

                // Append the image preview to a container
                $('#imagePreviewContainer').html(imgPreview);

                // Set the image data value
                $('#imageData').val(e.target.result);

                // Show the "Cancel" button
                $('#cancelImageButton').show();
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            // Clear the image preview and image data if no image is selected
            $('#imagePreviewContainer').html('');
            $('#imageData').val('');
            // Hide the "Cancel" button if no image is selected
            $('#cancelImageButton').hide();
        }
    });

    $('form').submit(function (event) {
        event.preventDefault();
        $('#cancelImageButton').hide();
        var message = $('#message').val();
        var receiverId = $('#receiver-id-input').val();
    
        // Check if an image is selected
        if ($('#chatImage')[0].files.length > 0) {
            var reader = new FileReader();
            reader.onload = function (e) {    
                sendMessage(message, receiverId);
            };
            reader.readAsDataURL($('#chatImage')[0].files[0]);
        } else {
            sendMessage(message, receiverId);
        }
    });

    function sendMessage(message, receiverId) {
        // Read the selected image file and convert it to base64
        var reader = new FileReader();
        var imageDataInput = $('#chatImage')[0].files[0];
    
        // Check if imageDataInput is a valid file
        if (imageDataInput instanceof Blob) {
            reader.onloadend = function () {
                // Check if reader.result is not null before performing the replacement
                var imgDataModded = reader.result ? reader.result.replace(/^data:image\/(jpeg|png|gif|jpg);base64,/, "") : "";
    
                // Log the modified imageData to the console
                console.log("Modified ImageData:", imgDataModded);
    
                $.ajax({
                    url: 'processes/send_message.php',
                    type: 'POST',
                    data: {
                        send: true,
                        receiver_id: receiverId,
                        message: message,
                        imageData: imgDataModded // Include imageData in the data
                    },
                    success: function () {
                        $('#message').val('');
                        $('#imageData').val(''); // Clear imageData after sending
                        $('#chatImage').val(''); // Clear imageData after sending
                        $('#imagePreviewContainer').html(''); // Clear the image preview
                        console.log('success');
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error:", status, error);
                    }
                });
            };
    
            reader.readAsDataURL(imageDataInput);
        } else {
            // Still execute the AJAX request without passing the image data
            $.ajax({
                url: 'processes/send_message.php',
                type: 'POST',
                data: {
                    send: true,
                    receiver_id: receiverId,
                    message: message
                },
                success: function () {
                    $('#message').val('');
                    $('#imageData').val(''); // Clear imageData after sending
                    $('#chatImage').val(''); // Clear imageData after sending
                    $('#imagePreviewContainer').html(''); // Clear the image preview
                    console.log('success');
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", status, error);
                }
            });
            console.error("Invalid file selected.");
        }
    }
    function scrollChatToBottom(chatBox) {
        chatBox.scrollTop(chatBox.prop("scrollHeight"));
    }
});

const searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    topCurrent = document.querySelector(".top-current"),
    searchListMain = document.querySelector(".search-list-main"),
    searchList = document.querySelector("#search-list");

searchIcon.onclick = () => {
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();
    if (searchBar.classList.contains("active")) {
        searchBar.value = "";
        searchBar.classList.remove("active");
    }

    userList.style.display = userList.style.display === 'none' ? 'block' : 'none';
    topCurrent.style.display = topCurrent.style.display === 'none' ? 'block' : 'none';
    // Toggle the display property of search-list-main
    searchListMain.style.display = searchListMain.style.display === 'block' ? 'none' : 'block';
}

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;
  if(searchTerm !== ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          usersList.innerHTML = data;
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

const userList = document.getElementById('user-list');

searchBar.addEventListener('input', function() {
    let searchTerm = searchBar.value.trim();

    if (searchTerm !== "") {
        searchBar.classList.add("active");

        // Use AJAX to send the search term to the server
        $.ajax({
            url: 'processes/search.php',
            type: 'POST',
            data: { searchTerm: searchTerm },
            success: function(data) {
                searchList.innerHTML = data; // Change userList to searchList
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    } else {
        searchBar.classList.remove("active");

        // If the search term is empty, reset the search list to its original state
        $.ajax({
            url: 'processes/getUsers.php',
            method: 'GET',
            success: function(data) {
                searchList.innerHTML = data; // Change userList to searchList
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    }
});