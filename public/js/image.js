// ADD NEW IMAGE
// Get the input elements
const inputAddImage = document.getElementById("add-image");
// Get error element
const errorAddImage = document.getElementById("error-add-image");
// Get btn element
const btnAddImage = document.getElementById("btn-add-image");

// Add event listener
// Add event listeners for the input elements
inputAddImage.addEventListener('input', function () {
    var inputValue = inputAddImage.value;
    // Perform validation or error checking on the entered value
    if (inputValue == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddImage.textContent = 'Please choose image';
    } else {
        errorAddImage.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listener for the btn element
btnAddImage.addEventListener('click', function () {
    // Perform validation or error checking on the entered value
    if (inputAddImage.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddImage.textContent = 'Please choose image';
        return;
    }
    // Get id from url
    var url = window.location.href;

    // Extract the ID using regular expressions
    var regex = /\/watch\/(\d+)\/image/;
    var match = url.match(regex);
    var id = match[1];

    const formData = new FormData();
    formData.append('image', inputAddImage.files[0]);
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/images/watch/' + id,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('.overlay').remove()
            Swal.fire({
                'icon': 'success',
                'title': response.message,
                'showConfirmButton': false,
                'timer': 2000
            })

            const newImage = document.createElement('tr');
            newImage.setAttribute('id', 'image_' + response.image.id);
            newImage.setAttribute('class', 'align-middle animate__animated animate__fadeInUp');
            newImage.innerHTML = `
                <td>
                    <img src="/admin/watch/image/${response.image.id}" width="100">
                </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateImage(${response.image.id})" data-bs-target="#updateImageModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteImage(${response.image.id})">
                        Delete
                    </button>
                </td>
            `;
            const table = document.getElementById('imageList');
            const firstRow = table.getElementsByTagName('tr')[0]; // Get the first row of the table
            table.insertBefore(newImage, firstRow);

            // Clear input
            inputAddImage.value = '';
            errorAddImage.textContent = '';
            RemoveDataBSDismissOfAddButton();
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
});

function AddDataBSDismissOfAddButton() {
    if (!btnAddImage.hasAttribute('data-bs-dismiss')
        && errorAddImage.textContent == ''
        && inputAddImage.value != '') {
        btnAddImage.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfAddButton() {
    if (btnAddImage.hasAttribute('data-bs-dismiss')) {
        btnAddImage.removeAttribute('data-bs-dismiss')
    }
}

// UPDATE IMAGE
// Get the input elements
const inputUpdateImage = document.getElementById("update-image");
// Get error element
const errorUpdateImage = document.getElementById("error-update-image");
// Get btn element
const btnUpdateImage = document.getElementById("btn-update-image");

// Add event listeners for the input elements
inputUpdateImage.addEventListener('input', function () {
    var inputValue = inputUpdateImage.value;
    // Perform validation or error checking on the entered value
    if (inputValue == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateImage.textContent = 'Please choose image';
    } else {
        errorUpdateImage.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

function updateImage(id) {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    // GET A BRAND AJAX
    const path = '/api/images/' + id;
    $.ajax({
        url: path,
        type: 'GET',
        success: function (response) {
            $('.overlay').remove()
            const displayImageUpdate = document.getElementById('display-image-update');
            displayImageUpdate.src = '/admin/watch/image/' + response.image.id;
            btnUpdateImage.setAttribute('data-bs-dismiss', 'modal');
            btnUpdateImage.setAttribute('onclick', 'updateImageSubmit(' + id + ')');
            RemoveDataBSDismissOfUpdateButton();
        },
        error: function (error) {
            $('.overlay').remove()
            console.error(error);
        }
    })
}

function updateImageSubmit(id) {
    if (inputUpdateImage.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateImage.textContent = 'Please choose image';
        return;
    }

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('image', inputUpdateImage.files[0]);

    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/images/' + id,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('.overlay').remove()
            Swal.fire({
                'icon': 'success',
                'title': response.message,
                'showConfirmButton': false,
                'timer': 2000
            })

            const displayImageUpdate = document.getElementById('displayImage_' + response.image.id);
            fetch('/admin/watch/image/' + response.image.id)
                .then(response => response.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    displayImageUpdate.src = url;
                })
                .catch(error => console.error(error));

            // Clear input
            inputUpdateImage.value = '';
            errorUpdateImage.textContent = '';
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
    if (!btnUpdateImage.hasAttribute('data-bs-dismiss')
        && errorUpdateImage.textContent == ''
        && inputUpdateImage.value != '') {
        btnUpdateImage.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfUpdateButton() {
    if (btnUpdateImage.hasAttribute('data-bs-dismiss')) {
        btnUpdateImage.removeAttribute('data-bs-dismiss')
    }
}

// DELETE IMAGE
function deleteImage(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        'icon': 'question',
        'title': 'Are you sure?',
        'text': 'This image will be deleted',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, delete it',
        'cancelButtonText': 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
            // DELETE A BRAND AJAX
            const path = '/api/images/' + id;
            $.ajax({
                url: path,
                type: 'DELETE',
                success: function (response) {
                    $('.overlay').remove()
                    Swal.fire({
                        'icon': 'success',
                        'title': response.message,
                        'showConfirmButton': false,
                        'timer': 2000
                    })

                    var el = document.getElementById('image_' + id)
                    $(el)
                        .closest('#image_' + id)
                        .css('background', '#f27474')
                        .closest('#image_' + id)
                        .fadeOut(800, function () {
                            $('#image_' + id).remove()
                        })
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
    })
}