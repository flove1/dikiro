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
