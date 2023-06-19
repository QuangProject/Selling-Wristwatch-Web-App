// Display watch
$(document).ready(function () {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/watches',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('.overlay').remove()
            const selectWatch = document.getElementById('add-watch-id');
            // Loop through each data and append to select element
            $.each(data.watches, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.model;
                selectWatch.appendChild(option);
            });

            const selectUpdateWatch = document.getElementById('update-watch-id');
            // Loop through each data and append to select element
            $.each(data.watches, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.model;
                selectUpdateWatch.appendChild(option);
            });

        },
        error: function (error) {
            $('.overlay').remove()
            console.log(error);
        }
    });
});

// Display category
$(document).ready(function () {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/categories',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('.overlay').remove()
            const selectCategory = document.getElementById('add-category-id');
            // Loop through each data and append to select element
            $.each(data.categories, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.name;
                selectCategory.appendChild(option);
            });

            const selectUpdateWatch = document.getElementById('update-category-id');
            // Loop through each data and append to select element
            $.each(data.categories, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.name;
                selectUpdateWatch.appendChild(option);
            });

        },
        error: function (error) {
            $('.overlay').remove()
            console.log(error);
        }
    });
});

// ADD WATCH CATEGORY
// Search add watch
$(function () {
    $("#search-input-add-watch-model").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/api/watch/search-suggestions",
                data: {
                    query: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        delay: 300
    });
});

// Search add category
$(function () {
    $("#search-input-add-category-name").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/api/category/search-suggestions",
                data: {
                    query: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        delay: 300
    });
});

// Process of adding watch
const searchInputAddWatchModel = document.getElementById('search-input-add-watch-model');
const selectAddWatchModel = document.getElementById('add-watch-id');
const btnSearchAddWatch = document.getElementById('btn-search-add-watch-model');
btnSearchAddWatch.addEventListener('click', function () {
    let selected = false;
    for (let i = 0; i < selectAddWatchModel.length; i++) {
        if (selectAddWatchModel[i].text === searchInputAddWatchModel.value) {
            selectAddWatchModel[i].selected = true;
            selected = true;
            break;
        }
    }
    if (!selected) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Watch not found!',
        })
    }
});

// Process of adding category
const searchInputAddCategoryName = document.getElementById('search-input-add-category-name');
const selectAddCategoryName = document.getElementById('add-category-id');
const btnSearchAddCategory = document.getElementById('btn-search-add-category-name');
btnSearchAddCategory.addEventListener('click', function () {
    let selected = false;
    for (let i = 0; i < selectAddCategoryName.length; i++) {
        if (selectAddCategoryName[i].text === searchInputAddCategoryName.value) {
            selectAddCategoryName[i].selected = true;
            selected = true;
            break;
        }
    }
    if (!selected) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Category not found!',
        })
    }
});

// Click add watch category
const errorAddWatchId = document.getElementById('error-add-watch-id');
const errorAddCategoryId = document.getElementById('error-add-category-id');
const btnAddWatchCategory = document.getElementById('btn-add-watch-category');

// Validate input watch id
selectAddWatchModel.addEventListener('input', function (event) {
    if (selectAddWatchModel.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchId.textContent = 'Please select watch';
    } else {
        errorAddWatchId.textContent = '';
        AddDataBSDismissOfAddButton();
    }
});

// Validate input category id
selectAddCategoryName.addEventListener('input', function (event) {
    if (selectAddCategoryName.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddCategoryId.textContent = 'Please select category';
    } else {
        errorAddCategoryId.textContent = '';
        AddDataBSDismissOfAddButton();
    }
});

