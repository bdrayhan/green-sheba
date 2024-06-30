@extends('backend.layouts.layout')
@section('admin-title', 'Product Purchase Management')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.css">
        <link href="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
            type="text/css">
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Information</h4>
                    <p class="card-title-desc">Fill all information below</p>
                    <form>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pur_invoice">Product Invoice</label>
                                    <input id="pur_invoice" name="pur_invoice" type="text" class="form-control" placeholder="Invoice">
                                </div>
                                <div class="mb-3">
                                    <label for="supplier_id">Select Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control">
                                        @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pur_date">Date</label>
                                    <input id="pur_date" name="pur_date" type="date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="pur_comment">Comment</label>
                                    <textarea class="form-control" name="pur_comment" id="pur_comment" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="mb-5 table-responsive">
                                    <table id="productTable" class="table mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>SKU</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <select style="width: 100%;" class="form-control" name="product_id" id="productID" data-placeholder="Select Product">
                                                </select>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                            <button type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div> <!-- end row -->

@endsection
@push('backend-scripts')
    <script src="{{ asset('backend') }}/assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $('.single-select').select2();
        // });
        // $(document).ready(function() {
        //     $('.select2-multiple').select2();
        // });


        $(document).ready(function () {
            $('#productID').select2({
                placeholder: "Select a Product",
                templateResult: function (state) {
                    if (!state.id) {
                        return state.product_name;
                    }
                    var $state = $(
                        '<span><img width="80px" src="https://amardeshamarponno.com/' +
                        state.product_thumbnail +
                        '" class="img-flag" /> ' +
                        state.product_name +
                        "</span>"
                    );
                    return $state;
                },
                ajax: {
                    url:'{{url('admin/order/product')}}',
                    processResults: function (data) {
                        // console.log(data);
                        var data = $.parseJSON(data);
                        return {
                            results: data.data
                        };
                    }
                }
            }).trigger("change").on("select2:select", function (e) {
                $("#productTable tbody").append(
                    "<tr>" +
                    '<td  style="display: none"><input type="text" class="productID" style="width:80px;" value="' + e.params.data.id + '"></td>' +
                    '<td><span class="productCode">' + e.params.data.product_code + '</span></td>' +
                    '<td><span class="productName">' + e.params.data.product_name + '</span></td>' +
                    '<td><input type="number" class="productQuantity form-control" style="width:60px;" value="1"></td>' +
                    '<td><input type="number" class="productPrice form-control" style="width:100px;" value="1"></td>' +
                    // '<td><span class="productPrice">' + e.params.data.product_price + '</span></td>' +
                    '<td><button class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                    "</tr>"
                );
                calculation();
            });

        });

        // Product Delete
        $(document).on("click", ".delete-btn", function () {
            $(this).closest("tr").remove();
            calculation();
        });

    </script>
@endpush
