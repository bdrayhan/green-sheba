@extends('frontend.layouts.app')
@section('frontend-title', 'Electrician')
@section('web.content')
    {{-- electrician start --}}
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                        <div class="row mb-5">
                            <h1 class="mb-5 mt-4 " style="font-size: 36px; font-weight: 800;">All Electrician</h1>
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                    <form action="{{ url('/electrician/search') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3 ">
                                                    <label for="business_name">Division<span class="text-danger">*</span></label>
                                                    @php
                                                        $divisions=App\Models\Division::orderBy('name','ASC')->get();
                                                    @endphp
                                                    <select id="division-dd" name="division" class="form-select" aria-label="Default select example">
                                                        <option value="" >Select Division</option>
                                                        @foreach($divisions as $data)
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                @php
                                                    $district= App\Models\District::orderBy('name','ASC')->get();
                                                @endphp
                                                <div class="mb-3 ">
                                                    <label for="business_name">District<span class="text-danger">*</span></label>
                                                    <select id="division-dd" name="district" class="form-select" aria-label="Default select example">
                                                        <option value="">Select District</option>
                                                        @foreach($district as $data)
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                @php
                                                    $upazila=App\Models\Upazila::orderBy('name','ASC')->get();
                                                @endphp
                                                <div class="mb-3 ">
                                                    <label for="business_name">Upazila/Thana<span class="text-danger">*</span></label>
                                                    <select id="division-dd" name="upazila" class="form-select" aria-label="Default select example">
                                                        <option value="">Select Upazila</option>
                                                        @foreach($upazila as $data)
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top: 22px">
                                                <button class="btn btn-success common_btn" id="submit" type="submit">Search</button>
                                                {{-- <a href="#" class="btn btn-primary ms-3">Reset</a> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <div class="col-md-2"></div>
                        </div>
                        <table id="alltableinfo"
                            class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table mt-4">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                                @php
                                    $electricians=App\Models\Electrician::orderBy('id','ASC')->get();
                                @endphp
                            <tbody>
                                @foreach($electricians as $data)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $data->first_name }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->electrician->name }}</td>
                                        <td>
                                            {{ $data->division->name}},
                                            {{ $data->district->name }},
                                            {{ $data->upazila->name }}
                                        </td>
                                        {{-- <td>active</td> --}} 
                                        <td><a href="{{url('electrician/profile/'.$data->slug)}}">view details</a></td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
