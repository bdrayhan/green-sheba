@extends('backend.layouts.layout')
@section('admin-title', 'Contact Information')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Contact Information</b></h4>
                </div>
                <div class="px-2 card-body">
                    <form action="{{ route('admin.contact.info.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $contactinfo->id }}">
                        <div class="modal-body">
                            <div class="p-3 row align-items-center">
                                <div class="pb-3 col-md-6">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Phone Number 1</label>
                                        <input class="form-control @error('ci_phone1') is-invalid @enderror" type="text"
                                            name="ci_phone1" placeholder="Enter Phone Number 1"
                                            value="{{ $contactinfo->ci_phone1 }}">
                                        @error('ci_phone1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-6">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Phone Number 2</label>
                                        <input class="form-control @error('ci_phone2') is-invalid @enderror" type="text"
                                            name="ci_phone2" placeholder="Enter Phone Number 2"
                                            value="{{ $contactinfo->ci_phone2 }}">
                                        @error('ci_phone2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-6">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Email 1</label>
                                        <input class="form-control @error('ci_email1') is-invalid @enderror" type="email"
                                            name="ci_email1" placeholder="Enter Email 1"
                                            value="{{ $contactinfo->ci_email1 }}">
                                        @error('ci_email1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-6">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Email 2</label>
                                        <input class="form-control @error('ci_email') is-invalid @enderror" type="text"
                                            name="ci_email" placeholder="Enter Email 2"
                                            value="{{ $contactinfo->ci_email }}">
                                        @error('ci_email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-6">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Address 1</label>
                                        <textarea class="form-control" name="ci_address1" placeholder="Enter Address 1">{{ $contactinfo->ci_address1 }}</textarea>
                                        @error('ci_address1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pb-3 col-md-6">
                                    <div class="mb-2 form-group">
                                        <label class="form-label">Working Time</label>
                                        <textarea class="form-control" name="ci_working_info" placeholder="Working Time">{{ $contactinfo->ci_working_info }}</textarea>
                                        @error('ci_working_info')
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
                                <i class="w-2 bx bx-save"></i> Setting Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
