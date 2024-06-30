@extends('backend.layouts.layout')
@section('admin-title', 'Social Setting')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Social Setting</b></h4>
                </div>
                <div class="px-2 card-body">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="social_id" value="{{ $social->id }}">
                        <div class="modal-body">
                            <div class="p-3 row align-items-center">
                                <div class="pb-3 col-md-4">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Facebook UserName</label>
                                        <input class="form-control @error('sm_facebook') is-invalid @enderror"
                                            type="text" name="sm_facebook" placeholder="Enter Facebook UserName"
                                            value="{{ $social->sm_facebook }}">
                                        @error('sm_facebook')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-4">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Twitter UserName</label>
                                        <input class="form-control @error('sm_twitter') is-invalid @enderror" type="text"
                                            name="sm_twitter" placeholder="Enter Twitter UserName"
                                            value="{{ $social->sm_twitter }}">
                                        @error('sm_twitter')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-4">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Linkedin UserName</label>
                                        <input class="form-control @error('sm_linkedin') is-invalid @enderror"
                                            type="text" name="sm_linkedin" placeholder="Enter Linkedin UserName"
                                            value="{{ $social->sm_linkedin }}">
                                        @error('sm_linkedin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-4">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Youtube UserName</label>
                                        <input class="form-control @error('sm_youtube') is-invalid @enderror" type="text"
                                            name="sm_youtube" placeholder="Enter Youtube UserName"
                                            value="{{ $social->sm_youtube }}">
                                        @error('sm_youtube')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-4">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Pinterest UserName</label>
                                        <input class="form-control @error('sm_pinterest') is-invalid @enderror"
                                            type="text" name="sm_pinterest" placeholder="Enter Pinterest UserName"
                                            value="{{ $social->sm_pinterest }}">
                                        @error('sm_pinterest')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-4">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Instagram UserName</label>
                                        <input class="form-control @error('sm_instagram') is-invalid @enderror"
                                            type="text" name="sm_instagram" placeholder="Enter Instagram UserName"
                                            value="{{ $social->sm_instagram }}">
                                        @error('sm_instagram')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="w-2 bx bx-save"></i> Social Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
