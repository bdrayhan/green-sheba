<!-- JAVASCRIPT -->
<script src="{{ asset('backend') }}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/node-waves/waves.min.js"></script>

<!-- form repeater js -->
<script src="{{ asset('backend') }}/assets/libs/jquery.repeater/jquery.repeater.min.js"></script>


<!-- Plugins js -->
<script src="{{ asset('backend') }}/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
@stack('staff-scripts')
<!-- Required datatable js -->
<script src="{{ asset('backend') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/jszip/jszip.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="{{ asset('backend') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
</script>
<!-- toastr plugin -->
<script src="{{ asset('backend') }}/assets/libs/toastr/build/toastr.min.js"></script>
<!-- Tostar Notification Script -->
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-left",
                };
                toastr.info("{{ Session::get('message') }}")
                break;
            case 'success':
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-left",
                };
                toastr.success("{{ Session::get('message') }}")
                break;
            case 'warning':
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-left",
                };
                toastr.warning("{{ Session::get('message') }}")
                break;
            case 'error':
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-left",
                };
                toastr.error("{{ Session::get('message') }}")
                break;
        }
    @endif
</script>

<!-- Sweet Alerts js -->
<script src="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Sweet Alerts Script -->
<script>
    $(document).on("click", "#delete", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
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
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                })
        })
    });

    // Courier Assign To Order
    $(document).ready(function () {
        $('.orderCourier').click(function (e) {
            e.preventDefault();
            let courier_id = $(this).attr("data-courier");
            let order_id = $(this).attr("data-order");
            $.ajax({
                type: "GET",
                url: "{{ route('admin.staff.order.courier.assign') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "courier_id": courier_id,
                    "order_id": order_id
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Courier Assign Successfully",
                        showConfirmButton: !1,
                        timer: 2000
                    })
                    location.reload();
                }
            });
        });
    });

    //  Status Assign To Order
    $(document).ready(function () {
        $('.orderStatus').click(function (e) {
            e.preventDefault();
            let status_id = $(this).attr("data-status");
            let order_id = $(this).attr("data-order");
            let courier_id = $(this).attr("data-courier");
            if (courier_id == 0) {
                Swal.fire({
                        icon: "error",
                        title: "First Select Courier",
                        showConfirmButton: !1,
                        timer: 2000
                })
            }else{
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.staff.order.status.assign') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "status_id": status_id,
                        "order_id": order_id
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Order Status Successfully",
                            showConfirmButton: !1,
                            timer: 2000
                        })
                        location.reload();
                    }
                });
            }
        });
    });
</script>
{{-- Summernote Editor --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<!-- App js -->

<script src="{{ asset('backend') }}/assets/js/pages/form-repeater.int.js"></script>

<script src="{{ asset('backend') }}/assets/js/custom.js"></script>
<script src="{{ asset('backend') }}/assets/js/app.js"></script>
</body>

</html>
