<div class="mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card_header">
                    <div class="row">
                        <div class="col-md-12 text-center">
                        </div>
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
                                    <td>{{ $data->partner_name }}</td>
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
                                    <td>{{ $data->nid}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td>{{ $data->address }}</td>
                                </tr>
                                <tr>
                                    <td>Nid Image</td>
                                    <td>:</td>
                                    <td>{{ $data->nid_img }}</td>
                                </tr>
                                <tr>
                                    <td>Partner Title</td>
                                    <td>:</td>
                                    <td>{{ $data->partner_title }}</td>
                                </tr>
                                <tr>
                                    <td>Partner Url</td>
                                    <td>:</td>
                                    <td>{{ $data->partner_url }}</td>
                                </tr>
                                <tr>
                                    <td>Partner Logo</td>
                                    <td>:</td>
                                    <td>{{ $data->partner_logo }}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>