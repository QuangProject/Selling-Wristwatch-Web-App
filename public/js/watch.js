// Display collection watch
$(document).ready(function () {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/collections',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('.overlay').remove()
            const selectCollection = document.getElementById('add-watch-collection');
            // Loop through each data and append to select element
            $.each(data.collections, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.name;
                selectCollection.appendChild(option);
            });

            const selectUpdateCollection = document.getElementById('update-watch-collection');
            // Loop through each data and append to select element
            $.each(data.collections, function (key, value) {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.name;
                selectUpdateCollection.appendChild(option);
            });

        },
        error: function (error) {
            $('.overlay').remove()
            console.log(error);
        }
    });
});

// ADD WATCH
// =====================================================================================================================
var format = /[!@#$%^&*()_+\=\[\]{};':"\\|<>\/?]+/;
var regex = /^[+]?([0-9]*\.)?[0-9]+([eE][-+]?[0-9]+)?$/;
// Get the input element
inputAddWatchModel = document.getElementById('add-watch-model');
inputAddWatchCollection = document.getElementById('add-watch-collection');
inputAddWatchOriginalPrice = document.getElementById('add-watch-original-price');
inputAddWatchSellingPrice = document.getElementById('add-watch-selling-price');
inputAddWatchGender = document.getElementsByName('add-watch-gender');
inputAddWatchCaseMaterial = document.getElementById('add-watch-case-material');
inputAddWatchCaseDiameter = document.getElementById('add-watch-case-diameter');
inputAddWatchCaseThickness = document.getElementById('add-watch-case-thickness');
inputAddWatchStrapMaterial = document.getElementById('add-watch-strap-material');
inputAddWatchDialColor = document.getElementById('add-watch-dial-color');
inputAddWatchCrystalMaterial = document.getElementById('add-watch-crystal-material');
inputAddWatchWaterResistance = document.getElementById('add-watch-water-resistance');
inputAddWatchMovementType = document.getElementById('add-watch-movement-type');
inputAddWatchPowerReserve = document.getElementById('add-watch-power-reserve');
inputAddWatchComplications = document.getElementById('add-watch-complications');

// Get the error message elements
errorAddWatchModel = document.getElementById('error-add-watch-model');
errorAddWatchCollection = document.getElementById('error-add-watch-collection');
errorAddWatchOriginalPrice = document.getElementById('error-add-watch-original-price');
errorAddWatchSellingPrice = document.getElementById('error-add-watch-selling-price');
errorAddWatchGender = document.getElementById('error-add-watch-gender');
errorAddWatchCaseMaterial = document.getElementById('error-add-watch-case-material');
errorAddWatchCaseDiameter = document.getElementById('error-add-watch-case-diameter');
errorAddWatchCaseThickness = document.getElementById('error-add-watch-case-thickness');
errorAddWatchStrapMaterial = document.getElementById('error-add-watch-strap-material');
errorAddWatchDialColor = document.getElementById('error-add-watch-dial-color');
errorAddWatchCrystalMaterial = document.getElementById('error-add-watch-crystal-material');
errorAddWatchWaterResistance = document.getElementById('error-add-watch-water-resistance');
errorAddWatchMovementType = document.getElementById('error-add-watch-movement-type');
errorAddWatchPowerReserve = document.getElementById('error-add-watch-power-reserve');
errorAddWatchComplications = document.getElementById('error-add-watch-complications');

// Get the button element
buttonAddWatch = document.getElementById('button-add-watch');

// Add event listeners for the input add watch model elements
inputAddWatchModel.addEventListener('input', function () {
    var inputValue = inputAddWatchModel.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchModel.textContent = 'Model cannot contain special characters';
    } else {
        errorAddWatchModel.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch collection elements
inputAddWatchCollection.addEventListener('input', function () {
    var inputValue = inputAddWatchCollection.value;
    // Perform validation or error checking on the entered value
    if (inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCollection.textContent = 'Please select a collection';
    } else {
        errorAddWatchCollection.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch price elements
inputAddWatchOriginalPrice.addEventListener('input', function () {
    var inputValue = inputAddWatchOriginalPrice.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchOriginalPrice.textContent = 'Original price must be a number';
    } else {
        errorAddWatchOriginalPrice.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch stock elements
inputAddWatchSellingPrice.addEventListener('input', function () {
    var inputValue = inputAddWatchSellingPrice.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchSellingPrice.textContent = 'Selling price must be a number';
    } else {
        errorAddWatchSellingPrice.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch case material elements
inputAddWatchCaseMaterial.addEventListener('input', function () {
    var inputValue = inputAddWatchCaseMaterial.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCaseMaterial.textContent = 'Case material cannot contain special characters';
    } else {
        errorAddWatchCaseMaterial.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch case diameter elements
inputAddWatchCaseDiameter.addEventListener('input', function () {
    var inputValue = inputAddWatchCaseDiameter.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCaseDiameter.textContent = 'Case diameter must be a number';
    } else {
        errorAddWatchCaseDiameter.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch case thickness elements
inputAddWatchCaseThickness.addEventListener('input', function () {
    var inputValue = inputAddWatchCaseThickness.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCaseThickness.textContent = 'Case thickness must be a number';
    } else {
        errorAddWatchCaseThickness.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch strap material elements
inputAddWatchStrapMaterial.addEventListener('input', function () {
    var inputValue = inputAddWatchStrapMaterial.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchStrapMaterial.textContent = 'Strap material cannot contain special characters';
    } else {
        errorAddWatchStrapMaterial.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch dial color elements
inputAddWatchDialColor.addEventListener('input', function () {
    var inputValue = inputAddWatchDialColor.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchDialColor.textContent = 'Dial color cannot contain special characters';
    } else {
        errorAddWatchDialColor.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch crystal material elements
inputAddWatchCrystalMaterial.addEventListener('input', function () {
    var inputValue = inputAddWatchCrystalMaterial.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCrystalMaterial.textContent = 'Crystal material cannot contain special characters';
    } else {
        errorAddWatchCrystalMaterial.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch water resistance elements
inputAddWatchWaterResistance.addEventListener('input', function () {
    var inputValue = inputAddWatchWaterResistance.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchWaterResistance.textContent = 'Water resistance must be a number';
    } else {
        errorAddWatchWaterResistance.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch movement type elements
inputAddWatchMovementType.addEventListener('input', function () {
    var inputValue = inputAddWatchMovementType.value;
    // Perform validation or error checking on the entered value
    if (inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchMovementType.textContent = 'Please select a movement type';
    } else {
        errorAddWatchMovementType.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch power reserve elements
inputAddWatchPowerReserve.addEventListener('input', function () {
    var inputValue = inputAddWatchPowerReserve.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchPowerReserve.textContent = 'Power reserve must be a number';
    } else {
        errorAddWatchPowerReserve.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Add event listeners for the input add watch complications elements
inputAddWatchComplications.addEventListener('input', function () {
    var inputValue = inputAddWatchComplications.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchComplications.textContent = 'Complications cannot contain special characters';
    } else {
        errorAddWatchComplications.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfAddButton();
    }
});

// Click event listener for the button add watch
buttonAddWatch.addEventListener('click', function () {
    // Perform validation or error checking on the entered value
    if (inputAddWatchModel.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchModel.textContent = 'Please enter a model';
        return;
    }
    if (inputAddWatchCollection.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCollection.textContent = 'Please select a collection';
        return;
    }
    if (inputAddWatchOriginalPrice.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchOriginalPrice.textContent = 'Please enter an original price';
        return;
    }
    if (inputAddWatchSellingPrice.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchSellingPrice.textContent = 'Please enter a selling price';
        return;
    }
    var gender = '';
    for (var i = 0; i < inputAddWatchGender.length; i++) {
        if (inputAddWatchGender[i].checked) {
            gender = inputAddWatchGender[i].value;
            break;
        }
    }
    if (gender == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchGender.textContent = 'Please choose watch for gender'
        return;
    } else {
        errorAddWatchGender.textContent = '';
    }
    if (inputAddWatchCaseMaterial.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCaseMaterial.textContent = 'Please enter a case material';
        return;
    }
    if (inputAddWatchCaseDiameter.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCaseDiameter.textContent = 'Please enter a case diameter';
        return;
    }
    if (inputAddWatchCaseThickness.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCaseThickness.textContent = 'Please enter a case thickness';
        return;
    }
    if (inputAddWatchStrapMaterial.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchStrapMaterial.textContent = 'Please enter a strap material';
        return;
    }
    if (inputAddWatchDialColor.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchDialColor.textContent = 'Please enter a dial color';
        return;
    }
    if (inputAddWatchCrystalMaterial.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchCrystalMaterial.textContent = 'Please enter a crystal material';
        return;
    }
    if (inputAddWatchWaterResistance.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchWaterResistance.textContent = 'Please enter a water resistance';
        return;
    }
    if (inputAddWatchMovementType.value == 0) {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchMovementType.textContent = 'Please select a movement type';
        return;
    }
    if (inputAddWatchPowerReserve.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchPowerReserve.textContent = 'Please enter a power reserve';
        return;
    }
    if (inputAddWatchComplications.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorAddWatchComplications.textContent = 'Please enter a complications';
        return;
    }
    // Valid error checking
    if (errorAddWatchModel.textContent != '' || errorAddWatchCollection.textContent != '' || errorAddWatchOriginalPrice.textContent != '' || errorAddWatchSellingPrice.textContent != '' || errorAddWatchGender.textContent != '' || errorAddWatchCaseMaterial.textContent != '' || errorAddWatchCaseDiameter.textContent != '' || errorAddWatchCaseThickness.textContent != '' || errorAddWatchStrapMaterial.textContent != '' || errorAddWatchDialColor.textContent != '' || errorAddWatchCrystalMaterial.textContent != '' || errorAddWatchWaterResistance.textContent != '' || errorAddWatchMovementType.textContent != '' || errorAddWatchPowerReserve.textContent != '' || errorAddWatchComplications.textContent != '') {
        RemoveDataBSDismissOfAddButton();
        return;
    }
    // If all validation has passed, submit the form
    const formData = new FormData();
    formData.append('model', inputAddWatchModel.value);
    formData.append('original_price', inputAddWatchOriginalPrice.value);
    formData.append('selling_price', inputAddWatchSellingPrice.value);
    formData.append('discount', 0);
    formData.append('gender', gender);
    formData.append('case_material', inputAddWatchCaseMaterial.value);
    formData.append('case_diameter', inputAddWatchCaseDiameter.value);
    formData.append('case_thickness', inputAddWatchCaseThickness.value);
    formData.append('strap_material', inputAddWatchStrapMaterial.value);
    formData.append('dial_color', inputAddWatchDialColor.value);
    formData.append('crystal_material', inputAddWatchCrystalMaterial.value);
    formData.append('water_resistance', inputAddWatchWaterResistance.value);
    formData.append('movement_type', inputAddWatchMovementType.value);
    formData.append('power_reserve', inputAddWatchPowerReserve.value);
    formData.append('complications', inputAddWatchComplications.value);
    formData.append('availability', 1);
    formData.append('collection_id', inputAddWatchCollection.value);
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')

    $.ajax({
        url: '/api/watches',
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
            let status = ''
            if (response.watch.availability == 1) {
                status = 'Still In Business'
            } else {
                status = 'Business Suspension'
            }
            const newWatch = document.createElement('tr');
            newWatch.setAttribute('id', 'watch_' + response.watch.id);
            newWatch.setAttribute('class', 'align-middle animate__animated animate__fadeInUp');
            newWatch.innerHTML = `
                <td>${response.watch.model}</td>
                <td>$${response.watch.original_price}</td>
                <td>$${response.watch.selling_price}</td>
                <td>${response.watch.discount}%</td>
                <td>${response.watch.gender}</td>
                <td>${response.watch.case_material}</td>
                <td>${response.watch.case_diameter}mm</td>
                <td>${response.watch.case_thickness}mm</td>
                <td>${response.watch.strap_material}</td>
                <td>${response.watch.dial_color}</td>
                <td>${response.watch.crystal_material}</td>
                <td>${response.watch.water_resistance}m</td>
                <td>${response.watch.movement_type}</td>
                <td>${response.watch.power_reserve} hours</td>
                <td>${response.watch.complications}</td>
                <td>${response.watch.collection_name}</td>
                <td>${status}</td>
                <td>
                    <a href="/admin/watch/${response.watch.id}/image">View</a>
                </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateWatch(${response.watch.id})" data-bs-target="#updateWatchModal">
                        Edit
                    </button>
                    <button class="btn btn-danger mt-2" type="button" onclick="deleteWatch(${response.watch.id})">
                        Delete
                    </button>
                </td>
            `;
            const table = document.getElementById('watchList');
            const firstRow = table.getElementsByTagName('tr')[0]; // Get the first row of the table
            table.insertBefore(newWatch, firstRow);

            // clear input fields
            inputAddWatchModel.value = '';
            inputAddWatchCollection.value = 0;
            inputAddWatchOriginalPrice.value = '';
            inputAddWatchSellingPrice.value = '';
            inputAddWatchGender.value = '';
            inputAddWatchCaseMaterial.value = '';
            inputAddWatchCaseDiameter.value = '';
            inputAddWatchCaseThickness.value = '';
            inputAddWatchStrapMaterial.value = '';
            inputAddWatchDialColor.value = '';
            inputAddWatchCrystalMaterial.value = '';
            inputAddWatchWaterResistance.value = '';
            inputAddWatchMovementType.value = 0;
            inputAddWatchPowerReserve.value = '';
            inputAddWatchComplications.value = '';
            RemoveDataBSDismissOfAddButton();
        },
        error: function (error) {
            $('.overlay').remove()
            console.log(error);
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

// Change data bs dismiss of add button when input add watch collection is changed
function AddDataBSDismissOfAddButton() {
    if (!buttonAddWatch.hasAttribute('data-bs-dismiss')
        && errorAddWatchModel.textContent == '' && errorAddWatchCollection.textContent == '' && errorAddWatchOriginalPrice.textContent == '' && errorAddWatchSellingPrice.textContent == '' && errorAddWatchGender.textContent == '' && errorAddWatchCaseMaterial.textContent == '' && errorAddWatchCaseDiameter.textContent == '' && errorAddWatchCaseThickness.textContent == '' && errorAddWatchStrapMaterial.textContent == '' && errorAddWatchDialColor.textContent == '' && errorAddWatchCrystalMaterial.textContent == '' && errorAddWatchWaterResistance.textContent == '' && errorAddWatchMovementType.textContent == '' && errorAddWatchPowerReserve.textContent == '' && errorAddWatchComplications.textContent == ''
        && inputAddWatchModel.value != '' && inputAddWatchCollection.value != 0 && inputAddWatchOriginalPrice.value != '' && inputAddWatchSellingPrice.value != '' && inputAddWatchGender.value != '' && inputAddWatchCaseMaterial.value != '' && inputAddWatchCaseDiameter.value != '' && inputAddWatchCaseThickness.value != '' && inputAddWatchStrapMaterial.value != '' && inputAddWatchDialColor.value != '' && inputAddWatchCrystalMaterial.value != '' && inputAddWatchWaterResistance.value != '' && inputAddWatchMovementType.value != 0 && inputAddWatchPowerReserve.value != '' && inputAddWatchComplications.value != '') {
        buttonAddWatch.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfAddButton() {
    if (buttonAddWatch.hasAttribute('data-bs-dismiss')) {
        buttonAddWatch.removeAttribute('data-bs-dismiss')
    }
}

// UPDATE WATCH
// =====================================================================================================================
// Get the input element
inputUpdateWatchModel = document.getElementById('update-watch-model');
inputUpdateWatchCollection = document.getElementById('update-watch-collection');
inputUpdateWatchOriginalPrice = document.getElementById('update-watch-original-price');
inputUpdateWatchSellingPrice = document.getElementById('update-watch-selling-price');
inputUpdateWatchDiscount = document.getElementById('update-watch-discount');
inputUpdateWatchGender = document.getElementsByName('update-watch-gender');
inputUpdateWatchCaseMaterial = document.getElementById('update-watch-case-material');
inputUpdateWatchCaseDiameter = document.getElementById('update-watch-case-diameter');
inputUpdateWatchCaseThickness = document.getElementById('update-watch-case-thickness');
inputUpdateWatchStrapMaterial = document.getElementById('update-watch-strap-material');
inputUpdateWatchDialColor = document.getElementById('update-watch-dial-color');
inputUpdateWatchCrystalMaterial = document.getElementById('update-watch-crystal-material');
inputUpdateWatchWaterResistance = document.getElementById('update-watch-water-resistance');
inputUpdateWatchMovementType = document.getElementById('update-watch-movement-type');
inputUpdateWatchPowerReserve = document.getElementById('update-watch-power-reserve');
inputUpdateWatchComplications = document.getElementById('update-watch-complications');
inputUpdateWatchAvailability = document.getElementsByName('update-watch-availability');

// Get the error message elements
errorUpdateWatchModel = document.getElementById('error-update-watch-model');
errorUpdateWatchCollection = document.getElementById('error-update-watch-collection');
errorUpdateWatchOriginalPrice = document.getElementById('error-update-watch-original-price');
errorUpdateWatchSellingPrice = document.getElementById('error-update-watch-selling-price');
errorUpdateWatchDiscount = document.getElementById('error-update-watch-discount');
errorUpdateWatchGender = document.getElementById('error-update-watch-gender');
errorUpdateWatchCaseMaterial = document.getElementById('error-update-watch-case-material');
errorUpdateWatchCaseDiameter = document.getElementById('error-update-watch-case-diameter');
errorUpdateWatchCaseThickness = document.getElementById('error-update-watch-case-thickness');
errorUpdateWatchStrapMaterial = document.getElementById('error-update-watch-strap-material');
errorUpdateWatchDialColor = document.getElementById('error-update-watch-dial-color');
errorUpdateWatchCrystalMaterial = document.getElementById('error-update-watch-crystal-material');
errorUpdateWatchWaterResistance = document.getElementById('error-update-watch-water-resistance');
errorUpdateWatchMovementType = document.getElementById('error-update-watch-movement-type');
errorUpdateWatchPowerReserve = document.getElementById('error-update-watch-power-reserve');
errorUpdateWatchComplications = document.getElementById('error-update-watch-complications');

// Get the button element
buttonUpdateWatch = document.getElementById('button-update-watch');

// Add event listeners for the input update watch model elements
inputUpdateWatchModel.addEventListener('input', function () {
    var inputValue = inputUpdateWatchModel.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchModel.textContent = 'Model cannot contain special characters';
    } else {
        errorUpdateWatchModel.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch collection elements
inputUpdateWatchCollection.addEventListener('input', function () {
    var inputValue = inputUpdateWatchCollection.value;
    // Perform validation or error checking on the entered value
    if (inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCollection.textContent = 'Please select a collection';
    } else {
        errorUpdateWatchCollection.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch price elements
inputUpdateWatchOriginalPrice.addEventListener('input', function () {
    var inputValue = inputUpdateWatchOriginalPrice.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchOriginalPrice.textContent = 'Original price must be a number';
    } else {
        errorUpdateWatchOriginalPrice.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch stock elements
inputUpdateWatchSellingPrice.addEventListener('input', function () {
    var inputValue = inputUpdateWatchSellingPrice.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchSellingPrice.textContent = 'Selling price must be a number';
    } else {
        errorUpdateWatchSellingPrice.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch discount elements
inputUpdateWatchDiscount.addEventListener('input', function () {
    var inputValue = inputUpdateWatchDiscount.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue > 100) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchDiscount.textContent = 'Discount must be a number and less than 100';
    } else {
        errorUpdateWatchDiscount.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch case material elements
inputUpdateWatchCaseMaterial.addEventListener('input', function () {
    var inputValue = inputUpdateWatchCaseMaterial.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCaseMaterial.textContent = 'Case material cannot contain special characters';
    } else {
        errorUpdateWatchCaseMaterial.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch case diameter elements
inputUpdateWatchCaseDiameter.addEventListener('input', function () {
    var inputValue = inputUpdateWatchCaseDiameter.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCaseDiameter.textContent = 'Case diameter must be a number';
    } else {
        errorUpdateWatchCaseDiameter.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch case thickness elements
inputUpdateWatchCaseThickness.addEventListener('input', function () {
    var inputValue = inputUpdateWatchCaseThickness.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCaseThickness.textContent = 'Case thickness must be a number';
    } else {
        errorUpdateWatchCaseThickness.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch strap material elements
inputUpdateWatchStrapMaterial.addEventListener('input', function () {
    var inputValue = inputUpdateWatchStrapMaterial.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchStrapMaterial.textContent = 'Strap material cannot contain special characters';
    } else {
        errorUpdateWatchStrapMaterial.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch dial color elements
inputUpdateWatchDialColor.addEventListener('input', function () {
    var inputValue = inputUpdateWatchDialColor.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchDialColor.textContent = 'Dial color cannot contain special characters';
    } else {
        errorUpdateWatchDialColor.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch crystal material elements
inputUpdateWatchCrystalMaterial.addEventListener('input', function () {
    var inputValue = inputUpdateWatchCrystalMaterial.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCrystalMaterial.textContent = 'Crystal material cannot contain special characters';
    } else {
        errorUpdateWatchCrystalMaterial.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch water resistance elements
inputUpdateWatchWaterResistance.addEventListener('input', function () {
    var inputValue = inputUpdateWatchWaterResistance.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchWaterResistance.textContent = 'Water resistance must be a number';
    } else {
        errorUpdateWatchWaterResistance.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch movement type elements
inputUpdateWatchMovementType.addEventListener('input', function () {
    var inputValue = inputUpdateWatchMovementType.value;
    // Perform validation or error checking on the entered value
    if (inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchMovementType.textContent = 'Please select a movement type';
    } else {
        errorUpdateWatchMovementType.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch power reserve elements
inputUpdateWatchPowerReserve.addEventListener('input', function () {
    var inputValue = inputUpdateWatchPowerReserve.value;
    // Perform validation or error checking on the entered value
    if (!regex.test(inputValue) || inputValue == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchPowerReserve.textContent = 'Power reserve must be a number';
    } else {
        errorUpdateWatchPowerReserve.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

// Add event listeners for the input update watch complications elements
inputUpdateWatchComplications.addEventListener('input', function () {
    var inputValue = inputUpdateWatchComplications.value;
    // Perform validation or error checking on the entered value
    if (format.test(inputValue)) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchComplications.textContent = 'Complications cannot contain special characters';
    } else {
        errorUpdateWatchComplications.textContent = ''; // Clear any previous error message
        AddDataBSDismissOfUpdateButton();
    }
});

function updateWatch(id) {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    // GET A WATCH AJAX
    const path = '/api/watches/' + id;
    $.ajax({
        url: path,
        type: 'GET',
        success: function (response) {
            $('.overlay').remove()
            inputUpdateWatchModel.value = response.watch.model;
            inputUpdateWatchCollection.value = response.watch.collection_id;
            inputUpdateWatchOriginalPrice.value = response.watch.original_price;
            inputUpdateWatchSellingPrice.value = response.watch.selling_price;
            inputUpdateWatchDiscount.value = response.watch.discount;
            const gender = response.watch.gender;
            for (var i = 0; i < inputUpdateWatchGender.length; i++) {
                if (inputUpdateWatchGender[i].value == gender) {
                    inputUpdateWatchGender[i].checked = true;
                    break;
                }
            }
            inputUpdateWatchCaseMaterial.value = response.watch.case_material;
            inputUpdateWatchCaseDiameter.value = response.watch.case_diameter;
            inputUpdateWatchCaseThickness.value = response.watch.case_thickness;
            inputUpdateWatchStrapMaterial.value = response.watch.strap_material;
            inputUpdateWatchDialColor.value = response.watch.dial_color;
            inputUpdateWatchCrystalMaterial.value = response.watch.crystal_material;
            inputUpdateWatchWaterResistance.value = response.watch.water_resistance;
            inputUpdateWatchMovementType.value = response.watch.movement_type;
            inputUpdateWatchPowerReserve.value = response.watch.power_reserve;
            inputUpdateWatchComplications.value = response.watch.complications;
            const status = response.watch.availability;
            if (status) {
                inputUpdateWatchAvailability[0].checked = true;
            } else {
                inputUpdateWatchAvailability[1].checked = true;
            }
            buttonUpdateWatch.setAttribute('data-bs-dismiss', 'modal');
            buttonUpdateWatch.setAttribute('onclick', 'updateWatchSubmit(' + id + ')');
        },
        error: function (error) {
            $('.overlay').remove()
            console.error(error);
        }
    })
}

function updateWatchSubmit(id) {
    if (inputUpdateWatchModel.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchModel.textContent = 'Please enter a model';
        return;
    }
    if (inputUpdateWatchCollection.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCollection.textContent = 'Please select a collection';
        return;
    }
    if (inputUpdateWatchOriginalPrice.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchOriginalPrice.textContent = 'Please enter an original price';
        return;
    }
    if (inputUpdateWatchSellingPrice.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchSellingPrice.textContent = 'Please enter a selling price';
        return;
    }
    if (inputUpdateWatchDiscount.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchDiscount.textContent = 'Please enter a discount';
        return;
    }
    if (inputUpdateWatchCaseMaterial.value == '') {
        RemoveDataBSDismissOfAddButton();
        errorUpdateWatchCaseMaterial.textContent = 'Please enter a case material';
        return;
    }
    if (inputUpdateWatchCaseDiameter.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCaseDiameter.textContent = 'Please enter a case diameter';
        return;
    }
    if (inputUpdateWatchCaseThickness.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCaseThickness.textContent = 'Please enter a case thickness';
        return;
    }
    if (inputUpdateWatchStrapMaterial.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchStrapMaterial.textContent = 'Please enter a strap material';
        return;
    }
    if (inputUpdateWatchDialColor.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchDialColor.textContent = 'Please enter a dial color';
        return;
    }
    if (inputUpdateWatchCrystalMaterial.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchCrystalMaterial.textContent = 'Please enter a crystal material';
        return;
    }
    if (inputUpdateWatchWaterResistance.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchWaterResistance.textContent = 'Please enter a water resistance';
        return;
    }
    if (inputUpdateWatchMovementType.value == 0) {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchMovementType.textContent = 'Please select a movement type';
        return;
    }
    if (inputUpdateWatchPowerReserve.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchPowerReserve.textContent = 'Please enter a power reserve';
        return;
    }
    if (inputUpdateWatchComplications.value == '') {
        RemoveDataBSDismissOfUpdateButton();
        errorUpdateWatchComplications.textContent = 'Please enter a complications';
        return;
    }
    // Valid error checking
    if (errorUpdateWatchModel.textContent != '' || errorUpdateWatchCollection.textContent != '' || errorUpdateWatchOriginalPrice.textContent != '' || errorUpdateWatchSellingPrice.textContent != '' || errorUpdateWatchDiscount.textContent != '' || errorUpdateWatchGender.textContent != '' || errorUpdateWatchCaseMaterial.textContent != '' || errorUpdateWatchCaseDiameter.textContent != '' || errorUpdateWatchCaseThickness.textContent != '' || errorUpdateWatchStrapMaterial.textContent != '' || errorUpdateWatchDialColor.textContent != '' || errorUpdateWatchCrystalMaterial.textContent != '' || errorUpdateWatchWaterResistance.textContent != '' || errorUpdateWatchMovementType.textContent != '' || errorUpdateWatchPowerReserve.textContent != '' || errorUpdateWatchComplications.textContent != '') {
        RemoveDataBSDismissOfUpdateButton();
        return;
    }
    // If all validation has passed, submit the form
    let gender = ''
    for (var i = 0; i < inputUpdateWatchGender.length; i++) {
        if (inputUpdateWatchGender[i].checked) {
            gender = inputUpdateWatchGender[i].value
            break;
        }
    }
    let status = ''
    for (var i = 0; i < inputUpdateWatchAvailability.length; i++) {
        if (inputUpdateWatchAvailability[i].checked) {
            status = inputUpdateWatchAvailability[i].value
            break;
        }
    }
    const data = {
        'model': inputUpdateWatchModel.value,
        'original_price': inputUpdateWatchOriginalPrice.value,
        'selling_price': inputUpdateWatchSellingPrice.value,
        'discount': inputUpdateWatchDiscount.value,
        'gender': gender,
        'case_material': inputUpdateWatchCaseMaterial.value,
        'case_diameter': inputUpdateWatchCaseDiameter.value,
        'case_thickness': inputUpdateWatchCaseThickness.value,
        'strap_material': inputUpdateWatchStrapMaterial.value,
        'dial_color': inputUpdateWatchDialColor.value,
        'crystal_material': inputUpdateWatchCrystalMaterial.value,
        'water_resistance': inputUpdateWatchWaterResistance.value,
        'movement_type': inputUpdateWatchMovementType.value,
        'power_reserve': inputUpdateWatchPowerReserve.value,
        'complications': inputUpdateWatchComplications.value,
        'availability': status,
        'collection_id': inputUpdateWatchCollection.value
    }
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/watches/' + id,
        type: 'PUT',
        data: data,
        success: function (response) {
            $('.overlay').remove()
            Swal.fire({
                'icon': 'success',
                'title': 'Update watch successfully',
                'showConfirmButton': false,
                'timer': 2000
            })
            let status = ''
            if (response.watch.availability == 1) {
                status = 'Still In Business'
            } else {
                status = 'Business Suspension'
            }
            const watch = document.getElementById('watch_' + response.watch.id);
            watch.innerHTML = `
                <td>${response.watch.model}</td>
                <td>$${response.watch.original_price}</td>
                <td>$${response.watch.selling_price}</td>
                <td>${response.watch.discount}%</td>
                <td>${response.watch.gender}</td>
                <td>${response.watch.case_material}</td>
                <td>${response.watch.case_diameter}mm</td>
                <td>${response.watch.case_thickness}mm</td>
                <td>${response.watch.strap_material}</td>
                <td>${response.watch.dial_color}</td>
                <td>${response.watch.crystal_material}</td>
                <td>${response.watch.water_resistance}m</td>
                <td>${response.watch.movement_type}</td>
                <td>${response.watch.power_reserve} hours</td>
                <td>${response.watch.complications}</td>
                <td>${response.watch.collection_name}</td>
                <td>${status}</td>
                <td>
                    <a href="/admin/watch/${response.watch.id}/image">View</a>
                </td>
                <td>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" onclick="updateWatch(${response.watch.id})" data-bs-target="#updateWatchModal">
                        Edit
                    </button>
                    <button class="btn btn-danger mt-2" type="button" onclick="deleteWatch(${response.watch.id})">
                        Delete
                    </button>
                </td>
            `;

            //clear input fields
            inputUpdateWatchModel.value = '';
            inputUpdateWatchCollection.value = 0;
            inputUpdateWatchOriginalPrice.value = '';
            inputUpdateWatchSellingPrice.value = '';
            inputUpdateWatchDiscount.value = '';
            inputUpdateWatchGender.value = '';
            inputUpdateWatchCaseMaterial.value = '';
            inputUpdateWatchCaseDiameter.value = '';
            inputUpdateWatchCaseThickness.value = '';
            inputUpdateWatchStrapMaterial.value = '';
            inputUpdateWatchDialColor.value = '';
            inputUpdateWatchCrystalMaterial.value = '';
            inputUpdateWatchWaterResistance.value = '';
            inputUpdateWatchMovementType.value = 0;
            inputUpdateWatchPowerReserve.value = '';
            inputUpdateWatchComplications.value = '';
            RemoveDataBSDismissOfUpdateButton();
        },
        error: function (error) {
            $('.overlay').remove()
            console.log(error);
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

// Change data bs dismiss of update button when input update watch collection is changed
function AddDataBSDismissOfUpdateButton() {
    if (!buttonUpdateWatch.hasAttribute('data-bs-dismiss')
        && errorUpdateWatchModel.textContent == '' && errorUpdateWatchCollection.textContent == '' && errorUpdateWatchOriginalPrice.textContent == '' && errorUpdateWatchSellingPrice.textContent == '' && errorUpdateWatchDiscount.textContent == '' && errorUpdateWatchGender.textContent == '' && errorUpdateWatchCaseMaterial.textContent == '' && errorUpdateWatchCaseDiameter.textContent == '' && errorUpdateWatchCaseThickness.textContent == '' && errorUpdateWatchStrapMaterial.textContent == '' && errorUpdateWatchDialColor.textContent == '' && errorUpdateWatchCrystalMaterial.textContent == '' && errorUpdateWatchWaterResistance.textContent == '' && errorUpdateWatchMovementType.textContent == '' && errorUpdateWatchPowerReserve.textContent == '' && errorUpdateWatchComplications.textContent == ''
        && inputUpdateWatchModel.value != '' && inputUpdateWatchCollection.value != 0 && inputUpdateWatchOriginalPrice.value != '' && inputUpdateWatchSellingPrice.value != '' && inputUpdateWatchDiscount.value != '' && inputUpdateWatchGender.value != '' && inputUpdateWatchCaseMaterial.value != '' && inputUpdateWatchCaseDiameter.value != '' && inputUpdateWatchCaseThickness.value != '' && inputUpdateWatchStrapMaterial.value != '' && inputUpdateWatchDialColor.value != '' && inputUpdateWatchCrystalMaterial.value != '' && inputUpdateWatchWaterResistance.value != '' && inputUpdateWatchMovementType.value != 0 && inputUpdateWatchPowerReserve.value != '' && inputUpdateWatchComplications.value != '') {
        buttonUpdateWatch.setAttribute('data-bs-dismiss', 'modal')
    }
}

function RemoveDataBSDismissOfUpdateButton() {
    if (buttonUpdateWatch.hasAttribute('data-bs-dismiss')) {
        buttonUpdateWatch.removeAttribute('data-bs-dismiss')
    }
}

// DELETE WATCH
// =====================================================================================================================
function deleteWatch(id) {
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
        'text': 'This watch will be deleted',
        'showCancelButton': true,
        'confirmButtonText': 'Yes, delete it',
        'cancelButtonText': 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
            // DELETE A CATEGORY AJAX
            const path = '/api/watches/' + id;
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

                    var el = document.getElementById('watch_' + id)
                    $(el)
                        .closest('#watch_' + id)
                        .css('background', '#f27474')
                        .closest('#watch_' + id)
                        .fadeOut(800, function () {
                            $('#watch_' + id).remove()
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