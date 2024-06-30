@extends('backend.layouts.layout')
@section('admin-title', 'Thanks Note Setting')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Analytic Setting</b></h4>
                </div>
                <div class="card-body px-2">
                    <form action="{{ route('admin.setting.thanks.note.update') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row  align-items-center p-3">
                                <div class="col-md-12 pb-3">
                                    <div class="form-group mb-2">
                                        <p>
                                            <b class="text-danger fs-4">Importent Notes <span class="text-warning">!</span></b>
                                            <br>
                                            <small>Thanks Note will be shown on the Order Complect page.</small>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12 pb-3">
                                    <div class="form-group mb-2">
                                        <label class="form-label text-warning">Thanks Note Here</label>
                                        <textarea class="form-control" name="thanks_note" placeholder="Enter Notes" style="height: 200px;">{{ $notes->thanks_notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-sync w-2"></i> Note Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
