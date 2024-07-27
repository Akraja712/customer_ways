@extends('layouts.admin')

@section('title', 'Update users')
@section('content-header', 'Update users')
@section('content-actions')
    <a href="{{ route('users.index') }}" class="btn btn-success"><i class="fas fa-back"></i> Back To Users</a>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('users.update', $users) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <a href="{{ route('users.add_points', $users->id) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Points</a>
                <div class="form-group">
                    <br>
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           placeholder="Name" value="{{ old('name', $users->name) }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="number" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                           id="mobile"
                           placeholder="mobile" value="{{ old('mobile', $users->mobile) }}">
                    @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="unique_name">Unique Name</label>
                    <input type="text" name="unique_name" class="form-control @error('unique_name') is-invalid @enderror"
                           id="unique_name"
                           placeholder="Unique Name" value="{{ old('unique_name', $users->unique_name) }}">
                    @error('unique_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror"
                           id="dob"
                           placeholder="dob" value="{{ old('dob', $users->dob) }}">
                    @error('dob')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="referred_by">Referred By</label>
                    <input type="text" name="referred_by" class="form-control @error('referred_by') is-invalid @enderror"
                           id="referred_by"
                           placeholder="referred_by" value="{{ old('referred_by', $users->referred_by) }}">
                    @error('referred_by')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="refer_code">Refer Code</label>
                    <input type="text" name="refer_code" class="form-control @error('refer_code') is-invalid @enderror"
                           id="refer_code"
                           placeholder="refer_code" value="{{ old('refer_code', $users->refer_code) }}">
                    @error('refer_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="points">Points</label>
                    <input type="number" name="points" class="form-control @error('points') is-invalid @enderror"
                           id="points"
                           placeholder="points" value="{{ old('points', $users->points) }}">
                    @error('points')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="total_points">Total Points</label>
                    <input type="number" name="total_points" class="form-control @error('total_points') is-invalid @enderror"
                           id="total_points"
                           placeholder="Total Points" value="{{ old('total_points', $users->total_points) }}">
                    @error('total_points')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <span>Current Profile:</span>
                    <img src="{{ asset('storage/app/public/users/' . $users->profile) }}" alt="{{ $users->name }}" style="max-width: 100px; max-height: 100px;">
                    <br>
                    <label for="profile">New Profile</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="profile" id="profile">
                        <label class="custom-file-label" for="profile">Choose file</label>
                        @if($users->profile)
                            <input type="hidden" name="existing_profile" value="{{ $users->profile }}">
                        @endif
                    </div>
                    @error('profile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                    <div class="form-group">
                        <span>Current Cover Image:</span>
                        <img src="{{ asset('storage/app/public/users/' . $users->cover_img) }}" alt="{{ $users->name }}" style="max-width: 100px; max-height: 100px;">
                        <br>
                        <label for="profile">New Cover Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cover_img" id="cover_img">
                            <label class="custom-file-label" for="cover_img">Choose file</label>
                            @if($users->cover_img)
                                <input type="hidden" name="existing_cover_img" value="{{ $users->cover_img }}">
                            @endif
                        </div>
                        @error('cover_img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="verified">Verified</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="verified" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="verified" class="custom-control-input @error('verified') is-invalid @enderror" id="verified" value="1" {{ old('verified', $users->verified) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="verified"></label>
                        </div>
                        @error('verified')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="online_status">Online Status</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="online_status" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="online_status" class="custom-control-input @error('online_status') is-invalid @enderror" id="online_status" value="1" {{ old('online_status', $users->online_status) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="online_status"></label>
                        </div>
                        @error('online_status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dummy">Dummy</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="dummy" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="dummy" class="custom-control-input @error('dummy') is-invalid @enderror" id="dummy" value="1" {{ old('dummy', $users->dummy) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="dummy"></label>
                        </div>
                        @error('dummy')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message_notify">Message Notify</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="message_notify" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="message_notify" class="custom-control-input @error('message_notify') is-invalid @enderror" id="message_notify" value="1" {{ old('message_notify', $users->message_notify) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="message_notify"></label>
                        </div>
                        @error('message_notify')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="add_customer_notify">Add Customer Notify</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="add_customer_notify" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="add_customer_notify" class="custom-control-input @error('add_customer_notify') is-invalid @enderror" id="add_customer_notify" value="1" {{ old('add_customer_notify', $users->add_customer_notify) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="add_customer_notify"></label>
                        </div>
                        @error('add_customer_notify')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="view_notify">View Notify</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="view_notify" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="view_notify" class="custom-control-input @error('view_notify') is-invalid @enderror" id="view_notify" value="1" {{ old('view_notify', $users->view_notify) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="view_notify"></label>
                        </div>
                        @error('view_notify')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profile_verified">Profile Verified</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="profile_verified" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="profile_verified" class="custom-control-input @error('profile_verified') is-invalid @enderror" id="profile_verified" value="1" {{ old('profile_verified', $users->profile_verified) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="profile_verified"></label>
                        </div>
                        @error('profile_verified')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="cover_img_verified">Cover Image Verified</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="cover_img_verified" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="cover_img_verified" class="custom-control-input @error('cover_img_verified') is-invalid @enderror" id="cover_img_verified" value="1" {{ old('cover_img_verified', $users->cover_img_verified) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="cover_img_verified"></label>
                        </div>
                        @error('cover_img_verified')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="seller_status">Seller Status</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="seller_status" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="seller_status" class="custom-control-input @error('seller_status') is-invalid @enderror" id="seller_status" value="1" {{ old('seller_status', $users->seller_status) == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="seller_status"></label>
                        </div>
                        @error('seller_status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                <button class="btn btn-success btn-block btn-lg" type="submit">Save Changes</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('profile');
    const fileInputLabel = fileInput.nextElementSibling;

    fileInput.addEventListener('change', function () {
        const fileName = this.files[0].name;
        fileInputLabel.textContent = fileName;
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('cover_img');
    const fileInputLabel = fileInput.nextElementSibling;

    fileInput.addEventListener('change', function () {
        const fileName = this.files[0].name;
        fileInputLabel.textContent = fileName;
    });
});
</script>
@endsection
