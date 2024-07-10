@extends('frontend.layouts.app')
@section('frontend-title', 'Electrician')
@section('web.content')
    {{-- electrician profile start --}}
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
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        {{-- <td></td> --}}
                                        <td>{{ $data->first_name . ' ' . $data->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone No</td>
                                        <td>:</td>
                                        <td>{{ $data->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td>:</td>
                                        <td>{{ $data->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nid</td>
                                        <td>:</td>
                                        <td>{{ $data->nid_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Electrician Category</td>
                                        <td>:</td>
                                        <td>{{ $data->electrician->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address1</td>
                                        <td>:</td>
                                        <td>
                                            {{ $data->division->name }},
                                            {{ $data->district->name }},
                                            {{ $data->upazila->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address2</td>
                                        <td>:</td>
                                        <td>{{ $data->address2 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Facebook Account</td>
                                        <td>:</td>
                                        <td>{{ $data->fb_account }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nid Image</td>
                                        <td>:</td>
                                        <td>{{ $data->nid_image }}</td>
                                    </tr>
                                </tbody>
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
