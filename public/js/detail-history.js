const feedbackUserId = document.getElementById('feedback-user-id');
const feedbackWatchId = document.getElementById('feedback-watch-id');
const ratingInput = document.getElementsByName("rating");
const commentInput = document.getElementById("comment");

function feedback(id) {
    feedbackWatchId.value = id;
}

function submitFeedback() {
    var userId = feedbackUserId.value;
    var watchId = feedbackWatchId.value;
    var comment = commentInput.value;
    var rating = "";
    for (var i = 0; i < ratingInput.length; i++) {
        if (ratingInput[i].checked) {
            rating = ratingInput[i].value;
            break;
        }
    }

    const formData = new FormData();
    formData.append("user_id", userId);
    formData.append("watch_id", watchId);
    formData.append("rating", rating);
    formData.append("comment", comment);
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: "/api/reviews",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('.overlay').remove()
            Swal.fire({
                'icon': 'success',
                'title': 'Update status successfully',
                'showConfirmButton': false,
                'timer': 2000
            }).then(() => {
                location.reload();
            })
        },
        error: function (error) {
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
