<div class="mt-4 ms-3 mb-5">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
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
                <div class="col-12 mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input name="confirm_password" type="text"
                        class="form-control" placeholder="Enter Confirm New Password">
                </div>
                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-md btn-dark">Change Password</button>
                </div>
            </form>
        </div>
        <div class="col-md-5"></div>
    </div>
</div>