$(document).ready(function () {
    // #login-box password field
    $("#passwordShow").on("click", function () {
        if ($("#inputChoosePassword").attr("type") === "password") {
            $("#inputChoosePassword").attr("type", "text");
        } else {
            $("#inputChoosePassword").attr("type", "password");
        }
    });
});

$(document).ready(function () {
    // #login-box password field
    $(".wishlistButton").on("click", function () {
        // a tag data id attribute value
        var productId = $(this).data("id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/wishlist",
            data: {
                id: productId,
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: response.success,
                        showConfirmButton: !1,
                        timer: 2000,
                    });
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 2000);
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: response.error,
                        showConfirmButton: !1,
                        timer: 2000,
                    });
                }
            }
        });
    });
});


