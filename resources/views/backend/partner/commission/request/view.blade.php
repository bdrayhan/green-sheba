@extends('backend.layouts.layout')
@section('admin-title', 'Partner Managment')
@section('admin_content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> View Commission Request Information
                        </h4>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.commission.withdraw.request') }}"
                            class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                class="fas fa-th label-icon"></i>Commission Request</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        @if (Session::has('success'))
                            <div class="alert alert-success alertsuccess" role="alert">
                                <strong>Success!</strong> {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger alerterror" role="alert">
                                <strong>Opps!</strong> {{ Session::get('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table
                            class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                            <tr>
                                <td>Partner Name</td>
                                <td>:</td>
                                <td>{{ $data->userInfo->name }}</td>
                            </tr>
                            <tr>
                                <td>Account Name</td>
                                <td>:</td>
                                <td>{{ $data->account_name }}</td>
                            </tr>
                            <tr>
                                <td>Account Number</td>
                                <td>:</td>
                                <td>{{ $data->account_number }}</td>
                            </tr>
                            <tr>
                                <td>Withdraw Amount</td>
                                <td>:</td>
                                <td>{{ $data->amount }}</td>
                            </tr>
                            <tr>
                                <td>Balance</td>
                                <td>:</td>
                                <td>{{ $data->balance }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td>{{ $data->description }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    <form action="{{ route('partner.commission.withdraw.paid') }}" method="POST">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-8">
                                                <select name="status" class="form-control" id="">
                                                    <option value="1">Unpaid</option>
                                                    <option value="0">Paid</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="hidden" name="new_balance" value="{{ ($data->balance)-($data->amount) }}">
                                            
                                            <div class="col-md-4">
                                                <button class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            {{-- @if ($data->supplier_creator != '')
                                <tr>
                                    <td>Creator Info</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->creatorInfo->name }} <br>
                                        {{ $data->created_at->format('d-m-Y | h:i:s A') }}
                                    </td>
                                </tr>
                            @endif
                            @if ($data->supplier_editor != '')
                                <tr>
                                    <td>Editor Info</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->editorInfo->name }} <br>
                                        {{ $data->updated_at->format('d-m-Y | h:i:s A') }}
                                    </td>
                                </tr>
                            @endif --}}
                            {{-- @endforeach --}}
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div class="card-footer card_footer">
                <div class="btn-group mt-2" role="group">
                    <a href="#" class="btn btn-secondary">Print</a>
                    <a href="#" class="btn btn-dark">PDF</a>
                    <a href="#" class="btn btn-secondary">Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>

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
