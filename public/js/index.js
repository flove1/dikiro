if ($('#desc-toggle-comments').is(':checked')) {
  $('#comments-dialog').removeAttr("hidden");
}
else {
  $('#comments-dialog').attr("hidden", "true");
}

$('#desc-toggle-comments').change(function() {
  if (this.checked) {
    $('#comments-dialog').removeAttr("hidden");
  }
  else {
    $('#comments-dialog').attr("hidden", "true");
  }
});

let descModal = new window.bootstrap.Modal(document.getElementsByClassName("modal").item(0), 'data-bs-focus=""');

function showDesc(item) {
  let object = JSON.parse(item);
  $("#desc-title").text(object.name);
  $("#desc-text").text(object.desc);
  $("#desc-price").text(object.price);
  $("#desc-count").text(object.count);
  $("#desc-image img").attr("src", object.img_path);
  $("#desc-images").empty();
  $("#desc-images").append('<img class="active" src="' + object.img_path + '" alt="">');
  $("#desc-images").append('<img src="' + object.img_path + '" alt="">');
  $("#desc-images").append('<img src="' + object.img_path + '" alt="">');
  $("#desc-images").append('<img src="' + object.img_path + '" alt="">');
  $("#desc-images").append('<img src="' + object.img_path + '" alt="">');
  $("#desc-images").append('<img src="' + object.img_path + '" alt="">');
  $("#desc-images").append('<img src="' + object.img_path + '" alt="">');

  $("#desc-comments").empty();

  fetch("/api/comments/" + object.id)
    .then(response => response.json())
    .then(comments => {
        for (let i=0; i < comments.length; i++) {
            $("#desc-comments").append('\
                <div class="desc-comment-container container-fluid row py-4 mx-auto">\
                    <div class="profile-image col-1 rounded-circle"></div>\
                    <div class="col">\
                        <div class="desc-comment-name fs-4">' + comments[i].name + '</div>\
                        <div class="desc-comment-date fs-5">' + comments[i].date + '</div>\
                        <p class="desc-comment fs-5">' + comments[i].comment + '</p>\
                    </div>\
                </div>')
        }
    });

  $("#desc-images img").click(function() {
    if (!$(this).hasClass("active")) {
      $("#desc-images img.active").removeClass("active");
      $(this).addClass("active");
      $("#desc-image img").css("filter", "brightness(30%)");
      let descImagePath = $(this).attr("src");
      setTimeout(function() {
        $("#desc-image img").attr("src", descImagePath);
        $("#desc-image img").css("filter", "brightness(100%)");
      }, 300);
    }
  });

  descModal.show();
}

$("#search-tags .tag").click(function() {
    if ($(this).hasClass("tag-active")) {
        $(this).removeClass("tag-active");
    }
    else {
        $(this).addClass("tag-active");
    }
});
