@extends('backend.layouts.layout')
@section('admin-title', 'Feature Category Managment')
@section('admin_content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary bg-gradient rounded text-white d-flex justify-content-between align-items-center">
                    <h5 style="margin-bottom: 0px;"> Category List</h5>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive wrap table-check w-100 table-check">
                        <thead>
                        <tr class="text-primary">
                            <th width="5%">
                                <div class="form-check font-size-16 align-middle">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th width="5%">Image</th>
                            <th width="20%">Name</th>
                            <th width="10%">Url</th>
                            <th width="10%">Order</th>
                            <th width="15%" class="text-center text-dark">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($featureCategories as $key => $row)
                            <tr>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input name="ids[]" class="form-check-input" value="{{ $row->id }}" type="checkbox">
                                        <label class="form-check-label" for="transactionCheck02"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if (File::exists($row->category->pc_image))
                                        <img class="rounded" width="50px" src="{{ asset($row->category->pc_image) }}" alt="">
                                    @else
                                        <img class="rounded" width="70px"
                                            src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $row->category->pc_name }}</td>
                                <td>{{ $row->category->pc_url }}</td>
                                <td class="text-center">{{ $row->order_by ? $row->order_by : 'null' }}</td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-grid-alt
                                                font-size-15 align-middle me-2"></i> Manage
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $row->category->id }}">
                                                <i class="bx bx-edit align-middle me-2"></i> Edit
                                            </button>
                                            <a id="delete" class="dropdown-item" href="{{ route('admin.feature.category.destroy', $row->id) }}">
                                                <i class="bx bx-trash-alt align-middle me-2"></i> Delete
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="bx bx-like align-middle me-2"></i>
                                                {{ $row->pc_active === 1 ? 'Disable' : 'Enable' }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Feature Edit Modal -->
                            <div class="modal fade" id="editModal{{ $row->category->id }}" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" role="dialog"
                                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Category Edit Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.feature.category.update', $row->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="">Name <span class="text-danger">*</span></label>
                                                    <select required class="form-control @error('category_id') is-invalid @enderror"
                                                            name="category_id">
                                                        <option disabled selected>Choose...</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $category->id === $row->category->id ? 'selected' : '' }}>
                                                                {{ $category->pc_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">Order By</label>
                                                    <input class="form-control" type="number" name="order_by" placeholder="Order Id"
                                                           value="{{ $row->order_by }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bx bx-sync"></i> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Feature Edit End Modal -->
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-secondary bg-gradient rounded text-white">
                    <h5 style="margin-bottom: 0px;">Category Create</h5>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('admin.feature.category.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <select required class="form-control single-select @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                    <option disabled selected>Choose...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->pc_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Order By</label>
                                <input class="form-control" type="number" name="order_by" placeholder="Order Id"
                                       value="{{ old('order_by') }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary px-5 fs-5"><i class="bx bx-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- Category Create End Modal -->
@endsection

@push('backend-scripts')
{{--    <script script script src="{{ asset('backend') }}/assets/libs/jquery/jquery.min.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('.single-select').select2();
        });
        $(document).ready(function () {
            $('.select2-multiple').select2();
        });

    </script>
@endpush
