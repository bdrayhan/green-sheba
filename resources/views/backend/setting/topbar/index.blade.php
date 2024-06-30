@extends('backend.layouts.layout')
@section('admin-title', 'Top-Navbar Managment')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>All Page</b>
                        <button data-bs-toggle="modal" data-bs-target="#addPageModal" class="btn btn-sm btn-primary"
                            style="float: right"><i class="bx bx-plus-medical"></i> Add Page</button>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Page Name</th>
                                <th>Page Url</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $key => $row)
                                <tr>
                                    <td>
                                        {{ $row->page_name }}
                                    </td>
                                    <td>
                                        <span style="padding-right: 20px;">{{ $row->page_url }}</span>
                                        <a target="_blank" href="{{ route('web.page', $row->page_url) }}"
                                            class="btn btn-sm btn-info"><i class="bx bx-show-alt"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if ($row->page_status)
                                            <a href="{{ route('admin.page.deactive', $row->page_slug) }}"
                                                class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="bx bx-like font-size-16 align-middle me-2"></i> Active
                                            </a>
                                        @else
                                            <a href="{{ route('admin.page.active', $row->page_slug) }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm">
                                                <i class="bx bx-dislike font-size-16 align-middle me-2"></i> Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.page.edit', $row->page_slug) }}"
                                            class="btn btn-sm btn-primary"> <i class="bx bxs-pencil"></i></a>
                                        <a id="delete" class="btn btn-sm btn-danger"
                                            href="{{ route('admin.page.destroy', $row->page_slug) }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Page Create Modal -->
    <div class="modal fade" id="addPageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Page Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.page.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Page Name</label>
                            <input class="form-control @error('page_name') is-invalid @enderror" type="text"
                                name="page_name" placeholder="Enter Page Name" required>
                            @error('page_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Page URL</label>
                            <div class="input-group">
                                <div class="input-group-text">{{ asset('/') }}</div>
                                <input name="page_url" type="text"
                                    class="form-control @error('page_url') is-invalid @enderror"
                                    placeholder="Enter Page Url" required>
                                @error('page_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group mb-2">
                            <label for="">Page Content</label>
                            <textarea class="form-control" name="page_content" id="pageContent"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save w-2"></i> Page Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Page Create End Modal -->
@endsection
