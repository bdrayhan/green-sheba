@extends('backend.layouts.layout')
@section('admin-title', 'Partner Managment')
@section('admin_content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><b>Partner Commission Balance</b>
                    {{-- <button data-bs-toggle="modal" data-bs-target="#addPartnerModal" class="btn btn-sm btn-primary"
                        style="float: right"><i class="bx bx-plus-medical"></i> Add New</button>
                    <a id="partnerDeleteButton" href="#" class="btn btn-sm btn-danger"
                        style="float: right; margin-right: 15px;"><i class=" bx bxs-trash-alt"></i>
                        Mark Delete</a> --}}
                </h4>
            </div>
            <div class="card-body px-2">
                <table id="datatable" class="table table-bordered text-center dt-responsive wrap w-100 table-check">
                    <thead>
                        <tr>
                            
                            <th>Partner Name</th>
                            <th>Partner Phone</th>
                            <th>Partner Address</th>
                            <th>Balance</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($total_com as $data)
                        <tr>
                            {{-- <td></td> --}}
                            <td>{{ $data->userInfo->name }}</td>
                            <td>{{ $data->userInfo->phone }}</td>
                            <td>{{ $data->userInfo->address }}</td>
                            <td>{{ $data->balance }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection


@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#partnerDeleteButton').click(function(e) {
                e.preventDefault();
                var ids = [];
                var rows_selected = $("input[name='ids[]']")
                    .filter(":checked")
                    .map(function(index, rowId) {
                        ids[index] = rowId.value;
                    });
                if (ids.length > 0) {

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: !0,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        confirmButtonClass: "btn btn-success mt-2",
                        cancelButtonClass: "btn btn-danger ms-2 mt-2",
                        buttonsStyling: 1
                    }).then(function(t) {
                        t.value ?
                            $.ajax({
                                type: "POST",
                                url: "partner/multi-delete",
                                data: {
                                    ids: ids,
                                    _token: $('meta[name="csrf-token"]').attr("content"),
                                },
                                success: function(data) {
                                    if (data.status == "success") {
                                        window.location.reload();
                                    }
                                },
                                error: function(data) {
                                    alert(data.responseText);
                                },
                            }) :
                            t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                                title: "Cancelled",
                                text: "Your imaginary file is safe :)",
                                icon: "error"
                            })
                    })
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: 'Please select at least one item',
                        showConfirmButton: 1,
                        // timer: 4000,
                    });
                }

            });
        });
    </script>
@endpush
