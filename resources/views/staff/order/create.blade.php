@extends('staff.layouts.layout')
@section('staff-title', 'Order Create')
@section('staff_content')
    <div class="card">
        <div class="card-header">
            <h5><b>Order Details</b>
                <a href="#" class="btn btn-sm btn-primary" style="float: right">
                    <i class="bx bx-arrow-back"></i> Back
                </a>
            </h5>
        </div>
        <div class="card-body">
            <form id="orderUpdateForm" action="#" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customer Information <h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label">Customer
                                        Name</label>
                                    <input name="shipping_name" type="text" class="form-control"
                                        value="#" placeholder="Customer Name"
                                        required>
                                        @error('shipping_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="formrow-password-input" class="form-label">Customer
                                        Phone</label>
                                    <input name="shipping_phone" type="text" class="form-control"
                                        placeholder="Customer Phone" value=""
                                        required>
                                        @error('shipping_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="formrow-password-input" class="form-label">Customer
                                        Email</label>
                                    <input name="shipping_email" type="email" class="form-control"
                                        placeholder="Customer Email" value="#"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label">Shipping Address</label>
                                    <textarea required name="shipping_address" id="" class="form-control">#</textarea>
                                    @error('shipping_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label">Order Notes</label>
                                    <textarea required name="" id="" class="form-control"></textarea>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Product Information
                                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#AddOrderProduct" style="float: right;" href="#"
                                        style="float: right;"><i class="bx bx-plus-medical"></i> Add Product</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-5 table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Code</th>
                                                <td><a href="#">product name</a></td>
                                                <td>
                                                    No Color
                                                </td>
                                                <td>
                                                    No Size
                                                </td>
                                                <td width="25%">
                                                    <div class="row d-flex">
                                                        <div class="col-md-6">
                                                            <input type="number" name="order_quantity"
                                                                class="form-control"
                                                                value="">
                                                        </div>
                                                        <div class="col-md-3 text-center">
                                                            <button type="button" value=""
                                                                class="btn btn-sm btn-success orderQuantityButton">
                                                                <i class="bx bx-sync text-white"
                                                                    style="font-size: 20px;"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>৳ demo </td>
                                                <td>
                                                    <a id="delete"
                                                        href="#"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-right col-sm-4 control-label col-form-label">Payment
                                                Methord</label>
                                            <div class="col-sm-8">
                                                <p class="fw-semibold">#</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="text-right col-sm-4 control-label col-form-label">Order
                                                Status</label>
                                            <div class="col-sm-8">
                                                <span class="badge badge-pill badge-soft-secondary font-size-12"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Select Couries <span
                                                    class="text-danger">*</span> </label>
                                            <select class="form-control" name="courier_id" id="" required>
                                                <option label="Select Couries"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2 form-group row">
                                            <label class="text-right col-sm-4 control-label col-form-label">Sub
                                                Total</label>
                                            <div class="col-sm-8">

                                                    <input disabled type="text" class="form-control" style="cursor: not-allowed;" value="">
                                            </div>
                                        </div>

                                        <div class="mb-2 form-group row">
                                            <label for="fname"
                                                class="text-right col-sm-4 control-label col-form-label">Shipping Charge</label>
                                            <div class="col-sm-8">
                                                    <input disabled type="text" class="form-control" style="cursor: not-allowed;" value="">
                                            </div>
                                        </div>
                                        <div class="mb-2 form-group row">
                                            <label for="paying_amount"
                                                class="text-right col-sm-4 control-label col-form-label text-danger">Advance
                                                Pay</label>
                                            <div class="col-sm-8">
                                                <input min="0" id="paying_amount" type="number"
                                                    name="paying_amount" class="form-control" placeholder="0"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="mb-5 form-group row">
                                            <label for="fname"
                                                class="text-right col-sm-4 control-label col-form-label">Due Amount</label>
                                            <div class="col-sm-8">
                                                    <input id="total-due-amount" disabled type="text" class="form-control"
                                                    style="cursor: not-allowed;" value="">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                                            style="margin-left: 130px;"><i class="bx bx-check-double label-icon"></i>
                                            Create Order
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Order Product End Modal -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
@endsection
