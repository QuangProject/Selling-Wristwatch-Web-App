var format = /[!@#$%^&*()_+\=\[\]{};':"\\|<>\/?]+/;
var regex = /^[+]?([0-9]*\.)?[0-9]+([eE][-+]?[0-9]+)?$/;

// ADD NEW IMAGE
// Get the input elements
const inputAddImageName = document.getElementById("add-image-name");
const inputAddImageStock = document.getElementById("add-image-stock");
const inputAddImage = document.getElementById("add-image");

// Get error element
const errorAddImageName = document.getElementById("error-add-image-name");
const errorAddImageStock = document.getElementById("error-add-image-stock");
const errorAddImage = document.getElementById("error-add-image");

// Get btn element
const btnAddImage = document.getElementById("btn-add-image");

// Add event listeners for the input elements
inputAddImageName.addEventListener('input', function () {
    var inputValue = inputAddImageName.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddImageName.textContent = 'Please enter image name';
    } else {
        errorAddImageName.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input elements
inputAddImageStock.addEventListener('input', function () {
    var inputValue = inputAddImageStock.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddImageStock.textContent = 'Stock must be a number';
    } else {
        errorAddImageStock.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

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
    if (inputAddImageName.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddImageName.textContent = 'Please enter image name';
        return;
    }
    if (inputAddImageStock.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddImageStock.textContent = 'Please enter image stock';
        return;
    }
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
    formData.append('name', inputAddImageName.value);
    formData.append('stock', inputAddImageStock.value);
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
                <td>${response.image.name}</td>
                <td>${response.image.stock}</td>
                <td>
                    <img src="/watch/image/${response.image.id}" id="displayImage_${response.image.id}" alt="${response.image.name}" width="100">
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
            inputAddImageName.value = '';
            errorAddImageName.textContent = '';
            inputAddImageStock.value = '';
            errorAddImageStock.textContent = '';
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
        && errorAddImageName.textContent == '' && errorAddImageStock.textContent == '' && errorAddImage.textContent == ''
        && inputAddImageName.value != '' && inputAddImageStock.value != '' && inputAddImage.value != '') {
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
const inputUpdateImageName = document.getElementById("update-image-name");
const inputUpdateImageStock = document.getElementById("update-image-stock");
const inputUpdateImage = document.getElementById("update-image");

// Get error element
const errorUpdateImageName = document.getElementById("error-update-image-name");
const errorUpdateImageStock = document.getElementById("error-update-image-stock");
const errorUpdateImage = document.getElementById("error-update-image");

// Get btn element
const btnUpdateImage = document.getElementById("btn-update-image");

// Add event listeners for the input elements
inputUpdateImageName.addEventListener('input', function () {
    var inputValue = inputUpdateImageName.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateImageName.textContent = 'Please enter image name';
    } else {
        errorUpdateImageName.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input elements
inputUpdateImageStock.addEventListener('input', function () {
    var inputValue = inputUpdateImageStock.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateImageStock.textContent = 'Stock must be a number';
    } else {
        errorUpdateImageStock.textContent = ''; // Clear any previous error message
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
            inputUpdateImageName.value = response.image.name;
            inputUpdateImageStock.value = response.image.stock;
            displayImageUpdate.src = '/watch/image/' + response.image.id;
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
    // Perform validation or error checking on the entered value
    if (inputUpdateImageName.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateImageName.textContent = 'Please enter image name';
        return;
    }
    if (inputUpdateImageStock.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateImageStock.textContent = 'Please enter image stock';
        return;
    }
    if (errorAddImageName.textContent != '' || errorAddImageStock.textContent != '') {
        RemoveDataBSDismissOfUpdateButton();
        return;
    }

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('name', inputUpdateImageName.value);
    formData.append('stock', inputUpdateImageStock.value);
    if (inputUpdateImage.value != '') {
        formData.append('image', inputUpdateImage.files[0]);
    } else {
        formData.append('image', '');
    }

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
            fetch('/watch/image/' + response.image.id)
                .then(response => response.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    displayImageUpdate.src = url;
                })
                .catch(error => console.error(error));

            const image = document.getElementById('image_' + response.image.id);
            image.innerHTML = `
                <td>${response.image.name}</td>
                <td>${response.image.stock}</td>
                <td>
                    <img src="/watch/image/${response.image.id}" id="displayImage_${response.image.id}" alt="${response.image.name}" width="100">
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

            // Clear input
            inputUpdateImageName.value = '';
            errorUpdateImageName.textContent = '';
            inputUpdateImage.value = '';
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
        && errorUpdateImageName.textContent == '' && errorUpdateImageStock.textContent == ''
        && inputUpdateImageName.value != '' && inputUpdateImageStock.value != '') {
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