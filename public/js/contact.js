$('#frmSendContact').submit(function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    for (const [key, value] of formData) {
        if (value === "") {
            Swal.fire(
                'The Warning',
                'Please do not leave any fields blank',
                'warning'
            )
            return
        }
    }
    $.ajax({
        url: 'api/contacts',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 2000
            })
            $('#frmSendContact')[0].reset();
        },
        error: function (err) {
            console.error(err);
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: err.responseJSON.message,
                showConfirmButton: false,
                timer: 2000
            })
        }
    });
});