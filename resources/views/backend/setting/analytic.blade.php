@extends('backend.layouts.layout')
@section('admin-title', 'Analytic Setting')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Analytic Setting</b></h4>
                </div>
                <div class="card-body px-2">
                    <form action="{{ route('admin.analytic.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $analytic->id }}">
                        <div class="modal-body">
                            <div class="row  align-items-center p-3">
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-warning">Google Analytic</label>
                                        <textarea class="form-control" name="google_analytic" placeholder="Google Analytic">{{ $analytic->google_analytic }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-info">Facebook Pixel</label>
                                        <textarea class="form-control" name="facebook_pixel" placeholder="Facebook Pixel">{{ $analytic->facebook_pixel }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-success">Bing Analytic</label>
                                        <textarea class="form-control" name="bing_analytic" placeholder="Bing Analytic">{{ $analytic->bing_analytic }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-warning">Google Site Verification</label>
                                        <input class="form-control @error('google_site_verification') is-invalid @enderror"
                                            type="text" name="google_site_verification"
                                            placeholder="Enter Google Site Verification"
                                            value="{{ $analytic->google_site_verification }}">
                                        @error('google_site_verification')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-info">Facebook Site Verification</label>
                                        <input
                                            class="form-control @error('facebook_site_verification') is-invalid @enderror"
                                            type="text" name="facebook_site_verification"
                                            placeholder="Enter Facebook Site Verification"
                                            value="{{ $analytic->facebook_site_verification }}">
                                        @error('facebook_site_verification')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-success">Bing Site Verification</label>
                                        <input class="form-control @error('bing_site_verification') is-invalid @enderror"
                                            type="text" name="bing_site_verification"
                                            placeholder="Enter Bing Site Verification"
                                            value="{{ $analytic->bing_site_verification }}">
                                        @error('bing_site_verification')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label">Custom Header Script</label>
                                        <textarea class="form-control" name="custom_header_script" rows="5">{{ $analytic->custom_header_script }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label">Custom Footer Script</label>
                                        <textarea class="form-control" name="custom_footer_script" rows="5">{{ $analytic->custom_footer_script }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-sync w-2"></i> Analytic Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
