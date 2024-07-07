<div class="tab-pane fade" id="address" role="tabpanel">
    <form action="{{ route('web.user.address.update') }}" method="POST">
        @csrf
        <div class="customer_profile">
            <div class="row profile_details">
                <div class="col-md-2"></div>
                <div class="col-md-8 customer_address">
                    <h4>Billing Address</h4>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                    </div>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">Postel Code</label>
                        <input name="post_code" type="number" class="form-control"
                            value="{{ $user->post_code }}" placeholder="Post Code">
                    </div>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">City</label>
                        <input name="city" type="text" class="form-control"
                            placeholder="City" value="{{ $user->city }}">
                    </div>
                    <div class="mb-3 input-group-sm ">
                        <label class="form-label">Country</label>
                        <select name="country" class="form-control">
                            <option label="Select Country"></option>
                            <option value="bangladesh"
                                {{ $user->country == 'bangladesh' ? 'selected' : '' }}>
                                Bangladesh</option>
                            <option value="india"
                                {{ $user->country == 'india' ? 'selected' : '' }}>India
                            </option>
                        </select>
                    </div>
                    
                    
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn profile_submit_btn">Update</button>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </form>
</div>