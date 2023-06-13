// Update profile
$(document).ready(function () {
    $('#update-profile-form').submit(function (e) {
        e.preventDefault();
        var phone_pattern = /^(\(0\d{1,3}\)\d{7})|(0\d{9})$/;
        // get input values
        const firstNameInput = document.getElementById("first-name");
        const lastNameInput = document.getElementById("last-name");
        const genderInput = document.getElementsByName("gender");
        const birthdayInput = document.getElementById("birthday");
        const telephoneInput = document.getElementById("telephone");
        const addressInput = document.getElementById("address");
        const profileError = document.getElementById("profile-error");
        profileError.textContent = "";

        const firstName = firstNameInput.value;
        const lastName = lastNameInput.value;
        console.log(genderInput)
        var gender = "";
        for (var i = 0; i < genderInput.length; i++) {
            if (genderInput[i].checked) {
                gender = genderInput[i].value;
                break;
            }
        }
        const birthday = birthdayInput.value;
        const telephone = telephoneInput.value;
        const address = addressInput.value;

        // Validate input fields
        if (!firstName || !lastName || !birthday || !telephone || !address) {
            profileError.classList.add("alert", "alert-danger", "fw-bold", "text-center");
            profileError.textContent = "Please fill in all fields.";
            return;
        }

        // Validate gender
        if (gender == "") {
            profileError.classList.add("alert", "alert-danger", "fw-bold", "text-center");
            profileError.textContent = "Please choose your gender.";
            return;
        }

        // Validate telephone
        if (phone_pattern.test(telephone) == false) {
            profileError.classList.add("alert", "alert-danger", "fw-bold", "text-center");
            profileError.textContent = "Invalid telephone.";
            return;
        }

        // Validate birthday
        var today = new Date();
        var birthDate = new Date(birthday);
        var age = today.getFullYear() - birthDate.getFullYear();
        var month = today.getMonth() - birthDate.getMonth();
        if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (age < 12) {
            profileError.classList.add("alert", "alert-danger", "fw-bold", "text-center");
            profileError.textContent = "You must be at least 12 years old.";
            return;
        }

        profileError.removeAttribute("class");
        $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
        const formData = new FormData(this);
        $.ajax({
            url: '/user/profile/edit',
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
                }).then(function () {
                    window.location.href = '/user/profile';
                });
            },
            error: function (err) {
                $('.overlay').remove()
                console.log(err);
                Swal.fire({
                    'icon': 'error',
                    'title': 'Oops...',
                    'text': err.responseJSON.message
                });
            }
        });
    });
});

// Change password
$(document).ready(function () {
    $('#change-password-form').submit(function (e) {
        e.preventDefault();

        const currentPasswordInput = document.getElementById("current-password");
        const newPasswordInput = document.getElementById("new-password");
        const reNewPasswordInput = document.getElementById("re-new-password");
        const changePasswordError = document.getElementById("change-password-error");
        changePasswordError.textContent = "";

        const currentPassword = currentPasswordInput.value;
        const newPassword = newPasswordInput.value;
        const reNewPassword = reNewPasswordInput.value;

        // Validate input fields
        if (!currentPassword || !newPassword || !reNewPassword) {
            changePasswordError.classList.add("alert", "alert-danger", "fw-bold", "text-center");
            changePasswordError.textContent = "Please fill in all fields.";
            return;
        }

        // Validate new password
        if (newPassword.length < 8) {
            changePasswordError.classList.add("alert", "alert-danger", "fw-bold", "text-center");
            changePasswordError.textContent = "Password must be at least 8 characters.";
            return;
        }

        // Validate re-new password
        if (newPassword != reNewPassword) {
            changePasswordError.classList.add("alert", "alert-danger", "fw-bold", "text-center");
            changePasswordError.textContent = "Re-entered password does not match.";
            return;
        }

        changePasswordError.removeAttribute("class");
        $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
        const formData = new FormData(this);
        $.ajax({
            url: '/user/profile/edit/password',
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
                }).then(function () {
                    window.location.href = '/user/profile';
                });
            },
            error: function (err) {
                $('.overlay').remove()
                console.log(err);
                Swal.fire({
                    'icon': 'warning',
                    'title': 'Oops..',
                    'text': err.responseJSON.message
                });
            }
        });
    });
});