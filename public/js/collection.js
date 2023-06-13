// ADD NEW COLLECTION
var format = /[!@#$%^&*()_+\=\[\]{};':"\\|<>\/?]+/;
var regex = /^[+]?([0-9]*\.)?[0-9]+([eE][-+]?[0-9]+)?$/;

// Get the input elements
const inputAddCollectionName = document.getElementById('add-collection-name');
const inputAddReleaseDate = document.getElementById('add-release-date');
const inputAddBrandId = document.getElementById('add-brand-id');

// Get the error message elements
const errorAddCollectionName = document.getElementById('error-add-collection-name');
const errorAddReleaseDate = document.getElementById('error-add-release-date');
const errorAddBrandId = document.getElementById('error-add-brand-id');

// Get the button element
const btnAddCollection = document.getElementById('btn-add-collection');

// Display brand collection
$(document).ready(function () {
    $.ajax({
        url: '/api/brands',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const selectBrand = document.getElementById('add-brand-id');
            // Loop through each data and append to select element
            $.each(data.brands, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.name;
                selectBrand.appendChild(option);
            });

            const selectUpdateBrand = document.getElementById('update-brand-id');
            // Loop through each data and append to select element
            $.each(data.brands, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.name;
                selectUpdateBrand.appendChild(option);
            });

        },
        error: function (error) {
            console.log(error);
        }
    });
});

// Validate input collection name
inputAddCollectionName.addEventListener('input', function (event) {
    if (inputAddCollectionName.value === '') {
        RemoveDataBSDismissOfAddButton();
        errorAddCollectionName.textContent = 'Collection name is required';
    } else if (inputAddCollectionName.value.length < 3) {
        RemoveDataBSDismissOfAddButton();
        errorAddCollectionName.textContent = 'Collection name must be at least 3 characters';
    } else if (inputAddCollectionName.value.length > 50) {
        RemoveDataBSDismissOfAddButton();
        errorAddCollectionName.textContent = 'Collection name must be less than 50 characters';
    } else if (format.test(inputAddCollectionName.value)) {
        RemoveDataBSDismissOfAddButton();
        errorAddCollectionName.textContent = 'Collection name must not contain special characters';
    } else {
        errorAddCollectionName.textContent = '';
        AddDataBSDismissOfAddButton();
    }
});

// Validate input release date
inputAddReleaseDate.addEventListener('input', function (event) {
    if (inputAddReleaseDate.value === '') {
        RemoveDataBSDismissOfAddButton();
        errorAddReleaseDate.textContent = 'Release date is required';
    } else {
        errorAddReleaseDate.textContent = '';
        AddDataBSDismissOfAddButton();
    }
});

// Validate input brand id
inputAddBrandId.addEventListener('input', function (event) {
    if (inputAddBrandId.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddBrandId.textContent = 'Brand is required';
    } else {
        errorAddBrandId.textContent = '';
        AddDataBSDismissOfAddButton();
    }
});

