@extends('backend.layouts.layout')
@section('admin-title', 'Support Message View')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <img class="rounded-circle avatar-sm"
                                src="{{ asset('backend') }}/assets/images/users/avatar-2.jpg" alt="Generic placeholder image">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-14 mt-1">{{ $supportInfo->support_name }}</h5>
                            <small class="text-muted">{{ $supportInfo->support_email }}</small><br>
                            <small class="text-muted">{{ $supportInfo->support_phone }}</small>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.support.message.index') }}" class="btn btn-primary btn-sm">Back</a>
                        </div>
                    </div>
                    <p>{{ $supportInfo->support_message }}</p>
                    <hr>
                </div>
            </div>
        </div>
        <!-- card -->
    </div>
    <!-- end Col-9 -->

    </div>

@endsection
