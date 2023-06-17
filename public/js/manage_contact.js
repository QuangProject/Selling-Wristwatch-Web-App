// Reply Contact
// Get input element
let inputDisplayFullName = document.getElementById('display-full-name');
let inputDisplayEmail = document.getElementById('display-email');
let inputDisplaySubject = document.getElementById('display-subject');
let inputDisplayMessage = document.getElementById('display-message');
let inputReplyContact = document.getElementById('reply-contact');
// Get error message element
let errorReplyContact = document.getElementById('error-reply-contact');
// Get button element
let btnReplyContact = document.getElementById('btn-reply-contact');

// Add event listener
inputReplyContact.addEventListener('input', function (e) {
    var inputValue = inputReplyContact.value;
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
            inputReplyContact.value = response.contact.reply;
            btnReplyContact.setAttribute('data-bs-dismiss', 'modal');
            btnReplyContact.setAttribute('onclick', 'updateContactSubmit(' + id + ')');
            RemoveDataBSDismissOfUpdateButton();
        },
        error: function (error) {
            $('.overlay').remove()
            console.error(error);
        }
    })
}

function updateContactSubmit(id) {
    if (inputReplyContact.value === '') {
        RemoveDataBSDismissOfUpdateButton();
        errorReplyContact.textContent = 'Please do not leave this field blank';
        return;
    }
    const path = '/api/contacts/' + id;
    const data = {
        full_name: inputDisplayFullName.value,
        email: inputDisplayEmail.value,
        subject: inputDisplaySubject.value,
        message: inputDisplayMessage.value,
        reply: inputReplyContact.value,
    }
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: path,
        type: 'PUT',
        data: data,
        success: function (response) {
            const contact = document.getElementById('contact_' + response.contact.id);
            contact.innerHTML = `
                <td>${response.contact.full_name}</td>
                <td>${response.contact.email}</td>
                <td>${response.contact.subject}</td>
                <td>${response.contact.message}</td>
                <td class="fw-bold text-success">Replied</td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateContact(${response.contact.id})" data-bs-target="#updateContactModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteContact(${response.contact.id})">
                        Delete
                    </button>
                </td>
            `;
            // Send email
            const sendMailData = {
                full_name: response.contact.full_name,
                email: response.contact.email,
                subject: response.contact.subject,
                reply: response.contact.reply,
            }
            $.ajax({
                url: '/api/reply-contact',
                type: 'POST',
                data: sendMailData,
                success: function (response) {
                    $('.overlay').remove()
                    Swal.fire({
                        'icon': 'success',
                        'title': response.message,
                        'showConfirmButton': false,
                        'timer': 2000
                    })
                },
                error: function (error) {
                    $('.overlay').remove()
                    console.error(error);
                }
            })

            // clear input
            inputDisplayFullName.value = '';
            inputDisplayEmail.value = '';
            inputDisplaySubject.value = '';
            inputDisplayMessage.value = '';
            inputReplyContact.value = '';
            RemoveDataBSDismissOfUpdateButton();
        },
        error: function (error) {
            $('.overlay').remove()
            console.error(error);
            if (error.status === 400) {
                Swal.fire(
                    'Warning',
                    error.responseJSON.message,
                    'warning'
                )
            }
            if (error.status === 500) {
                Swal.fire(
                    'Error',
                    error.responseJSON.message,
                    'error'
                )
            }
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