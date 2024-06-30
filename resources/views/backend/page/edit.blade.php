@extends('backend.layouts.layout')
@section('admin-title', 'Page Managment')
@section('admin_content')
    @push('custom-style')
        <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Edit Page</b>
                        <a href="{{ route('admin.page.index') }}" class="btn btn-sm btn-primary" style="float: right"><i
                                class="bx bx-left-arrow-alt"></i> Back</a>
                    </h4>
                </div>
                <div class="card-body px-2">
                    <form action="{{ route('admin.page.update', $page->page_slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Page Name</label>
                                <input class="form-control @error('page_name') is-invalid @enderror" type="text"
                                    name="page_name" placeholder="Enter Page Name" required value="{{ $page->page_name }}">
                                @error('page_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Page URL</label>
                                <div class="input-group">
                                    <div class="input-group-text">example.com/page/</div>
                                    <input name="page_url" type="text"
                                        class="form-control @error('page_url') is-invalid @enderror"
                                        placeholder="Enter Page Url" required value="{{ $page->page_url }}">
                                    @error('page_url')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group mb-2">
                                <label for="">Page Content</label>
                                <textarea class="form-control" name="page_content" id="pageContent">{!! $page->page_content !!}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save w-2"></i> Page Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
