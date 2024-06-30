@extends('backend.layouts.layout')
@section('admin-title', 'Service Text Managment')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Service</b>
                        @if (count($serviceAds) >= 3)
                            <button disabled class="btn btn-sm btn-primary" style="float: right"><i
                                    class="bx bx-plus-medical"></i>
                                Create Service</button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#addServiceModal" class="btn btn-sm btn-primary"
                                style="float: right"><i class="bx bx-plus-medical"></i> Create Service</button>
                        @endif
                    </h4>
                </div>
                <div class="px-2 card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Text</th>
                                {{-- <th class="text-center">Status</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceAds as $key => $service)
                                <tr>
                                    <td class="text-center"><i class="{{ $service->sa_icon }} fs-4"></i></td>
                                    <td>
                                        {{ $service->sa_title }}
                                    </td>
                                    <td>{{ $service->sa_sub_title }}</td>
                                    {{-- <td class="text-center">
                                        @if ($service->sa_status == 1)
                                            <a href="#" class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="align-middle bx bx-like font-size-16 me-2"></i>
                                                Active
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-danger waves-effect waves-light btn-sm"
                                                disabled="disabled">
                                                <i class="align-middle bx bx-dislike font-size-16 me-2"></i>
                                                Inactive
                                            </a>
                                        @endif
                                    </td> --}}
                                    <td class="text-center">
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#editServiceModal{{ $service->id }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bx bxs-pencil"></i></button>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.service.ads.delete', $service->sa_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Service Edit Modal -->
                                <div class="modal fade" id="editServiceModal{{ $service->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Service Text Information
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.service.ads.update', $service->sa_slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-2 form-group">
                                                        <label for="">Icon (font-awsome)</label>
                                                        <input class="form-control @error('sa_icon') is-invalid @enderror"
                                                            type="text" name="sa_icon"
                                                            placeholder="Example: bx bx-sticker"
                                                            value="{{ $service->sa_icon }}" required>
                                                        @error('sa_icon')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2 form-group">
                                                        <label for="title">Title</label>
                                                        <input min="11" class="form-control" type="text"
                                                            name="sa_title" placeholder="Enter Title"
                                                            value="{{ $service->sa_title }}" required>
                                                    </div>
                                                    <div class="mb-2 form-group">
                                                        <label for="">Sub-Title</label>
                                                        <input class="form-control" type="text" name="sa_sub_title"
                                                            placeholder="Enter Sub-Title"
                                                            value="{{ $service->sa_sub_title }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Service</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Service Edit End Modal -->
                </div>
                <!-- Service Edit End Modal -->
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Service Create Modal -->
    <div class="modal fade" id="addServiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Service Text Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.service.ads.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2 form-group">
                            <label for="">Icon (font-awsome)</label>
                            <input class="form-control @error('sa_icon') is-invalid @enderror" type="text"
                                name="sa_icon" placeholder="Example: bx bx-sticker" value="{{ old('sa_icon') }}"
                                required>
                            @error('sa_icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2 form-group">
                            <label for="title">Title</label>
                            <input min="11" class="form-control" type="text" name="sa_title"
                                placeholder="Enter Title" value="{{ old('sa_title') }}" required>
                        </div>
                        <div class="mb-2 form-group">
                            <label for="">Sub-Title</label>
                            <input class="form-control" type="text" name="sa_sub_title" placeholder="Enter Sub-Title"
                                value="{{ old('sa_sub_title') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Service Create End Modal -->
@endsection
