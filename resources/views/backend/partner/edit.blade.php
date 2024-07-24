@extends('backend.layouts.layout')
@section('admin-title', 'Order Management')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Partner Update</h4>

            <div class="page-title-right">
                <ol class="m-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Partner</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<section class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.partner.profile.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            @if (Session::has('success'))
                                <div class="alert alert-success alertsuccess" role="alert">
                                    <strong>Success!</strong> {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger alerterror" role="alert">
                                    <strong>Opps!</strong> {{ Session::get('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" col-form-label col_form_label"> Name<span
                                    class="req_star">*</span>:</label>
                            <div class="">
                                <input type="text" class="form-control form_control" name="name"
                                    placeholder="Enter name" value="{{$data->partner_name}}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-form-label col_form_label">Phone<span class="req_star">*</span>:</label>
                            <input type="tel" class="form-control form_control" name="phone"
                                placeholder="Enter Phone number" value="{{$data->phone}}" required>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                            <div class="">
                                <input type="text" class="form-control form_control" name="email"
                                    placeholder="Enter  email address" value="{{$data->email}}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                            <label class="col-form-label col_form_label">Date of Birth:</label>
                            <input type="date" class="form-control form_control" name="date_of_birth"
                                placeholder="Enter Phone number" value="{{$data->date_of_birth}}">
                            @if ($errors->has('date_of_birth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('nid_number') ? ' has-error' : '' }}">
                            <label class="col-form-label col_form_label">Nid<span class="req_star">*</span>:</label>
                            <input type="number" class="form-control form_control" name="nid_number"
                                placeholder="Enter Nid number" value="{{$data->nid}}" required>
                            @if ($errors->has('nid_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nid_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-form-label col_form_label">Address :</label>
                            <textarea class="form-control form_control" name="address"
                                placeholder="Enter Address" value="">{{ $data->address }}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('partner_title') ? ' has-error' : '' }}">
                            <label class="col-form-label col_form_label">Partner Title :</label>
                            <input type="text" class="form-control form_control" name="partner_title"
                                placeholder="Enter Partner Title" value="{{$data->partner_title}}">
                            @if ($errors->has('partner_title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('partner_title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('partner_url') ? ' has-error' : '' }}">
                            <label class="col-form-label col_form_label">Partner Url :</label>
                            <input type="text" class="form-control form_control" name="partner_url"
                                placeholder="Enter Partner Url" value="{{$data->partner_url}}">
                            @if ($errors->has('partner_url'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('partner_url') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('partner_logo') ? ' has-error' : '' }}">
                            <div class="row">
                                <label class="col-form-label col_form_label"> Parner Logo :</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-btn"  style="background: #f2f2f2">
                                            <span class="btn btn-default btn-file btnu_browse">
                                                Browse… <input type="file" name="partner_logo" id="imgInp">
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <img height="100px" src="{{asset('frontend')}}/assets/images/avatars/avatar-1.png" alt="">
                                </div>
                            </div>
                            @if ($errors->has('partner_logo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('partner_logo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3  {{ $errors->has('nid_image') ? ' has-error' : '' }}">
                            <div class="row">
                                <label class="col-form-label col_form_label">Nid Image :</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-btn"  style="background: #f2f2f2">
                                            <span class="btn btn-default btn-file btnu_browse">
                                                Browse… <input type="file" name="nid_image" id="imgInp">
                                            </span>
                                        </span>
                                        {{-- <input type="text" class="form-control" readonly> --}}
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <img width="100px" height="100px" src="{{asset('frontend')}}/assets/images/avatars/avatar-1.png" alt="">
                                    <img width="100px" height="100px" src="{{asset('frontend')}}/assets/images/avatars/avatar-1.png" alt="">
                                </div>
                            </div>
                            @if ($errors->has('nid_image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nid_image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 mb-3 {{ $errors->has('image') ? ' has-error' : '' }}">
                            <div class="row">
                                <label class="col-form-label col_form_label"> Image :</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-btn"  style="background: #f2f2f2">
                                            <span class="btn btn-default btn-file btnu_browse">
                                                Browse… <input type="file" name="image" id="imgInp">
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <img height="100px" src="{{asset('frontend')}}/assets/images/avatars/avatar-1.png" alt="">
                                </div>
                            </div>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer card_footer text-center">
                        <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



@endsection
