@extends('backend.layouts.layout')
@section('admin-title', 'File Manager Management')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>File Manager</b></h4>
                </div>
                <div class="px-2 card-body">
                    <div class="d-xl-flex">
                        <div class="w-100">
                            <div class="d-md-flex">
                                <div class="w-100">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <form action="#" class="dropzone" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                        </div>
                                                        <h4>Drop files here or click to upload.</h4>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="pt-3 row">
                                                <div class="card">
                                                    <div class="card-header row">
                                                        <div class="m-auto col-lg-6">
                                                            <h3 class="card-title">Media File</h3>
                                                        </div>
                                                        <div class="m-auto col-lg-6">
                                                            <a style="float: right;" onClick="window.location.reload();"
                                                                href="#" class="mx-2 btn btn-primary"><i
                                                                    class="mdi mdi-refresh"></i></a>
                                                            <a id="markDelete" style="float: right;" href="#"
                                                                class="btn btn-danger font-size-15"><i
                                                                    class="mdi mdi-delete-sweep"></i> Mark
                                                                Delete</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table id="datatable"
                                                            class="table table-bordered dt-responsive nowrap w-100 table-check">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 20px;" class="align-middle">
                                                                        <div class="form-check font-size-16">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="checkAll">
                                                                            <label class="form-check-label"
                                                                                for="checkAll"></label>
                                                                        </div>
                                                                    </th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Url</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($media as $key => $row)
                                                                    <form action="#" method="POST" id="markSubmit">
                                                                        @csrf
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-check font-size-16">
                                                                                    <input name="ids[]"
                                                                                        class="form-check-input"
                                                                                        type="checkbox"
                                                                                        value="{{ $row->id }}">
                                                                                    <label class="form-check-label"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                @if (File::exists('media/mediamanager/' . $row->media_title))
                                                                                    <img class="rounded"
                                                                                        style="width: 80px;"
                                                                                        src="{{ asset('media/mediamanager/' . $row->media_title) }}"
                                                                                        alt="">
                                                                                @else
                                                                                    <img class="rounded" width="80px"
                                                                                        src="{{ asset('backend/assets/images/default_image.png') }}"
                                                                                        alt="">
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ $row->media_title }}</td>
                                                                            <td>
                                                                                <span class="urlCopy" title="Click and copy">{{ $row->media_url }}</span>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <a title="Delete" id="delete"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    href="{{ route('admin.media.delete', $row->media_slug) }}">
                                                                                    <i class="bx bxs-trash-alt"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </form>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @push('backend-scripts')
            <script type="text/javascript">
            // Media Url Copy
                $(document).ready(function() {
                    $('.urlCopy').click(function () {
                        navigator.clipboard.writeText(this.innerHTML);
                        toastr.success('Url Copied');
                    });
                });

            // Media Dropzone
                $("form.dropzone").dropzone({
                    url: "{{ url('admin/media') }}",
                    dictInvalidFileType: "upload only JPG/PNG",
                    maxFilesize: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 5000,

                    maxFiles: 5,
                    init: function() {
                        this.on("success", function(file, response) {
                            if (response.status === 'success') {
                                toastr.success('Image Uploade Successfull');
                            } else {
                                toastr.error('Image Uploade Failed !');
                            }
                            this.removeFile(file);
                        });
                    }
                });
            </script>
        @endpush
