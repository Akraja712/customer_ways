@extends('layouts.admin')

@section('title', 'Create users')
@section('content-header', 'Create users')
@section('content-actions')
    <a href="{{route('users.index')}}" class="btn btn-success"><i class="fas fa-back"></i>Back To Users</a>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           placeholder="name" value="{{ old('name') }}">
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
                           placeholder="mobile" value="{{ old('mobile') }}">
                    @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob"
                           placeholder="dob" value="{{ old('dob') }}">
                    @error('dob')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
    <label for="referred_by">Referred By</label>
    <input type="text" name="referred_by" class="form-control @error('referred_by') is-invalid @enderror" id="referred_by"
           placeholder="referred_by" value="{{ old('referred_by') }}">
    @error('referred_by')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


                 <div class="form-group">
                    <label for="profile">Profile</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="profile" id="profile" onchange="updateProfileLabel(this)">
                        <label class="custom-file-label" for="profile" id="profile-label">Choose File</label>
                    </div>
                    @error('profile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dummy">Dummy</label>
                    <div class="custom-control custom-switch">
                        <input type="hidden" name="dummy" value="0"> <!-- Hidden input to ensure a value is always submitted -->
                        <input type="checkbox" name="dummy" class="custom-control-input @error('dummy') is-invalid @enderror" id="dummy" value="1" {{ old('dummy') ? 'checked' : '' }}>
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
                        <input type="checkbox" name="message_notify" class="custom-control-input @error('message_notify') is-invalid @enderror" id="message_notify" value="1" {{ old('message_notify') ? 'checked' : '' }}>
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
                        <input type="checkbox" name="add_customer_notify" class="custom-control-input @error('add_customer_notify') is-invalid @enderror" id="add_customer_notify" value="1" {{ old('add_customer_notify') ? 'checked' : '' }}>
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
                        <input type="checkbox" name="view_notify" class="custom-control-input @error('view_notify') is-invalid @enderror" id="view_notify" value="1" {{ old('view_notify') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="view_notify"></label>
                    </div>
                    @error('view_notify')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

              

                <button class="btn btn-success btn-block btn-lg" type="submit">Submit</button>
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

        function updateProfileLabel(input) {
            var fileName = input.files[0].name;
            var label = $(input).siblings('.custom-file-label');
            label.text(fileName);
        }
    </script>
     <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });

        function updateProfileLabel(input) {
            var fileName = input.files[0].name;
            var label = $(input).siblings('.custom-file-label');
            label.text(fileName);
        }
    </script>
@endsection
