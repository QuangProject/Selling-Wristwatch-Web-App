// ADD NEW CATEGORY
var format = /[!@#$%^&*()_+\=\[\]{};':"\\|<>\/?]+/;
var regex = /^[+]?([0-9]*\.)?[0-9]+([eE][-+]?[0-9]+)?$/;

// Get the input elements
inputAddCategoryName = document.getElementById('add-category-name');

// Get the error message elements
errorAddCategoryName = document.getElementById('errorAddCategoryName');

// Get the button element
buttonAddCategory = document.getElementById('buttonAddCategory');

// Add event listeners for the input elements
inputAddCategoryName.addEventListener('input', function () {
    var inputValue = inputAddCategoryName.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddCategoryName.textContent = 'Invalid category\'s name, please enter again';
    } else {
        errorAddCategoryName.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

buttonAddCategory.addEventListener('click', function () {
    if (inputAddCategoryName.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddCategoryName.textContent = 'Please enter category\'s name';
        return;
    }
    if (errorAddCategoryName.textContent != '') {
        RemoveDataBSDismissOfAddButton();
        return;
    }

    const formData = new FormData();
    formData.append('name', inputAddCategoryName.value);

    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    // SEND DATA TO SERVER USING AJAX
    $.ajax({
        url: '/api/categories',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('.overlay').remove()
            Swal.fire({
                'icon': 'success',
                'title': 'Add category successfully',
                'showConfirmButton': false,
                'timer': 2000
            })

            const newCategory = document.createElement('tr');
            newCategory.setAttribute('id', 'category_' + response.category.id);
            newCategory.setAttribute('class', 'align-middle animate__animated animate__fadeInUp');
            newCategory.innerHTML = `
                <td>${response.category.name}</td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateCategory(${response.category.id})" data-bs-target="#updateCategoryModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteCategory(${response.category.id})">
                        Delete
                    </button>
                </td>
            `;
            const table = document.getElementById('categoryList');
            const firstRow = table.getElementsByTagName('tr')[0]; // Get the first row of the table
            table.insertBefore(newCategory, firstRow);

            // clear input
            inputAddCategoryName.value = '';
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
    if (!buttonAddCategory.hasAttribute('data-bs-dismiss')
        && errorAddCategoryName.textContent == ''
        && inputAddCategoryName.value != '') {
        buttonAddCategory.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfAddButton() {
    if (buttonAddCategory.hasAttribute('data-bs-dismiss')) {
        buttonAddCategory.removeAttribute('data-bs-dismiss')
    }
}

// UPDATE CATEGORY
// Get the input elements
inputUpdateCategoryName = document.getElementById('update-category-name');

// Get the error message elements
errorUpdateCategoryName = document.getElementById('errorUpdateCategoryName');

// Get the button element
buttonUpdateCategory = document.getElementById('buttonUpdateCategory');

// Add event listeners for the input elements
inputUpdateCategoryName.addEventListener('input', function () {
    var inputValue = inputUpdateCategoryName.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCategoryName.textContent = 'Invalid category\'s name, please enter again';
    } else {
        errorUpdateCategoryName.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

function updateCategory(categoryId) {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    // GET A CATEGORY AJAX
    const path = '/api/categories/' + categoryId;
    $.ajax({
        url: path,
        type: 'GET',
        success: function (response) {
            $('.overlay').remove()
            inputUpdateCategoryName.value = response.category.name;
            buttonUpdateCategory.setAttribute('data-bs-dismiss', 'modal');
            buttonUpdateCategory.setAttribute('onclick', 'updateCategorySubmit(' + categoryId + ')');
        },
        error: function (error) {
            $('.overlay').remove()
            console.error(error);
        }
    })
}

function updateCategorySubmit(id) {
    if (inputUpdateCategoryName.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCategoryName.textContent = 'Please enter category\'s name';
        return;
    }
    if (errorUpdateCategoryName.textContent != '') {
        RemoveDataBSDismissOfUpdateButton();
        return;
    }

    // const formData = new FormData();
    // formData.append('name', inputUpdateCategoryName.value);
    const data = {
        'name': inputUpdateCategoryName.value
    }
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    // SEND DATA TO SERVER USING AJAX
    const path = '/api/categories/' + id;
    $.ajax({
        url: path,
        type: 'PUT',
        data: data,
        success: function (response) {
            $('.overlay').remove()
            Swal.fire({
                'icon': 'success',
                'title': 'Update category successfully',
                'showConfirmButton': false,
                'timer': 2000
            })

            const category = document.getElementById('category_' + response.category.id);
            category.innerHTML = `
                <td>${response.category.name}</td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateCategory(${response.category.id})" data-bs-target="#updateCategoryModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteCategory(${response.category.id})">
                        Delete
                    </button>
                </td>
            `;

            // clear input
            inputUpdateCategoryName.value = '';
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

// DELETE CATEGORY
function deleteCategory(categoryId) {
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
        'text': 'This category will be deleted',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, delete it',
        'cancelButtonText': 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
            // DELETE A CATEGORY AJAX
            const path = '/api/categories/' + categoryId;
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

                    var el = document.getElementById('category_' + categoryId)
                    $(el)
                        .closest('#category_' + categoryId)
                        .css('background', '#f27474')
                        .closest('#category_' + categoryId)
                        .fadeOut(800, function () {
                            $('#category_' + categoryId).remove()
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

function AddDataBSDismissOfUpdateButton() {
    if (!buttonUpdateCategory.hasAttribute('data-bs-dismiss')
        && errorUpdateCategoryName.textContent == ''
        && inputUpdateCategoryName.value != '') {
        buttonUpdateCategory.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfUpdateButton() {
    if (buttonUpdateCategory.hasAttribute('data-bs-dismiss')) {
        buttonUpdateCategory.removeAttribute('data-bs-dismiss')
    }
}