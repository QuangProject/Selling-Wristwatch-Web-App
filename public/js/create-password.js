// Create new password
$(document).ready(function () {
    $('#create-password-form').submit(function (e) {
        e.preventDefault();
        var password = $('#password').val();
        var confirmPassword = $('#confirm-password').val();

        if (password == '') {
            $('#password').focus();
            $('#password-error').attr('class', 'alert alert-danger fw-bold text-center').html('Password is required');
            return;
        }
        if (password.length < 8) {
            $('#password').focus();
            $('#password-error').attr('class', 'alert alert-danger fw-bold text-center').html('Password must be at least 8 characters');
            return;
        }
        if (confirmPassword == '') {
            $('#confirm-password').focus();
            $('#password-error').attr('class', 'alert alert-danger fw-bold text-center').html('Confirm password is required');
            return;
        }
        if (password != confirmPassword) {
            // $('#password').val('');
            // $('#confirm-password').val('');
            $('#password').focus();
            $('#password-error').attr('class', 'alert alert-danger fw-bold text-center').html('Password and confirm password do not match');
            return;
        }
        const formData = new FormData(this);
        $.ajax({
            url: '/user/create-password/save',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                Swal.fire({
                    'icon': 'success',
                    'title': response.message,
                    'showConfirmButton': false,
                    'timer': 2000
                }).then(function () {
                    window.location.href = '/';
                });
            },
            error: function (err) {
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