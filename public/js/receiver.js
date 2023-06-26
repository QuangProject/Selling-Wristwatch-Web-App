// Replace the following with your own dataset or API endpoint for provinces, districts, and communes
const addProvinceSelect = document.getElementById('add-province');
const addDistrictSelect = document.getElementById('add-district');
const addCommuneSelect = document.getElementById('add-commune');
const inputAddFirstName = document.getElementById('add-first-name');
const inputAddLastName = document.getElementById('add-last-name');
const inputAddTelephone = document.getElementById('add-telephone');
const inputAddSubAddress = document.getElementById('add-address');
const btnAddReceiver = document.getElementById('btn-add-receiver');
const userId = document.getElementById('user-id').value;

$.ajax({
    url: '/api/provinces',
    type: 'GET',
    success: function (data) {
        const provinces = data.provinces;
        // Populate province dropdown
        provinces.forEach((province) => {
            const option = document.createElement('option');
            option.value = province.id;
            option.text = province.name;
            addProvinceSelect.appendChild(option);
        });
    }
});

// Handle province selection
addProvinceSelect.addEventListener('change', () => {
    const selectedProvinceId = addProvinceSelect.value;

    // Filter districts based on selected province
    $.ajax({
        url: '/api/districts/province/' + selectedProvinceId,
        type: 'GET',
        success: function (data) {
            const filteredDistricts = data.districts;
            addDistrictSelect.innerHTML = '<option value="0" selected disabled>Please choose district</option>';
            addCommuneSelect.innerHTML = '<option value="0" selected disabled>Please choose commune</option>';
            // Populate district dropdown
            filteredDistricts.forEach((district) => {
                const option = document.createElement('option');
                option.value = district.id;
                option.text = district.name;
                addDistrictSelect.appendChild(option);
            });
        }
    });
});

// Handle district selection
addDistrictSelect.addEventListener('change', () => {
    const selectedDistrictId = addDistrictSelect.value;

    // Filter communes based on selected district
    $.ajax({
        url: '/api/communes/district/' + selectedDistrictId,
        type: 'GET',
        success: function (data) {
            const filteredCommunes = data.communes;
            addCommuneSelect.innerHTML = '<option value="0" selected disabled>Please choose commune</option>';
            // Populate commune dropdown
            filteredCommunes.forEach((commune) => {
                const option = document.createElement('option');
                option.value = commune.id;
                option.text = commune.name;
                addCommuneSelect.appendChild(option);
            });
        }
    });
});

