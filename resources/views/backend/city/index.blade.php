@extends('backend.layouts.layout')
@section('admin-title', 'City Managment')
@section('admin_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All City</b>
                        <button data-bs-toggle="modal" data-bs-target="#addCityModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New City</button>
                            <a id="cityDeleteButton" href="#" class="btn btn-sm btn-danger"
                            style="float: right; margin-right: 15px;"><i class=" bx bxs-trash-alt"></i>
                            Mark Delete</a>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap w-100 table-check">
                        <thead>

                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Remarks</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citys as $row)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input name="ids[]" class="form-check-input" value="{{ $row->id }}"
                                                type="checkbox">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td>{{ $row->city_name }}</td>
                                    <td>
                                        @if ($row->city_remarks)
                                            {{ $row->city_remarks }}
                                        @else
                                            <span class="text-danger">Remarks Not Available</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#editCityModal{{ $row->id }}"
                                            class="btn btn-sm btn-primary"><i class="bx bx-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.city.soft.delete', $row->city_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- City Edit Modal -->
                                <div class="modal fade" id="editCityModal{{ $row->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">City Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.city.update', $row->city_slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label for="">City Name</label>
                                                        <input required
                                                            class="form-control @error('city_name') is-invalid @enderror"
                                                            type="text" name="city_name" placeholder="Enter Your City"
                                                            value="{{ $row->city_name }}">
                                                        @error('city_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Remarks</label>
                                                        <input
                                                            class="form-control @error('city_remarks') is-invalid @enderror"
                                                            type="text" name="city_remarks" placeholder="Enter City Remarks"
                                                            value="{{ $row->city_remarks }}">
                                                        @error('city_remarks')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" type="number" name="city_orderby"
                                                            placeholder="Order By" value="{{ $row->city_orderby }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bx-save w-2"></i>
                                                        Update City</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- City Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- City Create Modal -->
    <div class="modal fade" id="addCityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">City Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.city.insert') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">City Name</label>
                            <input required class="form-control @error('city_name') is-invalid @enderror" type="text"
                                name="city_name" placeholder="Enter Your City" value="{{ old('city_name') }}">
                            @error('city_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Remarks</label>
                            <input class="form-control @error('city_remarks') is-invalid @enderror" type="text"
                                name="city_remarks" placeholder="Enter City Remarks" value="{{ old('city_remarks') }}">
                            @error('city_remarks')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="city_orderby" placeholder="Order By">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save w-2"></i> Save City</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- City Create End Modal -->
@endsection


@push('backend-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cityDeleteButton').click(function(e) {
                // e.preventDefault();
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
                                url: "city/multi-delete",
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
                        title: 'Please select at least one',
                        showConfirmButton: 1,
                        // timer: 4000,
                    });
                }

            });
        });
    </script>
@endpush