btnAddWatchCategory.addEventListener('click', function () {
    // Validate input watch id
    if (selectAddWatchModel.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchId.innerHTML = 'Please select watch';
        return;
    }
    // Validate input category id
    if (selectAddCategoryName.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddCategoryId.innerHTML = 'Please select category';
        return;
    }
    // validate error message
    if (errorAddWatchId.textContent != '' || errorAddCategoryId.textContent != '') {
        RemoveDataBSDismissOfAddButton();
        return;
    }

    const watchId = selectAddWatchModel.value;
    const categoryId = selectAddCategoryName.value;

    const formData = new FormData();
    formData.append('watch_id', watchId);
    formData.append('category_id', categoryId);

    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/watch-categories',
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

            // Add new row to table
            const newWatchCategory = document.createElement('tr');
            newWatchCategory.setAttribute('id', 'watchCategory_' + response.watchCategory.id);
            newWatchCategory.setAttribute('class', 'align-middle animate__animated animate__fadeInUp');
            newWatchCategory.innerHTML = `
                <td>${response.watchCategory.watch_model}</td>
                <td>${response.watchCategory.category_name}</td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateWatchCategory(${response.watchCategory.id})" data-bs-target="#updateWatchCategoryModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteWatchCategory(${response.watchCategory.id})">
                        Delete
                    </button>
                </td>
            `;
            const table = document.getElementById('watchCategoryList');
            const firstRow = table.getElementsByTagName('tr')[0]; // Get the first row of the table
            table.insertBefore(newWatchCategory, firstRow);

            // Clear input
            selectAddWatchModel.value = 0;
            selectAddCategoryName.value = 0;
            searchInputAddWatchModel.value = '';
            searchInputAddCategoryName.value = '';
            errorAddWatchId.textContent = '';
            errorAddCategoryId.textContent = '';
            RemoveDataBSDismissOfAddButton();
        },
        error: function (error) {
            $('.overlay').remove()
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
    if (!btnAddWatchCategory.hasAttribute('data-bs-dismiss')
        && errorAddWatchId.textContent == '' && errorAddCategoryId.textContent == ''
        && selectAddWatchModel.value != 0 && selectAddCategoryName.value != 0) {
        btnAddWatchCategory.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfAddButton() {
    if (btnAddWatchCategory.hasAttribute('data-bs-dismiss')) {
        btnAddWatchCategory.removeAttribute('data-bs-dismiss')
    }
}

// UPDATE WATCH CATEGORY
// Search update watch
$(function () {
    $("#search-input-update-watch-model").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/api/watch/search-suggestions",
                data: {
                    query: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        delay: 300
    });
});

// Search update category
$(function () {
    $("#search-input-update-category-name").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/api/category/search-suggestions",
                data: {
                    query: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        delay: 300
    });
});

// Process of updating watch
const searchInputUpdateWatchModel = document.getElementById('search-input-update-watch-model');
const selectUpdateWatchModel = document.getElementById('update-watch-id');
const btnSearchUpdateWatch = document.getElementById('btn-search-update-watch-model');
btnSearchUpdateWatch.addEventListener('click', function () {
    let selected = false;
    for (let i = 0; i < selectUpdateWatchModel.length; i++) {
        if (selectUpdateWatchModel[i].text === searchInputUpdateWatchModel.value) {
            selectUpdateWatchModel[i].selected = true;
            selected = true;
            break;
        }
    }
    if (!selected) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Watch not found!',
        })
    }
});

// Process of updating category
const searchInputUpdateCategoryName = document.getElementById('search-input-update-category-name');
const selectUpdateCategoryName = document.getElementById('update-category-id');
const btnSearchUpdateCategory = document.getElementById('btn-search-update-category-name');
btnSearchUpdateCategory.addEventListener('click', function () {
    let selected = false;
    for (let i = 0; i < selectUpdateCategoryName.length; i++) {
        if (selectUpdateCategoryName[i].text === searchInputUpdateCategoryName.value) {
            selectUpdateCategoryName[i].selected = true;
            selected = true;
            break;
        }
    }
    if (!selected) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Category not found!',
        })
    }
});

// get error message
const errorUpdateWatchId = document.getElementById('error-update-watch-id');
const errorUpdateCategoryId = document.getElementById('error-update-category-id');
// get button update collection
const btnUpdateWatchCategory = document.getElementById('btn-update-watch-category');

