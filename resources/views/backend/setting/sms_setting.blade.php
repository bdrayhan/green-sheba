@extends('backend.layouts.layout')
@section('admin-title', 'SMS Setting')
@section('admin_content')
{{-- @dd($sms) --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>SMS Setting</b></h4>
                </div>
                <div class="card-body px-2">
                    <form action="{{ route('admin.sms.update') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row  align-items-center p-3">
                                <div class="col-md-6 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-warning">SMS Api</label>
                                        <input type="text" name="sms_api_key" class="form-control" value="{{ $sms->sms_api_key }}">
                                    </div>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-warning">Sender ID</label>
                                        <input type="number" name="sms_sender_id" class="form-control" value="{{ $sms->sms_sender_id }}">
                                    </div>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-warning">Type</label>
                                        <select class="form-control" name="sms_type" id="sms_type">
                                            <option value="1" {{ $sms->sms_type === 1 ? 'selected' : '' }}>Text</option>
                                            <option value="2" {{ $sms->sms_type === 2 ? 'selected' : '' }}>Unicode</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-warning">Status</label>
                                        <select name="sms_status" id="sms_status" class="form-control">
                                            <option value="1" {{ $sms->sms_status === 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $sms->sms_status === 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-sync w-2"></i>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