// Click button add collection
btnAddCollection.addEventListener('click', function (event) {
    event.preventDefault();
    // Validate input collection name
    if (inputAddCollectionName.value === '') {
        RemoveDataBSDismissOfAddButton();
        errorAddCollectionName.textContent = 'Collection name is required';
        return;
    }
    // Validate input release date
    if (inputAddReleaseDate.value === '') {
        RemoveDataBSDismissOfAddButton();
        errorAddReleaseDate.textContent = 'Release date is required';
        return;
    }
    // Validate input brand id
    if (inputAddBrandId.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddBrandId.textContent = 'Brand is required';
        return;
    }
    // validate error message
    if (errorAddCollectionName.textContent != '' || errorAddReleaseDate.textContent != '' || errorAddBrandId.textContent != '') {
        RemoveDataBSDismissOfAddButton();
        return;
    }

    const formData = new FormData();
    formData.append('name', inputAddCollectionName.value);
    formData.append('release_date', inputAddReleaseDate.value);
    formData.append('brand_id', inputAddBrandId.value);

    $.ajax({
        url: '/api/collections',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response)
            Swal.fire({
                'icon': 'success',
                'title': response.message,
                'showConfirmButton': false,
                'timer': 2000
            })

            const newCollection = document.createElement('tr');
            newCollection.setAttribute('id', 'collection_' + response.collection.id);
            newCollection.setAttribute('class', 'align-middle animate__animated animate__fadeInUp');
            newCollection.innerHTML = `
                <td>${response.collection.name}</td>
                <td>${response.collection.release_date}</td>
                <td>${response.collection.brand_name}</td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateCollection(${response.collection.id})" data-bs-target="#updateCollectionModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteCollection(${response.collection.id})">
                        Delete
                    </button>
                </td>
            `;
            const table = document.getElementById('collectionList');
            const firstRow = table.getElementsByTagName('tr')[0]; // Get the first row of the table
            table.insertBefore(newCollection, firstRow);

            // Clear input
            inputAddCollectionName.value = '';
            inputAddReleaseDate.value = '';
            inputAddBrandId.value = 0;
            RemoveDataBSDismissOfAddButton();
        },
        error: function (error) {
            console.error(error);
            if (error.status >= 500) {
                Swal.fire(
                    'Error',
                    error.responseJSON.message,
                    'error'
                )
            }
            if (error.status >= 400) {
                Swal.fire(
                    'Warning',
                    error.responseJSON.message,
                    'warning'
                )
            }

        }
    });
});

// Remove data-bs-dismiss attribute of add button
function AddDataBSDismissOfAddButton() {
    if (!btnAddCollection.hasAttribute('data-bs-dismiss')
        && errorAddCollectionName.textContent == '' && errorAddReleaseDate.textContent == '' && errorAddBrandId.textContent == ''
        && inputAddCollectionName.value != '' && inputAddReleaseDate.value != '' && inputAddBrandId.value != 0) {
        btnAddCollection.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfAddButton() {
    if (btnAddCollection.hasAttribute('data-bs-dismiss')) {
        btnAddCollection.removeAttribute('data-bs-dismiss')
    }
}

// UPDATE COLLECTION
// Get the input elements
const inputUpdateCollectionName = document.getElementById('update-collection-name');
const inputUpdateReleaseDate = document.getElementById('update-release-date');
const inputUpdateBrandId = document.getElementById('update-brand-id');

// Get the error message elements
const errorUpdateCollectionName = document.getElementById('error-update-collection-name');
const errorUpdateReleaseDate = document.getElementById('error-update-release-date');
const errorUpdateBrandId = document.getElementById('error-update-brand-id');

// Get the button element
const btnUpdateCollection = document.getElementById('btn-update-collection');

// Validate input collection name
inputUpdateCollectionName.addEventListener('input', function (event) {
    if (inputUpdateCollectionName.value === '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCollectionName.textContent = 'Collection name is required';
    } else if (inputUpdateCollectionName.value.length < 3) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCollectionName.textContent = 'Collection name must be at least 3 characters';
    } else if (inputUpdateCollectionName.value.length > 50) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCollectionName.textContent = 'Collection name must be less than 50 characters';
    } else if (format.test(inputUpdateCollectionName.value)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCollectionName.textContent = 'Collection name must not contain special characters';
    } else {
        errorUpdateCollectionName.textContent = '';
        AddDataBSDismissOfUpdateButton();
    }
});

// Validate input release date
inputUpdateReleaseDate.addEventListener('input', function (event) {
    if (inputUpdateReleaseDate.value === '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateReleaseDate.textContent = 'Release date is required';
    } else {
        errorUpdateReleaseDate.textContent = '';
        AddDataBSDismissOfUpdateButton();
    }
});

// Validate input brand id
inputUpdateBrandId.addEventListener('input', function (event) {
    if (inputUpdateBrandId.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateBrandId.textContent = 'Brand is required';
    } else {
        errorUpdateBrandId.textContent = '';
        AddDataBSDismissOfUpdateButton();
    }
});

