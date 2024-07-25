@extends('layouts.admin')

@section('title', 'Create sellers')
@section('content-header', 'Create sellers')
@section('content-actions')
    <a href="{{route('sellers.index')}}" class="btn btn-success"><i class="fas fa-back"></i>Back To sellers</a>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('sellers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="your_name">Your Name</label>
                    <input type="text" name="your_name" class="form-control @error('your_name') is-invalid @enderror"
                           id="your_name"
                           placeholder="Your name" value="{{ old('your_name') }}">
                    @error('your_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="store_name">Store Name</label>
                    <input type="text" name="store_name" class="form-control @error('store_name') is-invalid @enderror" id="dob"
                           placeholder="store_name" value="{{ old('store_name') }}">
                    @error('store_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
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
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="referred_by"
                        placeholder="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                <br>
                    <label for="category">Select Category</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror" id="category">
                        <option value=''>--select--</option>
                        <option value='clothing' {{ old('category') == 'clothing' ? 'selected' : '' }}>clothing</option>
                        <option value='electronic' {{ old('category') == 'electronic' ? 'selected' : '' }}>electronic</option>
                        <option value='jewellery' {{ old('category') == 'jewellery' ? 'selected' : '' }}>jewellery</option>
                        <option value='shoes' {{ old('category') == 'shoes' ? 'selected' : '' }}>shoes</option>
                    </select>
                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="store_address">Store Address</label>
                    <input type="store_address" name="store_address" class="form-control @error('store_address') is-invalid @enderror" id="referred_by"
                        placeholder="Store Address" value="{{ old('store_address') }}">
                    @error('store_address')
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
