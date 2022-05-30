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
        });

    descModal.show();
}