btnAddReceiver.addEventListener('click', () => {
    const firstName = inputAddFirstName.value;
    const lastName = inputAddLastName.value;
    const telephone = inputAddTelephone.value;
    const subAddress = inputAddSubAddress.value;
    const province = addProvinceSelect.options[addProvinceSelect.selectedIndex].text;
    const district = addDistrictSelect.options[addDistrictSelect.selectedIndex].text;
    const commune = addCommuneSelect.options[addCommuneSelect.selectedIndex].text;

    const address = `${subAddress}, ${commune}, ${district}, ${province}`;
    // Create receiver object
    const formData = new FormData();
    formData.append('user_id', userId);
    formData.append('first_name', firstName);
    formData.append('last_name', lastName);
    formData.append('telephone', telephone);
    formData.append('address', address);

    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/receivers',
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

            const newReceiver = document.getElementById('listReceiver')
            const receiverItem = document.createElement('li');
            receiverItem.setAttribute('class', 'animate__animated animate__fadeInUp');
            receiverItem.setAttribute('id', 'receiver_' + response.receiver.id)
            receiverItem.innerHTML = `
                <div class="card row" data-receiver-id="${response.receiver.id}">
                    <div class="col-11">
                        <h3 class="name">${firstName} ${lastName}</h3>
                        <p class="address">
                            ${subAddress}<br>
                            ${commune}, ${district}, ${province}
                        </p>
                        <p class="phone">Phone: ${telephone}</p>
                    </div>
                    <div class="col-1">
                        <div class="dots-container">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="popup" style="display: none;">
                                <ul>
                                    <li data-bs-toggle="modal" data-bs-target="#updateReceiverModal">Edit</li>
                                    <li>Delete</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            newReceiver.appendChild(receiverItem);
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
    });
});

// Update receiver
const updateProvinceSelect = document.getElementById('update-province');
const updateDistrictSelect = document.getElementById('update-district');
const updateCommuneSelect = document.getElementById('update-commune');
const inputUpdateFirstName = document.getElementById('update-first-name');
const inputUpdateLastName = document.getElementById('update-last-name');
const inputUpdateTelephone = document.getElementById('update-telephone');
const inputUpdateSubAddress = document.getElementById('update-address');
const btnUpdateReceiver = document.getElementById('btn-update-receiver');

$.ajax({
    url: '/api/provinces',
    type: 'GET',
    success: function (data) {
        const provinces = data.provinces;
        // Populate province dropdown
        provinces.forEach((province) => {
            const option = document.createElement('option');
            option.value = province.id;
            option.text = province.name;
            updateProvinceSelect.appendChild(option);
        });
    }
});

// Handle province selection
updateProvinceSelect.addEventListener('change', () => {
    const selectedProvinceId = updateProvinceSelect.value;

    // Filter districts based on selected province
    $.ajax({
        url: '/api/districts/province/' + selectedProvinceId,
        type: 'GET',
        success: function (data) {
            const filteredDistricts = data.districts;
            updateDistrictSelect.innerHTML = '<option value="0" selected disabled>Please choose district</option>';
            updateCommuneSelect.innerHTML = '<option value="0" selected disabled>Please choose commune</option>';
            // Populate district dropdown
            filteredDistricts.forEach((district) => {
                const option = document.createElement('option');
                option.value = district.id;
                option.text = district.name;
                updateDistrictSelect.appendChild(option);
            });
        }
    });
});

// Handle district selection
updateDistrictSelect.addEventListener('change', () => {
    const selectedDistrictId = updateDistrictSelect.value;

    // Filter communes based on selected district
    $.ajax({
        url: '/api/communes/district/' + selectedDistrictId,
        type: 'GET',
        success: function (data) {
            const filteredCommunes = data.communes;
            updateCommuneSelect.innerHTML = '<option value="0" selected disabled>Please choose commune</option>';
            // Populate commune dropdown
            filteredCommunes.forEach((commune) => {
                const option = document.createElement('option');
                option.value = commune.id;
                option.text = commune.name;
                updateCommuneSelect.appendChild(option);
            });
        }
    });
});

function fillInChooseAddress(addressArray) {
    let provinceId = 0;
    let districtId = 0;
    // Fill in commune dropdown
    const provinceOptions = updateProvinceSelect.options;
    for (let i = 0; i < provinceOptions.length; i++) {
        if (provinceOptions[i].text === addressArray[2]) {
            updateProvinceSelect.selectedIndex = i;
            provinceId = provinceOptions[i].value;
            break;
        }
    }
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/districts/province/' + provinceId,
        type: 'GET',
        success: function (data) {
            const filteredDistricts = data.districts;
            updateDistrictSelect.innerHTML = '<option value="0" selected disabled>Please choose district</option>';
            // Populate district dropdown
            filteredDistricts.forEach((district) => {
                const option = document.createElement('option');
                option.value = district.id;
                option.text = district.name;
                updateDistrictSelect.appendChild(option);
            });
            const districtOptions = updateDistrictSelect.options;
            for (let i = 0; i < districtOptions.length; i++) {
                if (districtOptions[i].text === addressArray[1]) {
                    updateDistrictSelect.selectedIndex = i;
                    districtId = districtOptions[i].value;
                    break;
                }
            }
            $.ajax({
                url: '/api/communes/district/' + districtId,
                type: 'GET',
                success: function (data) {
                    const filteredCommunes = data.communes;
                    updateCommuneSelect.innerHTML = '<option value="0" selected disabled>Please choose commune</option>';
                    // Populate commune dropdown
                    filteredCommunes.forEach((commune) => {
                        const option = document.createElement('option');
                        option.value = commune.id;
                        option.text = commune.name;
                        updateCommuneSelect.appendChild(option);
                    });
                    const communeOptions = updateCommuneSelect.options;
                    for (let i = 0; i < communeOptions.length; i++) {
                        if (communeOptions[i].text === addressArray[0]) {
                            updateCommuneSelect.selectedIndex = i;
                            break;
                        }
                    }
                    $('.overlay').remove()
                }
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.card');

    cards.forEach(function (card) {
        const dotsContainer = card.querySelector('.dots-container');
        const popup = card.querySelector('.popup');
        const receiverId = card.dataset.receiverId;
        let isPopupVisible = false;

        dotsContainer.addEventListener('click', function () {
            if (isPopupVisible) {
                popup.style.display = 'none';
                isPopupVisible = false;
            } else {
                popup.style.display = 'block';
                isPopupVisible = true;
            }
        });

        popup.addEventListener('click', function (event) {
            const target = event.target;
            if (target.tagName === 'LI') {
                const option = target.textContent;
                if (option === 'Edit') {
                    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
                    // GET A RECEIVER AJAX
                    const path = '/api/receivers/' + receiverId;
                    $.ajax({
                        url: path,
                        type: 'GET',
                        success: function (response) {
                            // console.log(response);
                            $('.overlay').remove()
                            inputUpdateFirstName.value = response.receiver.first_name;
                            inputUpdateLastName.value = response.receiver.last_name;
                            inputUpdateTelephone.value = response.receiver.telephone;
                            inputUpdateSubAddress.value = response.receiver.sub_address;
                            const addressArray = response.receiver.address.split(', ');
                            fillInChooseAddress(addressArray)
                            btnUpdateReceiver.setAttribute('data-bs-dismiss', 'modal');
                            btnUpdateReceiver.setAttribute('onclick', 'updateReceiverSubmit(' + receiverId + ')');
                        },
                        error: function (error) {
                            $('.overlay').remove()
                            console.error(error);
                        }
                    })
                } else if (option === 'Delete') {
                    deleteReceiver(receiverId)
                }
                popup.style.display = 'none';
                isPopupVisible = false;
            }
        });

        document.addEventListener('click', function (event) {
            const target = event.target;
            if (!card.contains(target)) {
                popup.style.display = 'none';
                isPopupVisible = false;
            }
        });
    });
});

function updateReceiverSubmit(receiverId) {
    // console.log(receiverId);
    const firstName = inputUpdateFirstName.value;
    const lastName = inputUpdateLastName.value;
    const telephone = inputUpdateTelephone.value;
    const subAddress = inputUpdateSubAddress.value;
    const province = updateProvinceSelect.options[updateProvinceSelect.selectedIndex].text;
    const district = updateDistrictSelect.options[updateDistrictSelect.selectedIndex].text;
    const commune = updateCommuneSelect.options[updateCommuneSelect.selectedIndex].text;

    const address = `${subAddress}, ${commune}, ${district}, ${province}`;

    // Create receiver object
    // const formData = new FormData();
    // formData.append('user_id', userId);
    // formData.append('first_name', firstName);
    // formData.append('last_name', lastName);
    // formData.append('telephone', telephone);
    // formData.append('address', address);
    const data = {
        'user_id': userId,
        'first_name': firstName,
        'last_name': lastName,
        'telephone': telephone,
        'address': address
    }

    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/receivers/' + receiverId,
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

            const receiver = document.getElementById('receiver_' + receiverId);
            receiver.innerHTML = `
                <div class="card row" data-receiver-id="${receiverId}">
                    <div class="col-11">
                        <h3 class="name">${firstName} ${lastName}</h3>
                        <p class="address">
                            ${subAddress}<br>
                            ${commune}, ${district}, ${province}
                        </p>
                        <p class="phone">Phone: ${telephone}</p>
                    </div>
                    <div class="col-1">
                        <div class="dots-container">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="popup">
                            <ul>
                                <li data-bs-toggle="modal" data-bs-target="#updateReceiverModal">Edit</li>
                                <li>Delete</li>
                            </ul>
                        </div>
                    </div>
                </div>
            `;
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
    });
}

// DELETE RECEIVER
function deleteReceiver(id) {
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
        'text': 'This receiver will be deleted',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, delete it',
        'cancelButtonText': 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
            // DELETE A CATEGORY AJAX
            const path = '/api/receivers/' + id;
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

                    var el = document.getElementById('receiver_' + id)
                    $(el)
                        .closest('#receiver_' + id)
                        .css('background', '#f27474')
                        .closest('#receiver_' + id)
                        .fadeOut(800, function () {
                            $('#receiver_' + id).remove()
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