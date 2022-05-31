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

searchTags = [];
$(".search-tags .tag").click(function () {
   if ($(this).hasClass("tag-active")) {
       searchTags.splice(searchTags.findIndex($(this).text), 1);
       $(this).removeClass("tag-active");
   }
   else {
       searchTags.push($(this).text());
       $(this).addClass("tag-active");
   }
});


function showItems(element, from, count) {
    fetch(`/api/items/${from}/${count}?` + new URLSearchParams({
        tags: JSON.stringify(searchTags)
    }))
        .then(response => response.json())
        .then(items => {
            $("#search-list").empty();
            for (let i=0; i<items.length; i++) {
                fetch(`/api/tags/${items[i].id}`)
                    .then(response => response.json())
                    .then(tags => {
                        for (let i=0; i<tags.length; i++) {
                            $(`#item-${tags[i].item_id} .tag-container`).append(`<div class="tag tag-active">${tags[i].tag}</div>`);
                        }
                    });
                $("#search-list").append(
                    `<div id="item-${items[i].id}" class="item col-11 col-md-3 p-4" onClick="showDesc(${items[i].id})">\
                        <img src="${items[i].img_path}" class="rounded">\
                            <div class="item-title">${items[i].name}</div>\
                            <div class="tag-container gap-2 mb-3">\
                            </div>\
                    </div>`);
            }
        });
    $("#btn-page-container button").each(function() {
        $(this).removeClass("selected");
    });
    $(element).addClass("selected");
}

let descModal = new window.bootstrap.Modal(document.getElementById('desc-modal'), 'data-bs-focus=""');

let cartModal = new window.bootstrap.Modal(document.getElementById('cart-modal'), 'data-bs-focus=""');

function showCart() {
    cartModal.show();
}

function showDesc(id) {
    fetch(`/api/items/${id}`)
        .then(response => response.json())
        .then(item => {
            $("#desc-title").text(item.name);
            $("#desc-text").text(item.desc);
            $("#desc-price").text(item.price);
            $("#desc-count").text(item.count);
            $("#desc-image img").attr("src", item.img_path);
            $("#desc-images").empty();
            $("#desc-comments").empty();
            fetch(`/api/comments/${id}`)
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
                    if (comments.length == 0) {
                        $("#desc-comments").html('<div class="desc-comment-container container-fluid py-4 mx-auto"> <p class="text-center fs-3 m-0">No comments</p></div>');
                    }
                });
            descModal.show();
        });
}

// $(".search-tags .tag").click(function() {
//     if ($(this).hasClass("tag-active")) {
//         $(this).removeClass("tag-active");
//     }
//     else {
//         $(this).addClass("tag-active");
//     }
// });


$(".btn-page")[0].click();
