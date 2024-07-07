<div class="tab-pane fade" id="profile" role="tabpanel">
    <form action="{{ route('web.user.details.update') }}" method="POST">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @csrf
        <div class="customer_profile">
            <div class="row profile_details">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">First Name</label>
                        <input value="{{ Auth::user()->first_name }}" name="first_name"
                        type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">Last Name</label>
                        <input value="{{ Auth::user()->last_name }}" name="last_name"
                            type="text" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">Email address</label>
                        <input  type="text" class="form-control" name="email"
                            value="{{ $user->email }}" placeholder="Email">
                    </div>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">Phone Number</label>
                        <input  type="text" class="form-control" name="phone"
                            value="{{ $user->phone }}" placeholder="">
                    </div>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control"
                            value="" placeholder="">
                    </div>
                    <form class="row g-3" action="{{ route('web.user.password.change') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="col-12">
                            <label class="form-label">Current Password</label>
                            <input required name="current_password" type="text"
                                class="form-control" placeholder="Enter your Old Password">
                        </div>
                        <div class="col-12">
                            <label class="form-label">New Password</label>
                            <input name="new_password" type="text" class="form-control"
                                placeholder="Enter New Password">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Confirm New Password</label>
                            <input name="confirm_password" type="text"
                                class="form-control" placeholder="Enter Confirm New Password">
                        </div>
                        
                    </form>
                    <div class="col-md-12 mt-3 text-center">
                        <button type="submit" class="btn profile_submit_btn">UPDATE</button>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </form>
</div>