// Replace the following with your own dataset or API endpoint for provinces, districts, and communes
const provinceSelect = document.getElementById('add-province');
const districtSelect = document.getElementById('add-district');
const communeSelect = document.getElementById('add-commune');
const btnAddReceiver = document.getElementById('btn-add-receiver');
const userId = document.getElementById('user-id').value;

let districts = [];
var communes = [];

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
            provinceSelect.appendChild(option);
        });
    }
});

// Handle province selection
provinceSelect.addEventListener('change', () => {
    const selectedProvinceId = provinceSelect.value;

    // Filter districts based on selected province
    // const filteredDistricts = districts.filter((district) => district.provinceId === selectedProvinceId);
    $.ajax({
        url: '/api/districts/province/' + selectedProvinceId,
        type: 'GET',
        success: function (data) {
            const filteredDistricts = data.districts;
            // Populate district dropdown
            filteredDistricts.forEach((district) => {
                const option = document.createElement('option');
                option.value = district.id;
                option.text = district.name;
                districtSelect.appendChild(option);
            });
        }
    });
});

// Handle district selection
districtSelect.addEventListener('change', () => {
    const selectedDistrictId = districtSelect.value;

    // Filter communes based on selected district
    // const filteredCommunes = communes.filter((commune) => commune.districtId === selectedDistrictId);
    $.ajax({
        url: '/api/communes/district/' + selectedDistrictId,
        type: 'GET',
        success: function (data) {
            const filteredCommunes = data.communes;
            // Populate commune dropdown
            filteredCommunes.forEach((commune) => {
                const option = document.createElement('option');
                option.value = commune.id;
                option.text = commune.name;
                communeSelect.appendChild(option);
            });
        }
    });
});

btnAddReceiver.addEventListener('click', () => {
    const firstName = document.getElementById('add-first-name').value;
    const lastName = document.getElementById('add-last-name').value;
    const telephone = document.getElementById('add-telephone').value;
    const subAddress = document.getElementById('add-address').value;
    const province = provinceSelect.options[provinceSelect.selectedIndex].text;
    const district = districtSelect.options[districtSelect.selectedIndex].text;
    const commune = communeSelect.options[communeSelect.selectedIndex].text;

    const address = `${subAddress}, ${commune}, ${district}, ${province}`;
    // Create receiver object
    const receiver = {
        user_id: userId,
        first_name: firstName,
        last_name: lastName,
        telephone,
        address,
    };
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
            receiverItem.innerHTML = `
                <div class="card">
                <h3 class="name">${firstName} ${lastName}</h3>
                <p class="address">
                    ${subAddress}<br>
                    ${commune}, ${district}, ${province}
                </p>
                <p class="phone">Phone: ${telephone}</p>
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