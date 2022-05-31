$("#img-container").click(function() {
    $("#img-select").get(0).click();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result).css("display", "block");
            $("#img-container p").css("display", "none");
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$("#new-game-form").submit(function (event) {
    event.preventDefault();
    let data = new FormData($(this)[0]);
    let tagsArray = [];
    $(".tag-active").each(function() {
        tagsArray.push($(this).text())
    });
    data.append("tags", JSON.stringify(tagsArray));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/items",
        processData: false,
        contentType: false,
        data: data,
        enctype: 'multipart/form-data'
    }).done(function() {
        window.location.replace("/vendor");
    })
});

$(".tag").each(function() {
    $(this).click(function() {
        if ($(this).hasClass("tag-active")) {
            $(this).removeClass("tag-active");
        }
        else {
            $(this).addClass("tag-active");
        }
    });
});
