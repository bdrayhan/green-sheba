@extends('frontend.layouts.app')
@section('frontend-title', 'Electricians Registration form')
@section('web.content')
    {{-- electrician start --}}
    <section class="container">
        <div class="row">
            <div class="col-12">
                <form method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header card_header">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="card-title card_title"> Electrician Registration form</h4>
                                </div>
                                {{-- <div class="col-md-4 text-end">
                                    <a href="{{ route('web.electrician.home') }}" class="btn btn-secondary text-light btn-md waves-effect btn-label waves-light card_btn">
                                        <i class="fas fa-th label-icon"></i> Electricians
                                    </a>
                                </div> --}}
                            </div>
                        </div>
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
                                <div class="form-group col-md-4 mb-3 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label class=" col-form-label col_form_label">First Name<span
                                            class="req_star">*</span>:</label>
                                    <div class="">
                                        <input type="text" class="form-control form_control" name="first_name"
                                            placeholder="Enter name" value="{{old('first_name')}}">
                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mb-3 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label class=" col-form-label col_form_label">Last Name:</label>
                                    <div class="">
                                        <input type="text" class="form-control form_control" name="last_name"
                                            placeholder="Enter name" value="{{old('last_name')}}">
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-8 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label class="col-form-label col_form_label">Phone<span class="req_star">*</span>:</label>
                                    <input type="text" class="form-control form_control" name="phone"
                                        placeholder="Enter Phone number" value="{{old('phone')}}">
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
                                            placeholder="Enter  email address" value="{{old('email')}}">
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
                                        placeholder="Enter Phone number" value="{{old('date_of_birth')}}">
                                    @if ($errors->has('date_of_birth'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-8 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label class="col-form-label col_form_label">Nid<span class="req_star">*</span>:</label>
                                    <input type="text" class="form-control form_control" name="phone"
                                        placeholder="Enter Phone number" value="{{old('phone')}}">
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-8 mb-3 {{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label class="col-form-label col_form_label">Electrician Category<span class="req_star">*</span>:</label>
                                    <div class="">
                                        
                                        <select name="role" id="" class="form-control form_control">
                                            <option value="">Choose Category</option>
                                            <option value="1">Ac Electrician</option>
                                            <option value="1">Ac Electrician</option>
                                            <option value="1">Ac Electrician</option>
                                            <option value="1">Ac Electrician</option>
                                            <option value="1">Ac Electrician</option>
                                            <option value="1">Ac Electrician</option>
                                            <option value="1">Ac Electrician</option>
                                        </select>
                                        @if ($errors->has('role'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    <div class="row">
                                        <div class="form-group col-md-4 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label class="col-form-label col_form_label">Distric<span class="req_star">*</span>:</label>
                                            <input type="text" class="form-control form_control" name="phone"
                                                placeholder="Enter Phone number" value="{{old('phone')}}">
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label class="col-form-label col_form_label">Division<span class="req_star">*</span>:</label>
                                            <input type="text" class="form-control form_control" name="phone"
                                                placeholder="Enter Phone number" value="{{old('phone')}}">
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label class="col-form-label col_form_label">Thana<span class="req_star">*</span>:</label>
                                            <input type="text" class="form-control form_control" name="phone"
                                                placeholder="Enter Phone number" value="{{old('phone')}}">
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group col-md-8 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label class="col-form-label col_form_label">Address<span class="req_star">*</span>:</label>
                                    <textarea class="form-control form_control" name="phone"
                                        placeholder="Enter Phone number" value="{{old('phone')}}"></textarea>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-8 mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label class="col-form-label col_form_label">Fb Account Link :</label>
                                    <input type="text" class="form-control form_control" name="phone"
                                        placeholder="Enter Phone number" value="{{old('phone')}}">
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    <div class="row">
                                        <label class="col-form-label col_form_label">Nid Image :</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-btn"  style="background: #f2f2f2">
                                                    <span class="btn btn-default btn-file btnu_browse">
                                                        Browse… <input type="file" name="pic" id="imgInp">
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
                                </div>
                                <div class="form-group col-md-8 mb-3">
                                    <div class="row">
                                        <label class="col-form-label col_form_label"> Image :</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-btn"  style="background: #f2f2f2">
                                                    <span class="btn btn-default btn-file btnu_browse">
                                                        Browse… <input type="file" name="pic" id="imgInp">
                                                    </span>
                                                </span>
                                                {{-- <input type="text" class="form-control" readonly> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <img height="100px" src="{{asset('frontend')}}/assets/images/avatars/avatar-1.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-4">
                                <img id="img-upload" />
                            </div> --}}
                        </div>
    
                        <div class="card-footer card_footer text-center">
                            <button type="submit" class="btn btn-md btn-dark">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
