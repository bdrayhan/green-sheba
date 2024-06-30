$(document).ready(function () {
    // Get Single Product Id
    jQuery(document).on("click", "#add_to_cart", function (e) {
        e.preventDefault();
        var product_id = jQuery(this).data("id");

        $.ajax({
            type: "GET",
            url: "/add-to-cart/" + product_id,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: !1,
                        timer: 2000,
                    });
                }
                $(".alert-count").text(response.side_cart_count);
                $(".cart-header-title").text(
                    response.side_cart_count + " " + "ITEMS"
                );
                $(".cart-total").text("৳ " + response.side_cart_total);
                $(".cart-list").html("");
                if (!response.side_cart_count == 0) {
                    $.each(response.side_carts, function (index, value) {
                        $(".cart-list").append(
                            `
                        <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="cart-product-title">` +
                                value.name +
                                `</h6>
                                    <p class="cart-product-price">` +
                                value.quantity +
                                ` X ৳` +
                                value.price +
                                `</p>
                                </div>
                                <div class="position-relative">
                                    <div class="cart-product-cancel position-absolute"><i
                                            class='bx bx-x'></i>
                                    </div>
                                    <div class="cart-product">
                                        <img src="` +
                                value.attributes.image +
                                `"  class="" alt="product name">
                                    </div>
                                </div>
                            </div>
                        </a>`
                        );
                    });
                } else {
                    $(".cart_item").append(`
                <li>
                    <h4>Cart Is Empty</h4>
                </li>`);
                }
            },
        });
    });
});
