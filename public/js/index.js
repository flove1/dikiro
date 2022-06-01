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
fetch("/api/count?" + new URLSearchParams({
    tags: JSON.stringify(searchTags)
}))
    .then(response => response.json())
    .then(count => {
        for(let i=1; i<=Math.ceil(count/20); i++) {
            console.log((i-1)*20, count-(i-1)*20>20?20:count-(i-1)*20);
            $("#btn-page-container").append(
                `<button class="btn btn-page px-3" onclick="showItems(this, ${(i-1)*20}, ${count-(i-1)*20>20?20:count-(i-1)*20})">${i}</button>`);
        }
        showItems($("#btn-page-container button")[0], 0, Math.min(20, count));
    });
$(".search-tags .tag").click(function () {
   if ($(this).hasClass("tag-active")) {
       searchTags.splice(searchTags.indexOf($(this).text()), 1);
       $(this).removeClass("tag-active");
   }
   else {
       searchTags.push($(this).text());
       $(this).addClass("tag-active");
   }
    fetch("/api/count?" + new URLSearchParams({
        tags: JSON.stringify(searchTags)
    }))
        .then(response => response.json())
        .then(count => {
            $("#btn-page-container").empty();
            for(let i=1; i<=Math.ceil(count/20); i++) {
                $("#btn-page-container").append(
                    `<button class="btn btn-page px-3" onclick="showItems(this, ${(i-1)*20}, ${count-(i-1)*20>20?20:count-(i-1)*20})">${i}</button>`);
            }
            showItems($("#btn-page-container button")[0], 0, Math.min(20, count));
        });
});


function showItems(element, from, count) {
    fetch(`/api/items/${from}/${count}?` + new URLSearchParams({
        tags: JSON.stringify(searchTags)
    }))
        .then(response => response.json())
        .then(items => {
            $("#search-list").empty();
            for (let i=from; i<from+count; i++) {
                fetch(`/api/tags/${items[i].id}`)
                    .then(response => response.json())
                    .then(tags => {
                        for (let i=0; i<tags.length; i++) {
                            $(`#item-${tags[i].item_id} .tag-container`).append(`<div class="tag tag-active">${tags[i].tag}</div>`);
                        }
                    });
                $("#search-list").append(
                    `<div id="item-${items[i].id}" class="item col-11 col-md-3 p-4 d-flex flex-column justify-content-between" onClick="showDesc(${items[i].id})">\
                        <img src="${items[i].img_path}" class="rounded">\
                            <div class="container">\
                            <div class="item-title">${items[i].name}</div>\
                            <div class="tag-container gap-2 mb-3 row"></div>\
                            <div class="text-center fs-4"><b>${items[i].price}</b> kzt</div>\
                            </div>
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

$("#desc-modal form").submit(function () {
    $("#desc form button").attr('disabled', 'true').text('Saved');
    setTimeout(function () {
        $("#desc form #cart-item-count").attr("type", "hidden").val("");
    }, 100);
});

function showCart() {
    cartModal.show();
    fetch('/cart')
        .then(response => response.json())
        .then(response => {
            $("#cart-container").empty();
            $("#sum").text('0');
            for (let i=0; i<response.length; i++) {
                $("#cart-container").append(
                    `<div id="cart-${response[i].id}" class="cart-item row px-3 py-4">\
                    <div class="col-3">\
                        <img src="${response[i].item.img_path}" class="rounded"\
                             style="transform: translateY(-50%); position: relative; top: 50%"/>\
                    </div>\
                    <div class="col gx-5 align-items-center d-flex">\
                        <div class="row flex-fill">\
                            <div class="col-6 fs-2 my-auto">${response[i].item.name}</div>\
                            <div class="col my-auto text-end text-nowrap">\
                                <span class="fs-4 text-end fw-bold">${response[i].item.price}</span>\
                                <span class="fs-5 text-end "> kzt</span>\
                                <span class="fs-4 text-end "> * </span>\
                                <span class="fs-4 text-end fw-bold">${response[i].count}</span>\
                                <span class="fs-5 text-end "> pcs = </span>\
                                <span class="fs-4 text-end fw-bold"> ${response[i].item.price * response[i].count}</span>\
                                <span class="fs-5 text-end "> kzt</span>\
                            </div>\
                            <button class="col btn btn-outline-danger rounded ms-2 fs-2" onclick="deleteCart(${response[i].id}, ${response[i].item.price * response[i].count})">X</button>\

                        </div>\
                    </div>\
                </div>`);
                $("#sum").text(parseInt($("#sum").text()) + response[i].item.price * response[i].count);
            }
        });
}

function deleteCart(id, sum) {
    // let data = new FormData($(this)[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: `/cart/${id}`,
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data'
    }).done(function () {
        $("#sum").text(parseInt($("#sum").text()) - sum);
        $(`#cart-${id}`).remove()
    });
}

function showDesc(id) {
    fetch(`/api/items/${id}`)
        .then(response => response.json())
        .then(item => {
            $("#cart-item-id").val(id);
            $("#desc-title").text(item.name);
            $("#desc-text").text(item.desc);
            $("#desc-price").text(item.price);
            $("#desc-count").text(item.count);
            $("#desc-image img").attr("src", item.img_path);
            $("#desc-tags").html($(`#item-${id} .tag-container`).html());
            $("#desc-images").empty();
            $("#desc-comments").empty();
            $("#desc form button").removeAttr('disabled').text('Add to cart');
            $("#desc form #cart-item-count").attr("type", "text");
            $("#comment-id").val(id);
            fetch(`/api/comments/${id}`)
                .then(response => response.json())
                .then(comments => {
                    for (let i=0; i < comments.length; i++) {
                        $("#desc-comments").append(`\
                <div class="desc-comment-container container-fluid row py-4 mx-auto rounded">\
                    <img class="profile-image rounded-circle" style="padding: 0" src="${comments[i].img_path}">\
                    <div class="col">\
                        <div class="desc-comment-name fs-4">${comments[i].name}</div>\
                        <div class="desc-comment-date fs-5">${comments[i].date}</div>\
                        <p class="desc-comment fs-5">${comments[i].comment}</p>\
                    </div>\
                </div>`)
                    }
                    if (comments.length == 0) {
                        $("#desc-comments").html('<div class="desc-comment-container container-fluid py-4 mx-auto"> <p class="text-center fs-3 m-0">No comments</p></div>');
                    }
                });
            descModal.show();
        });
}
