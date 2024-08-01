@extends('backend.layouts.layout')
@section('admin-title', 'Order Management')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18"></h4>
            <div class="page-title-right">
                <ol class="m-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="#"></a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card_header">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="card-title card_title"> Profile </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            {{-- <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button">Profile</button> --}}
                            <button class="nav-link active" id="document-tab" data-bs-toggle="tab" data-bs-target="#admissionInfo"
                                type="button">Update Profile</button>
                            <button class="nav-link" id="document-tab" data-bs-toggle="tab" data-bs-target="#admissionDocument"
                                type="button">Change Password</button>
                        </div>
                    </nav>

                    <div class="tab-content text-black" id="nav-tabContent">
                        {{-- <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            @include('partner.profile.include.profile')
        
                        </div> --}}
        
                        <div class="tab-pane fade show active" id="admissionInfo" role="tabpanel">
                            @include('partner.profile.include.edit-profile')
                        </div>
        
                        <div class="tab-pane fade" id="admissionDocument" role="tabpanel">
                            @include('partner.profile.include.change-password')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
