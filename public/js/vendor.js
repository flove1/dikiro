let descModal = new window.bootstrap.Modal(document.getElementsByClassName("modal").item(0), 'data-bs-focus=""');

function showComments(id) {
    $("#desc-comments").empty();

    fetch("/api/comments/" + id)
        .then(response => response.json())
        .then(comments => {
            for (let i=0; i < comments.length; i++) {
                $("#desc-comments").append('\
                <div class="desc-comment-container container-fluid row py-4 mx-auto">\
                    <div class="profile-image col-1 rounded-circle"></div>\
                    <div class="col">\
                        <div class="desc-comment-name fs-4">' + comments[i].name + " | " + comments[i].id + '</div>\
                        <div class="desc-comment-date fs-5">' + comments[i].date + '</div>\
                        <p class="desc-comment fs-5">' + comments[i].comment + '</p>\
                    </div>\
                </div>')
            }
            if (comments.length == 0) {
                $("#desc-comments").html('<div class="desc-comment-container container-fluid py-4 mx-auto"> <p class="text-center fs-3 m-0">No comments</p></div>');
            }
        });

    descModal.show();
}

$('form').submit(function () {
    form = $(this);
    setTimeout(function() {
        $(form).closest('.item').remove()
    }, 100);
})
