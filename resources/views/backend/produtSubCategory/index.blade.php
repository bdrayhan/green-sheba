@extends('backend.layouts.layout')
@section('admin-title', 'Sub Category Managment')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Sub Category</b>
                        <button data-bs-toggle="modal" data-bs-target="#addSubCategoryModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add SubCategory</button>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category Name</th>
                                <th>subCategory Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subCategories as $row)
                                <tr>
                                    <td class="text-center">
                                        @if (File::exists($row->psc_image))
                                            <img class="rounded" width="70px" src="{{ asset($row->psc_image) }}"
                                                alt="">
                                        @else
                                            <img class="rounded" width="70px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $row->procategory->pc_name }}
                                    </td>
                                    <td>{{ $row->psc_name }}</td>
                                    <td class="text-center">
                                        @if ($row->psc_active == 1)
                                            <a href="{{ route('admin.product.sub-category.deactive', $row->psc_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.product.sub-category.active', $row->psc_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editSubCategoryModal{{ $row->id }}"> <i
                                                class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.product.sub-category.softdelete', $row->psc_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Sub Category Edit Modal -->
                                <div class="modal fade" id="editSubCategoryModal{{ $row->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Sub Category Information
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.product.sub-category.update', $row->psc_slug) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input class="form-control" type="hidden" name="old_image" value="{{ $row->psc_image }}">
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label">Category Name</label>
                                                        <select class="form-control" name="id">
                                                            <option label="Select Category"></option>
                                                            @forelse ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $row->id == $category->id ? 'selected' : '' }}
                                                                    >{{ $category->pc_name }}</option>
                                                            @empty
                                                                <option label="Category Not Found!"></option>
                                                            @endforelse
                                                        </select>
                                                        @error('category_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Sub Category Name</label>
                                                        <input class="form-control @error('psc_name') is-invalid @enderror" type="text"
                                                            name="psc_name" placeholder="Sub Category Name" value="{{ $row->psc_name }}">
                                                        @error('psc_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">URL</label>
                                                        <input class="form-control @error('psc_url') is-invalid @enderror" type="text"
                                                            name="psc_url" placeholder="Enter Your URL" value="{{ $row->psc_url }}">
                                                        @error('psc_url')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Order By</label>
                                                        <input class="form-control" value="{{ $row->psc_orderby }}" type="number" name="psc_orderby" placeholder="Order By Id">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="">Remarks</label>
                                                        <input class="form-control @error('psc_remarks') is-invalid @enderror" type="text"
                                                            name="psc_remarks" placeholder="Enter Remarks" value="{{ $row->psc_remarks }}">
                                                        @error('psc_remarks')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="">Image</label>
                                                        <input id="input_image" class="form-control" type="file" name="psc_image">
                                                        @if (File::exists($row->psc_image))
                                                            <img id="input_image_preview" class="rounded me-2 my-2" width="100px" height="100px"
                                                                src="{{ asset($row->psc_image) }}" alt="">
                                                        @else
                                                            <img id="input_image_preview" class="rounded me-2 my-2" width="100px" height="100px"
                                                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bx-save w-2"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sub Category Edit End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Sub Category Create Modal -->
    <div class="modal fade" id="addSubCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sub Category Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.product.sub-category.insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Category Name</label>
                            <select class="form-control" name="id">
                                <option label="Select Category"></option>
                                @forelse ($categories as $row)
                                    <option value="{{ $row->id }}">{{ $row->pc_name }}</option>
                                @empty
                                    <option label="Category Not Found!"></option>
                                @endforelse
                            </select>
                            @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Sub Category Name</label>
                            <input class="form-control @error('psc_name') is-invalid @enderror" type="text"
                                name="psc_name" placeholder="Sub Category Name" value="{{ old('psc_name') }}">
                            @error('psc_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">URL</label>
                            <input class="form-control @error('psc_url') is-invalid @enderror" type="text"
                                name="psc_url" placeholder="Sub Category Name" value="{{ old('psc_url') }}">
                            @error('psc_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Order By</label>
                            <input class="form-control" type="number" name="psc_orderby" placeholder="Order By Id">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Remarks</label>
                            <input class="form-control @error('psc_remarks') is-invalid @enderror" type="text"
                                name="psc_remarks" placeholder="Sub Category Name" value="{{ old('psc_remarks') }}">
                            @error('psc_remarks')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Image</label>
                            <input id="input_image" class="form-control" type="file" name="psc_image">
                            <img id="input_image_preview" class="rounded me-2 my-2" width="100px"
                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save w-2"></i> Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sub Category Create End Modal -->
@endsection

@push('custom-script')
    <script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
@endpush
