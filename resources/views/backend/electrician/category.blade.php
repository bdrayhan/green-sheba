@extends('backend.layouts.layout')
@section('admin-title', 'Electrician')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Electrician</h4>

            <div class="page-title-right">
                <ol class="m-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Electrician</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Category</b>
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#categoryModal"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add New Category</button>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Category Remarks</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                
                            
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->remarks }}</td>
                                    <td>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('backend.electrician.delete', $data->slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>

    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class=""></div>
                        <div class="col-12">
                            <div class="card-body">
                                <form action="{{ route('backend.electrician.insert') }}"
                                        method="POST" id="productForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content p-3 text-muted">
                                        <!-- First Tab -->
                                        <div class="tab-pane active show" id="general" role="tabpanel">
                                            <div class="row mb-4">
                                                <label for="category_name" class="col-sm-4 col-form-label text-end font-bold fs-5">
                                                    Name <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input name="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" placeholder="Category Name"
                                                    value="{{ old('category_name') }}" required>
                                                    @error('category_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="category_remarks" class="col-sm-4 col-form-label text-end font-bold fs-5">
                                                    Remarks </label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control @error('category_remarks') is-invalid @enderror" name="category_remarks" id="" placeholder="Category Remarks" cols="90" rows="3"></textarea>
                                                    @error('category_remarks')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        </div>
    </div>

{{-- <div class="container">
    <div class="row">
        <div class=""></div>
        <div class="col-8">
            <div class="card-body">
                <form action="{{ route('backend.electrician.insert') }}"
                        method="POST" id="productForm" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content p-3 text-muted">
                        <!-- First Tab -->
                        <div class="tab-pane active show" id="general" role="tabpanel">
                            <div class="row mb-4">
                                <label for="category_name" class="col-sm-4 col-form-label text-end font-bold fs-5">
                                    Category Name <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input name="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" placeholder="Category Name"
                                    value="{{ old('category_name') }}" required>
                                    @error('category_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="category_remarks" class="col-sm-4 col-form-label text-end font-bold fs-5">
                                    Category Remarks </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('category_remarks') is-invalid @enderror" name="category_remarks" id="" placeholder="Category Remarks" cols="90" rows="3"></textarea>
                                    @error('category_remarks')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer card_footer text-center">
                                <button type="submit" class="btn btn-md btn-success">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</div> --}}


@endsection