// Display information of watch category to update
function updateWatchCategory(id) {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/watch-categories/' + id,
        type: 'GET',
        success: function (response) {
            $('.overlay').remove()
            selectUpdateWatchModel.value = response.watchCategory.watch_id;
            selectUpdateCategoryName.value = response.watchCategory.category_id;
            btnUpdateWatchCategory.setAttribute('data-bs-dismiss', 'modal');
            btnUpdateWatchCategory.setAttribute('onclick', 'updateWatchCategorySubmit(' + response.watchCategory.id + ')');
        },
        error: function (error) {
            $('.overlay').remove()
            console.error(error);
        }
    });
}

// Validate input watch id
selectUpdateWatchModel.addEventListener('input', function (event) {
    if (selectUpdateWatchModel.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchId.textContent = 'Please select watch';
    } else {
        errorUpdateWatchId.textContent = '';
        AddDataBSDismissOfUpdateButton();
    }
})

// Validate input category id
selectUpdateCategoryName.addEventListener('input', function (event) {
    if (selectUpdateWatchModel.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCategoryId.textContent = 'Please select category';
    } else {
        errorUpdateCategoryId.textContent = '';
        AddDataBSDismissOfUpdateButton();
    }
})

// Click update watch category
function updateWatchCategorySubmit(id) {
    // Validate input watch id
    if (selectUpdateWatchModel.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchId.innerHTML = 'Please select watch';
        return;
    }
    // Validate input category id
    if (selectUpdateCategoryName.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateCategoryId.innerHTML = 'Please select category';
        return;
    }
    // validate error message
    if (errorUpdateWatchId.textContent != '' || errorUpdateCategoryId.textContent != '') {
        RemoveDataBSDismissOfUpdateButton();
        return;
    }

    const data = {
        watch_id: selectUpdateWatchModel.value,
        category_id: selectUpdateCategoryName.value
    }

    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/watch-categories/' + id,
        type: 'PUT',
        data: data,
        success: function (response) {
            $('.overlay').remove()
            Swal.fire({
                'icon': 'success',
                'title': response.message,
                'showConfirmButton': false,
                'timer': 2000
            })

            const watchCategory = document.getElementById('watchCategory_' + id);
            watchCategory.innerHTML = `
                <td>${response.watchCategory.watch_model}</td>
                <td>${response.watchCategory.category_name}</td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateWatchCategory(${response.watchCategory.id})" data-bs-target="#updateWatchCategoryModal">
                        Edit
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteWatchCategory(${response.watchCategory.id})">
                        Delete
                    </button>
                </td>
            `;

            // clear input
            selectUpdateWatchModel.value = 0;
            selectUpdateCategoryName.value = 0;
            searchInputUpdateWatchModel.value = '';
            searchInputUpdateCategoryName.value = '';
            errorUpdateWatchId.textContent = '';
            RemoveDataBSDismissOfUpdateButton();
        },
        error: function (error) {
            $('.overlay').remove()
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
    if (!btnUpdateWatchCategory.hasAttribute('data-bs-dismiss')
        && errorUpdateWatchId.textContent == '' && errorUpdateCategoryId.textContent == ''
        && selectUpdateWatchModel.value != 0 && selectUpdateCategoryName.value != 0) {
        btnUpdateWatchCategory.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfUpdateButton() {
    if (btnUpdateWatchCategory.hasAttribute('data-bs-dismiss')) {
        btnUpdateWatchCategory.removeAttribute('data-bs-dismiss')
    }
}

// DELETE WATCH CATEGORY
function deleteWatchCategory(id) {
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
        'text': 'This watch category will be deleted',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, delete it',
        'cancelButtonText': 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
            // DELETE A BRAND AJAX
            const path = '/api/watch-categories/' + id;
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

                    var el = document.getElementById('watchCategory_' + id)
                    $(el)
                        .closest('#watchCategory_' + id)
                        .css('background', '#f27474')
                        .closest('#watchCategory_' + id)
                        .fadeOut(800, function () {
                            $('#watchCategory_' + id).remove()
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