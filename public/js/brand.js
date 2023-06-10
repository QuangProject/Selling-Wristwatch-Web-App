// ADD NEW BRAND
var format = /[!@#$%^&*()_+\=\[\]{};':"\\|<>\/?]+/;
var regex = /^[+]?([0-9]*\.)?[0-9]+([eE][-+]?[0-9]+)?$/;

// Get the input elements
inputAddBrandName = document.getElementById('add-brand-name');
inputAddCountryOfOrigin = document.getElementById('add-country-of-origin');
inputAddYearEstablished = document.getElementById('add-year-established');
inputAddBrandImage = document.getElementById('add-brand-image');

// Get the error message elements
errorAddBrandName = document.getElementById('errorAddBrandName');
errorAddCountryOfOrigin = document.getElementById('errorAddCountryOfOrigin');
errorAddYearEstablished = document.getElementById('errorAddYearEstablished');
errorAddBrandImage = document.getElementById('errorAddBrandImage');

// Get the button element
buttonAddBrand = document.getElementById('buttonAddBrand');

// Add event listeners for the input elements
inputAddBrandName.addEventListener('input', function () {
    var inputValue = inputAddBrandName.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddBrandName.textContent = 'Invalid brand\'s name, please enter again';
    } else {
        errorAddBrandName.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input elements
inputAddCountryOfOrigin.addEventListener('input', function () {
    var inputValue = inputAddCountryOfOrigin.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddCountryOfOrigin.textContent = 'Invalid country of origin, please enter again';
    } else {
        errorAddCountryOfOrigin.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input elements
inputAddYearEstablished.addEventListener('input', function () {
    var inputValue = inputAddYearEstablished.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue < 1500 || inputValue > 2021) {
        RemoveDataBSDismissOfAddButton();
        errorAddYearEstablished.textContent = 'Invalid year established, please enter again';
    } else {
        errorAddYearEstablished.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input elements
inputAddBrandImage.addEventListener('input', function () {
    var inputValue = inputAddBrandImage.value;
    // Perform validation or error checking on the entered value
    if (inputValue == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddBrandImage.textContent = 'Please choose brand\'s image';
    } else {
        errorAddBrandImage.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

buttonAddBrand.addEventListener('click', function () {
    if (inputAddBrandName.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddBrandName.textContent = 'Please enter brand\'s name';
        return;
    }
    if (inputAddCountryOfOrigin.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddCountryOfOrigin.textContent = 'Please enter country of origin';
        return;
    }
    if (inputAddYearEstablished.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddYearEstablished.textContent = 'Please enter year established';
        return;
    }
    if (inputAddBrandImage.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddBrandImage.textContent = 'Please choose brand\'s image';
        return;
    }
    if (errorAddBrandName.textContent != '' || errorAddCountryOfOrigin.textContent != '' || errorAddYearEstablished.textContent != '' || errorAddBrandImage.textContent != '') {
        RemoveDataBSDismissOfAddButton();
        return;
    }

    const formData = new FormData();
    formData.append('name', inputAddBrandName.value);
    formData.append('country_of_origin', inputAddCountryOfOrigin.value);
    formData.append('year_established', inputAddYearEstablished.value);
    formData.append('image', inputAddBrandImage.files[0]);

    // SEND DATA TO SERVER USING AJAX
    $.ajax({
        url: '/api/brands',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response)
            Swal.fire({
                'icon': 'success',
                'title': 'Add brand successfully',
                'showConfirmButton': false,
                'timer': 2000
            })

            const newBrand = document.createElement('tr');
            newBrand.setAttribute('id', 'brand_' + response.brand.id);
            newBrand.setAttribute('class', 'align-middle animate__animated animate__fadeInUp');
            newBrand.innerHTML = `
                <td>${response.brand.name}</td>
                <td>${response.brand.country_of_origin}</td>
                <td>${response.brand.year_established}</td>
                <td>
                    <img src="/api/brands/image/${response.brand.id}" alt="${response.brand.name}" width="100">
                </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateBrand(${response.brand.id})" data-bs-target="#updateBrandModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteBrand(${response.brand.id})">
                        Delete
                    </button>
                </td>
            `;
            const table = document.getElementById('brandList');
            const firstRow = table.getElementsByTagName('tr')[0]; // Get the first row of the table
            table.insertBefore(newBrand, firstRow);

            // clear input
            inputAddBrandName.value = '';
            inputAddCountryOfOrigin.value = '';
            inputAddYearEstablished.value = '';
            inputAddBrandImage.value = '';
            RemoveDataBSDismissOfAddButton();
        },
        error: function (error) {
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
    if (!buttonAddBrand.hasAttribute('data-bs-dismiss')
        && errorAddBrandName.textContent == '' && errorAddBrandImage.textContent == ''
        && inputAddBrandName.value != '' && inputAddBrandImage.value != '') {
        buttonAddBrand.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfAddButton() {
    if (buttonAddBrand.hasAttribute('data-bs-dismiss')) {
        buttonAddBrand.removeAttribute('data-bs-dismiss')
    }
}

// UPDATE BRAND
// Get the input elements
inputUpdateBrandName = document.getElementById('update-brand-name');
inputUpdateCountryOfOrigin = document.getElementById('update-country-of-origin');
inputUpdateYearEstablished = document.getElementById('update-year-established');
inputUpdateBrandImage = document.getElementById('update-brand-image');
displayImageUpdateBrand = document.getElementById('display-image-update-brand');

// Get the error message elements
errorUpdateBrandName = document.getElementById('errorUpdateBrandName');
errorUpdateCountryOfOrigin = document.getElementById('errorUpdateCountryOfOrigin');
errorUpdateYearEstablished = document.getElementById('errorUpdateYearEstablished');

// Get the button element
buttonUpdateBrand = document.getElementById('buttonUpdateBrand');

// Add event listeners for the input elements
inputUpdateBrandName.addEventListener('input', function () {
    var inputValue = inputUpdateBrandName.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateBrandName.textContent = 'Invalid brand\'s name, please enter again';
    } else {
        errorUpdateBrandName.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input elements
inputUpdateCountryOfOrigin.addEventListener('input', function () {
    var inputValue = inputUpdateCountryOfOrigin.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCountryOfOrigin.textContent = 'Invalid country of origin, please enter again';
    } else {
        errorUpdateCountryOfOrigin.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input elements
inputUpdateYearEstablished.addEventListener('input', function () {
    var inputValue = inputUpdateYearEstablished.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue < 1500 || inputValue > 2021) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateYearEstablished.textContent = 'Invalid year established, please enter again';
    } else {
        errorUpdateYearEstablished.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

function updateBrand(brandId) {
    // GET A BRAND AJAX
    const path = '/api/brands/' + brandId;
    $.ajax({
        url: path,
        type: 'GET',
        success: function (response) {
            inputUpdateBrandName.value = response.brand.name;
            inputUpdateCountryOfOrigin.value = response.brand.country_of_origin;
            inputUpdateYearEstablished.value = response.brand.year_established;
            displayImageUpdateBrand.src = '/api/brands/image/' + response.brand.id;
            displayImageUpdateBrand.alt = response.brand.name;
            buttonUpdateBrand.setAttribute('data-bs-dismiss', 'modal');
            buttonUpdateBrand.setAttribute('onclick', 'updateBrandSubmit(' + brandId + ')');
        },
        error: function (error) {
            console.error(error);
        }
    })
}

function updateBrandSubmit(id) {
    if (inputUpdateBrandName.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateBrandName.textContent = 'Please enter brand\'s name';
        return;
    }
    if (inputUpdateCountryOfOrigin.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCountryOfOrigin.textContent = 'Please enter country of origin';
        return;
    }
    if (inputUpdateYearEstablished.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateYearEstablished.textContent = 'Please enter year established';
        return;
    }
    if (errorUpdateBrandName.textContent != '' || errorUpdateCountryOfOrigin.textContent != '' || errorUpdateYearEstablished.textContent != '') {
        RemoveDataBSDismissOfUpdateButton();
        return;
    }

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('name', inputUpdateBrandName.value);
    formData.append('country_of_origin', inputUpdateCountryOfOrigin.value);
    formData.append('year_established', inputUpdateYearEstablished.value);
    if (inputUpdateBrandImage.files.length === 0) {
        formData.append('image', '');
    } else {
        formData.append('image', inputUpdateBrandImage.files[0]);
    }

    // SEND DATA TO SERVER USING AJAX
    const path = '/api/brands/' + id;
    $.ajax({
        url: path,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            Swal.fire({
                'icon': 'success',
                'title': 'Update brand successfully',
                'showConfirmButton': false,
                'timer': 2000
            })

            const brand = document.getElementById('brand_' + response.brand.id);
            brand.innerHTML = `
                <td>${response.brand.name}</td>
                <td>${response.brand.country_of_origin}</td>
                <td>${response.brand.year_established}</td>
                <td>
                    <img src="/api/brands/image/${response.brand.id}" alt="${response.brand.name}" width="100">
                </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateBrand(${response.brand.id})" data-bs-target="#updateBrandModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteBrand(${response.brand.id})">
                        Delete
                    </button>
                </td>
            `;

            // clear input
            inputUpdateBrandName.value = '';
            inputUpdateCountryOfOrigin.value = '';
            inputUpdateYearEstablished.value = '';
            inputUpdateBrandImage.value = '';
            RemoveDataBSDismissOfUpdateButton();
        },
        error: function (error) {
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

// DELETE BRAND
function deleteBrand(brandId) {
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
        'text': 'This brand will be deleted',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, delete it',
        'cancelButtonText': 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            // DELETE A BRAND AJAX
            const path = '/api/brands/' + brandId;
            $.ajax({
                url: path,
                type: 'DELETE',
                success: function (response) {
                    Swal.fire({
                        'icon': 'success',
                        'title': response.message,
                        'showConfirmButton': false,
                        'timer': 2000
                    })

                    var el = document.getElementById('brand_' + brandId)
                    $(el)
                        .closest('#brand_' + brandId)
                        .css('background', '#f27474')
                        .closest('#brand_' + brandId)
                        .fadeOut(800, function () {
                            $('#brand_' + brandId).remove()
                        })
                },
                error: function (error) {
                    console.error(error);
                    if (error.status === 400) {
                        Swal.fire(
                            'Warning',
                            error.responseJSON.error,
                            'warning'
                        )
                    }
                    if (error.status === 500) {
                        Swal.fire(
                            'Error',
                            error.responseJSON.error,
                            'error'
                        )
                    }
                }
            })
        }
    })
}

function AddDataBSDismissOfUpdateButton() {
    if (!buttonUpdateBrand.hasAttribute('data-bs-dismiss')
        && errorUpdateBrandName.textContent == ''
        && inputUpdateBrandName.value != '') {
        buttonUpdateBrand.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfUpdateButton() {
    if (buttonUpdateBrand.hasAttribute('data-bs-dismiss')) {
        buttonUpdateBrand.removeAttribute('data-bs-dismiss')
    }
}