@extends('backend.layouts.layout')
@section('admin-title', 'Order Management')
@section('admin_content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Electrician</h4>

            <div class="page-title-right">
                <ol class="m-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Electrician</a></li>
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
                            <h4 class="card-title card_title"> View Electrician Information</h4>
                        </div>
                        {{-- <div class="col-md-4 text-end">
                            <a href="{{ route('web.electrician.home') }}"
                                class="btn btn-secondary btn-md waves-effect btn-label waves-light card_btn"><i
                                    class="fas fa-th label-icon"></i> Electricians</a>
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
                    <div class="row">
                        <div class="col-md-4 text-center mt-4">
                            <img width="300px" src="{{asset('frontend')}}/assets/images/avatars/avatar-1.png" alt="">
                        </div>
                        <div class="col-md-8 mt-4">
                            <table
                                class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                                
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td></td>
                                    {{-- <td>{{ $data->first_name . ' ' . $data->last_name }}</td> --}}
                                </tr>
                                <tr>
                                    <td>Phone No</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        {{-- <div class="col-md-2"></div> --}}
                    </div>
                </div>
                {{-- <div class="card-footer card_footer">
                    <div class="btn-group mt-2" role="group">
                        <a href="#" onclick="window.print()" class="btn btn-secondary">Print</a>
                        <a href="#" class="btn btn-dark">PDF</a>
                        <a href="#" class="btn btn-secondary">Excel</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>



@endsection