// Fill data to update modal
function updateCollection(id) {
    $.ajax({
        url: '/api/collections/' + id,
        type: 'GET',
        success: function (response) {
            inputUpdateCollectionName.value = response.collection.name;
            inputUpdateReleaseDate.value = response.collection.release_date;
            inputUpdateBrandId.value = response.collection.brand_id;
            btnUpdateCollection.setAttribute('data-bs-dismiss', 'modal');
            btnUpdateCollection.setAttribute('onclick', 'updateCollectionSubmit(' + response.collection.id + ')');
        },
        error: function (error) {
            console.error(error);
        }
    });
}

function updateCollectionSubmit(id) {
    // Validate input collection name
    if (inputUpdateCollectionName.value === '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCollectionName.textContent = 'Collection name is required';
        return;
    }
    // Validate input release date
    if (inputUpdateReleaseDate.value === '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateReleaseDate.textContent = 'Release date is required';
        return;
    }
    // Validate input brand id
    if (inputUpdateBrandId.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateBrandId.textContent = 'Brand is required';
        return;
    }
    // validate error message
    if (errorUpdateCollectionName.textContent != '' || errorUpdateReleaseDate.textContent != '' || errorUpdateBrandId.textContent != '') {
        RemoveDataBSDismissOfUpdateButton();
        return;
    }

    const data = {
        'name': inputUpdateCollectionName.value,
        'release_date': inputUpdateReleaseDate.value,
        'brand_id': inputUpdateBrandId.value
    };

    $.ajax({
        url: '/api/collections/' + id,
        type: 'PUT',
        data: data,
        success: function (response) {
            console.log(response)
            Swal.fire({
                'icon': 'success',
                'title': response.message,
                'showConfirmButton': false,
                'timer': 2000
            })

            const collection = document.getElementById('collection_' + response.collection.id);
            collection.innerHTML = `
                <td>${response.collection.name}</td>
                <td>${response.collection.release_date}</td>
                <td>${response.collection.brand_name}</td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateCollection(${response.collection.id})" data-bs-target="#updateCollectionModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteCollection(${response.collection.id})">
                        Delete
                    </button>
                </td>
            `;

            // Clear input
            inputUpdateCollectionName.value = '';
            inputUpdateReleaseDate.value = '';
            inputUpdateBrandId.value = 0;
            RemoveDataBSDismissOfUpdateButton();
        },
        error: function (error) {
            console.error(error);
            if (error.status >= 500) {
                Swal.fire(
                    'Error',
                    error.responseJSON.message,
                    'error'
                )
            }
            if (error.status >= 400) {
                Swal.fire(
                    'Warning',
                    error.responseJSON.message,
                    'warning'
                )
            }
        }
    });
}

// Remove data-bs-dismiss attribute of add button
function AddDataBSDismissOfUpdateButton() {
    if (!btnUpdateCollection.hasAttribute('data-bs-dismiss')
        && errorUpdateCollectionName.textContent == '' && errorUpdateReleaseDate.textContent == '' && errorUpdateBrandId.textContent == ''
        && inputUpdateCollectionName.value != '' && inputUpdateReleaseDate.value != '' && inputUpdateBrandId.value != 0) {
        btnUpdateCollection.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfUpdateButton() {
    if (btnUpdateCollection.hasAttribute('data-bs-dismiss')) {
        btnUpdateCollection.removeAttribute('data-bs-dismiss')
    }
}

// DELETE COLLECTION
function deleteCollection(id) {
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
        'text': 'This collection will be deleted',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, delete it',
        'cancelButtonText': 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            // DELETE A BRAND AJAX
            const path = '/api/collections/' + id;
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

                    var el = document.getElementById('collection_' + id)
                    $(el)
                        .closest('#collection_' + id)
                        .css('background', '#f27474')
                        .closest('#collection_' + id)
                        .fadeOut(800, function () {
                            $('#collection_' + id).remove()
                        })
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
    })
}