// Custom Image Upload Live Preview Start
$("#input_image").change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
        $("#input_image_preview").attr("src", e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
});

$("#input_image_2").change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
        $("#input_image_preview_2").attr("src", e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
});

$("#input_image_3").change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
        $("#input_image_preview_3").attr("src", e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
});

// GET COURIER VALUE TO ZONE CREATE MODAL
$(".courier").change(function () {
    var id = $(this).val();
    $.ajax({
        type: "GET",
        url: "/admin/courier-zone/get-city/" + id,
        dataType: "json",
        success: function (response) {
            $('select[id="city"]').empty();
            if (response.cities) {
                $.each(response.cities, function (key, value) {
                    $.each(value, function (key, city) {
                        $('select[id="city"]').append(
                            '<option value="' +
                            city.id +
                            '">' +
                            city.city_name +
                            "</option>"
                        );
                    });
                });
            } else {
                $('select[id="city"]').append(
                    '<option label="Not Found"></option>'
                );
            }
        },
    });
});

// Summernote Editor For Page Content Editor
$(document).ready(function () {
    // Page Content Editor
    $("#pageContent").summernote({
        placeholder: "Write You Content Here",
        tabsize: 2,
        height: 300,
        codeviewFilter: false,
        codeviewIframeFilter: true,
        focus: true,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "codeview", "help"]],
        ],
    });

    // Blog Post Form Editor
    $("#blogEditor").summernote({
        placeholder: "Here Write Your Content",
        tabsize: 2,
        height: 120,
        codeviewFilter: false,
        codeviewIframeFilter: true,
        focus: true,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "codeview", "help"]],
        ],
    });
});

// Data Table
$(document).ready(function () {
    // $("#datatable").DataTable();
    $("#datatable").DataTable({ ordering: false });
});

// $("#colorPicker-1").spectrum({
//     showInitial: !0,
//     showInput: !0
// })
// $("#colorPicker-2").spectrum({
//     showInitial: !0,
//     showInput: !0
// })

// Media Check All Delete Image
$(document).ready(function () {
    $(document).on("click", "#markDelete", function (e) {
        e.preventDefault();

        var ids = [];
        var rows_selected = $("input[name='ids[]']")
            .filter(":checked")
            .map(function (index, rowId) {
                ids[index] = rowId.value;
            });
        if (ids.length > 0) {
            if (confirm("Are You Sure To Delete This Data?")) {
                $.ajax({
                    url: "/admin/media/checkdelete",
                    type: "POST",
                    data: {
                        ids: ids,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (data) {
                        if (data.status == "success") {
                            window.location.reload();
                        } else {
                            alert("Delete Failed");
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    },
                });
            }
        } else {
            Swal.fire({
                icon: "warning",
                title: 'Please select at least one',
                showConfirmButton: 1,
                // timer: 4000,
            });
        }
    });
});


// STATIC BANNER IMAGE UPLOAD START
$(document).ready(function () {
    $("#static_banner_type").on("change", function () {
        var banner_type = $(this).val();
        if (banner_type == "header") {
            // Select Id Class Remove
            $("#static-banner-input-footer").addClass("d-none");
            $("#static-banner-input-header").removeClass("d-none");
        } else if (banner_type == "footer") {
            // Select Id Class Add
            $("#static-banner-input-header").addClass("d-none");
            $("#static-banner-input-footer").removeClass("d-none");
        } else {
            $("#static-banner-input-header").addClass("d-none");
            $("#static-banner-input-footer").addClass("d-none");
        }
    });
});
// STATIC BANNER IMAGE UPLOAD END



//  PERMISSION CHECKBOX SELECTED
$(document).ready(function () {
    $("#toggleCheckbox").click(function (e) {
        e.preventDefault();
        $(".form-check-input").prop("checked", !$(".form-check-input").prop("checked"));
    });
});

// Order Return input filed fill date
$(document).ready(function () {
    $(document).on("change", "#delivery_date", function (e) {
        e.preventDefault();
        var delivery_date = $(this).val();
        $.ajax({
            type: "POST",
            url: "/admin/order/order-return/get-quantity",
            data: {
                delivery_date: delivery_date,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.data) {
                    $("#totalDeliveryQuantity").attr("value", response.data);
                    // $("#totalDeliveryQuantity").val(response.data);
                    $("#returnOrderFormPage").removeClass("d-none");
                } else {
                    $("#totalDeliveryQuantity").val("");
                    $("#returnOrderFormPage").addClass("d-none");
                    Swal.fire({
                        icon: "warning",
                        title: response.message,
                        showConfirmButton: !1,
                        timer: 4000,
                    });
                }
            }
        });
    });
});
