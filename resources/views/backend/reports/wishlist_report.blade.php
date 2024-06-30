@extends('backend.layouts.layout')
@section('admin-title', 'Page Wishlist Report')
@section('admin_content')

    <div class="row d-flex justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">

                    <form action="{{ route('admin.category.wishlist.report') }}" method="POST">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4">
                                <p class="m-0 py-2" style="float: right;">Sort by Category :</p>
                            </div>
                            @php
                                $categories = App\Models\ProductCategory::where('pc_status', 1)->get();
                            @endphp
                            <div class="col-md-6">
                                <select name="category_id" class="form-control select2 single-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->pc_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th width="80%">Product Name</th>
                                <th width="20%">Number Of Wish</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                @php
                                    $wishlists = App\Models\Wishlist::where('product_id', $product->product_id)->count();
                                @endphp
                                <tr>
                                    <td>
                                        <span style="padding-right: 20px;">{{ $product->product_name }}</span>
                                    </td>
                                    <td>
                                        <span style="padding-right: 20px;">{{ $wishlists }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <script script script src="{{ asset('backend') }}/assets/libs/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.single-select').select2();
        });
    </script>
@endsection
