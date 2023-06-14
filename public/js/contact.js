$('#frmSendContact').submit(function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    for (const [key, value] of formData) {
        if (value === "") {
            Swal.fire(
                'The Warning',
                'Please do not leave any fields blank',
                'warning'
            )
            return
        }
    }
    $.ajax({
        url: 'api/contacts',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 2000
            })
            $('#frmSendContact')[0].reset();
        },
        error: function (err) {
            console.error(err);
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: err.responseJSON.message,
                showConfirmButton: false,
                timer: 2000
            })
        }
    });
});

// Reply Contact
// Get input element
let inputReplyContact = document.getElementById('reply-contact');
// Get error message element
let errorReplyContact = document.getElementById('error-reply-contact');
// Get button element
let btnReplyContact = document.getElementById('btn-reply-contact');

// Add event listener
inputReplyContact.addEventListener('input', function (e) {
    var inputValue = inputUpdateBrandName.value;
    // Perform validation or error checking on the entered value
    if (inputValue === '') {
        RemoveDataBSDismissOfUpdateButton();
        errorReplyContact.textContent = 'Please do not leave this field blank';
    } else {
        errorReplyContact.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

function updateContact(id) {
    // Get input contact element
    let inputDisplayFullName = document.getElementById('display-full-name');
    let inputDisplayEmail = document.getElementById('display-email');
    let inputDisplaySubject = document.getElementById('display-subject');
    let inputDisplayMessage = document.getElementById('display-message');

    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    // GET A BRAND AJAX
    const path = '/api/contacts/' + id;
    $.ajax({
        url: path,
        type: 'GET',
        success: function (response) {
            $('.overlay').remove()
            inputDisplayFullName.value = response.contact.full_name;
            inputDisplayEmail.value = response.contact.email;
            inputDisplaySubject.value = response.contact.subject;
            inputDisplayMessage.value = response.contact.message;
            btnReplyContact.setAttribute('data-bs-dismiss', 'modal');
            btnReplyContact.setAttribute('onclick', 'updateContactSubmit(' + brandId + ')');
        },
        error: function (error) {
            $('.overlay').remove()
            console.error(error);
        }
    })
}

function AddDataBSDismissOfUpdateButton() {
    if (!btnReplyContact.hasAttribute('data-bs-dismiss')
        && errorReplyContact.textContent == ''
        && inputReplyContact.value != '') {
        btnReplyContact.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfUpdateButton() {
    if (btnReplyContact.hasAttribute('data-bs-dismiss')) {
        btnReplyContact.removeAttribute('data-bs-dismiss')
    }
}