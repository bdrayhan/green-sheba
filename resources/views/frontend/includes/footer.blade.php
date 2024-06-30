<!-- Bootstrap JS -->
<script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/plugins/OwlCarousel/js/owl.carousel.min.js"></script>
<script src="{{ asset('frontend') }}/assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js"></script>
<script src="{{ asset('frontend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

@stack('frontend-scripts')

{{-- Add To Cart AND Order Now Button --}}
<script>
    $(document).ready(function() {
        $('.addtoCartButton').on('click', function(e) {
            e.preventDefault();
            $('#cartOrderForm').attr('action', "{{ route('web.product.add.to.cart') }}");
            $('#cartOrderForm').submit();
        });

        $('.orderNowButton').on('click', function(e) {
            e.preventDefault();
            $('#cartOrderForm').attr('action', "{{ route('web.checkout.quick.order') }}");
            $('#cartOrderForm').submit();
        });
    });
</script>

<!-- Sweet Alerts js -->
<script src="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Sweet Alerts Script -->

<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'error':
                Swal.fire({
                    icon: "error",
                    title: "{{ Session::get('message') }}",
                    showConfirmButton: !1,
                    timer: 2000
                })
                break;
            case 'success':
                $(window).bind("load", function() {
                    Swal.fire({
                        icon: "success",
                        title: "{{ Session::get('message') }}",
                        showConfirmButton: !1,
                        timer: 2000
                    })
                });
                break;
        }
    @endif
</script>
<!--app JS-->
{!!  $analytics->custom_header_script !!}
<!-- Sweet Alerts js -->
<script src="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Sweet Alerts Script -->
<script>
    $(document).on("click", "#delete", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this Order!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1
        }).then(function(t) {
            t.value ? window.location.href = link : t.dismiss === Swal.DismissReason.cancel &&
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary Order is safe :)",
                    icon: "error"
                })
        })
    });
</script>
<script src="{{ asset('frontend') }}/assets/js/app.js"></script>
<script src="{{ asset('frontend') }}/assets/js/index.js"></script>
<script src="{{ asset('frontend') }}/assets/js/add-to-cart.js"></script>
<script src="{{ asset('frontend') }}/assets/js/custom.js"></script>
</body>


</html>
