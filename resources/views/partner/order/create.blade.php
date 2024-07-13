@extends('backend.layouts.layout')
@section('admin-title', 'Order Create')
@section('admin_content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Customer Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="shippingName" class="form-label">Customer
                                Name <span class="text-danger">*</span></label>
                            <input id="shippingName" name="shipping_name" type="text" class="form-control"
                                    value="" placeholder="Customer Name"
                                    required>
                            @error('shipping_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="shippingPhone" class="form-label">Customer
                                Phone</label>
                            <input id="shippingPhone" name="shipping_phone" type="tel" class="form-control"
                                   placeholder="Customer Phone" value=""
                                   required>
                            @error('shipping_phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="shippingEmail" class="form-label">Customer
                                Email</label>
                            <input id="shippingEmail" name="shipping_email" type="email" class="form-control"
                                   placeholder="Customer Email" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="shippingAddress" class="form-label">Shipping Address</label>
                            <textarea required name="shipping_address" id="shippingAddress" class="form-control"></textarea>
                            @error('shipping_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="shippingNote" class="form-label">Order Notes</label>
                            <textarea id="shippingNote" name="shipping_note" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Product Information</h4>
                </div>
                <div class="card-body">
                    <div class="mb-5 table-responsive">
                        <table id="productTable" class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Code</th>
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
                                        <select style="width: 100%;" class="form-control"
                                                name="product_id" id="productID" data-placeholder="Select Product">
                                        </select>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-right col-sm-4 control-label col-form-label">Payment
                                    Methord</label>
                                <div class="col-sm-8">
                                    <p class="fw-semibold">Cash On Delivery</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-right col-sm-4 control-label col-form-label">Order
                                    Status</label>
                                <div class="col-sm-8">
                                    <span class="badge badge-pill badge-soft-secondary font-size-12">
                                        Order Pending
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="courierID" class="form-label">Select Couries <span
                                        class="text-danger">*</span> </label>
                                <select class="form-control" name="courier_id" id="courierID" required>
                                    <option label="Select Courier"></option>
                                    @foreach($couriers as $courier)
                                        <option value="{{ $courier->id }}">{{ $courier->courier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2 form-group row">
                                <label for="subTotal" class="text-right col-sm-4 control-label col-form-label">Sub
                                    Total</label>
                                <div class="col-sm-8">
                                    <input id="subTotal" disabled type="text" class="form-control" style="cursor: not-allowed;" value="0">
                                </div>
                            </div>

                            <div class="mb-2 form-group row">
                                <label for="shippingCharge"
                                       class="text-right col-sm-4 control-label col-form-label">Shipping Charge</label>
                                <div class="col-sm-8">
                                    <input id="shippingCharge" disabled type="text" class="form-control" style="cursor: not-allowed;" >
                                </div>
                            </div>
                            <div class="mb-2 form-group row">
                                <label for="paying_amount"
                                       class="text-right col-sm-4 control-label col-form-label text-danger">Advance
                                    Pay</label>
                                <div class="col-sm-8">
                                    <input min="0" id="payAmount" type="number"
                                           name="paying_amount" class="form-control" placeholder="0"
                                           value="">
                                </div>
                            </div>
                            <div class="mb-5 form-group row">
                                <label for="dueAmount"
                                       class="text-right col-sm-4 control-label col-form-label">Due Amount</label>
                                <div class="col-sm-8">
                                    <input id="dueAmount" disabled type="text" class="form-control"
                                           style="cursor: not-allowed;" value="0">
                                </div>
                            </div>
                            <button id="submit" class="btn btn-success waves-effect btn-label waves-light"
                                    style="margin-left: 130px;"><i class="bx bx-check-double label-icon"></i>
                                Create Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend') }}/assets/libs/jquery/jquery.min.js"></script>
    <script>
        // Courier Charge
        $(document).ready(function (){
            $('#courierID').on('change', function (){
                var courierID = $(this).val();
                if (courierID){
                    $.ajax({
                        url: "{{ url('admin/order/courier/charge') }}/" + courierID,
                        type: "GET",
                        dataType: "json",
                        success: function (data){
                            $('#shippingCharge').val(data.courier_charge);
                            calculation();
                        }
                    });
                }else {
                    $('#shippingCharge').val(0);
                    calculation();
                }
                calculation();
            });
        });

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
                    '<td><span class="productPrice">' + e.params.data.product_price + '</span></td>' +
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


        // Order Create
        $(document).ready(function () {
            $("#submit").click(function () {
                let shippingName = $("#shippingName").val();
                let shippingPhone = $("#shippingPhone").val();
                let shippingEmail = $("#shippingEmail").val();
                let shippingAddress = $("#shippingAddress").val();
                let shippingNote = $("#shippingNote").val();
                let payAmount = $("#payAmount").val();
                let shippingCharge = $("#shippingCharge").val();
                let dueAmount = $("#dueAmount").val();
                let courierID = $("#courierID").val();

                let product = [];
                let productCount = 0 ;
                $("#productTable tbody tr").each(function (index, value) {
                    let currentRow = $(this);
                    let obj = {};
                    obj.productID = currentRow.find(".productID").val();
                    obj.productCode = currentRow.find(".productCode").text();
                    obj.productName = currentRow.find(".productName").text();
                    obj.productQuantity = currentRow.find(".productQuantity").val();
                    obj.productPrice = currentRow.find(".productPrice").text();
                    product.push(obj);
                    productCount++;
                });
                if(shippingName === ''){
                    toastr.error('Customer Name Should Not Be Empty');
                    return;
                }
                // Phone Validation
                if (shippingPhone.length < 11 || shippingPhone.length > 11) {
                    toastr.error('Enter Valid Phone Number');
                    return;
                }
                if(shippingAddress === ''){
                    toastr.error('Customer Address Should Not Be Empty');
                    return;
                }if(courierID === ''){
                    toastr.error('Courier Should Not Be Empty');
                    return;
                }
                if(productCount <= 0){
                    toastr.error('Product Should Not Be Empty');
                    return;
                }
                var data ={};
                data['shippingName'] = shippingName;
                data['shippingPhone'] = shippingPhone;
                data['shippingEmail'] = shippingEmail;
                data['shippingAddress'] = shippingAddress;
                data['shippingNote'] = shippingNote;
                data['shippingCharge'] = shippingCharge;
                data['payAmount'] = payAmount;
                data['dueAmount'] = dueAmount;
                data['courierID'] = courierID;
                data['product'] = product;

                $.ajax({
                    url: "{{ url('admin/order/store') }}",
                    type: "POST",
                    data: {
                        data: data,
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        toastr.success(data.success);
                        setTimeout(function () {
                            window.location.href = "{{ url('admin/order/1') }}";
                        }, 500);
                    }
                });
            });
        });

        $(document).on("change", ".productQuantity", function () {
            calculation();
        });
        $(document).on("input", "#payAmount", function () {
            calculation();
        });

        calculation();
        function calculation(){
            var subTotal = 0;
            var shippingCharge = +$("#shippingCharge").val();
            var payAmount = +$("#payAmount").val();
            $("#productTable tbody tr").each(function (index) {
                subTotal = subTotal + +$(this) .find(".productPrice") .text() *  +$(this).find(".productQuantity").val();
            });
            $("#subTotal").val(subTotal);
            $("#dueAmount").val(subTotal + shippingCharge - payAmount);
        }
    </script>
@endsection
