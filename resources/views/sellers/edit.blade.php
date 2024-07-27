@extends('layouts.admin')

@section('title', 'Update sellers')
@section('content-header', 'Update sellers')
@section('content-actions')
    <a href="{{ route('sellers.index') }}" class="btn btn-success"><i class="fas fa-back"></i> Back To sellers</a>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('sellers.update', $sellers) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <br>
                    <label for="your_name">Name</label>
                    <input type="text" name="your_name" class="form-control @error('your_name') is-invalid @enderror"
                           id="your_name"
                           placeholder="Your Name" value="{{ old('your_name', $sellers->your_name) }}">
                    @error('your_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="store_name">Store Name</label>
                    <input type="text" name="store_name" class="form-control @error('store_name') is-invalid @enderror"
                           id="store_name"
                           placeholder="Store Name" value="{{ old('store_name', $sellers->store_name) }}">
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
                           placeholder="mobile" value="{{ old('mobile', $sellers->mobile) }}">
                    @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           placeholder="email" value="{{ old('email', $sellers->email) }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror" id="profession">
                        <option value=''>--select--</option>
                        <option value='clothing' {{ strtolower(old('category', $sellers->category)) == 'clothing' ? 'selected' : '' }}>
                            Clothing
                        </option>
                        <option value='electronic' {{ strtolower(old('category', $sellers->category)) == 'electronic' ? 'selected' : '' }}>
                            Electronic
                        </option>
                        <option value='jewellery' {{ strtolower(old('category', $sellers->category)) == 'jewellery' ? 'selected' : '' }}>
                            Jewellery
                        </option>
                        <option value='shoes' {{ strtolower(old('category', $sellers->category)) == 'shoes' ? 'selected' : '' }}>
                            Shoes
                        </option>
                    </select>
                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="store_address">Store Address</label>
                    <input type="text" name="store_address" class="form-control @error('store_address') is-invalid @enderror"
                           id="store_address"
                           placeholder="Store Address" value="{{ old('store_address', $sellers->store_address) }}">
                    @error('store_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="seller_status">seller Status</label>
                    <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                        <label class="btn btn-outline-success {{ old('seller_status', $sellers->seller_status) === 1 ? 'active' : '' }}">
                            <input type="radio" name="seller_status" id="status_activated" value="1" {{ old('seller_status', $sellers->seller_status) === 1 ? 'checked' : '' }}> Approved
                        </label>
                        <label class="btn btn-outline-primary {{ old('seller_status', $sellers->seller_status) === 2 ? 'active' : '' }}">
                            <input type="radio" name="seller_status" id="status_pending" value="2" {{ old('seller_status', $sellers->seller_status) === 2 ? 'checked' : '' }}> Pending
                        </label>
                        <label class="btn btn-outline-danger {{ old('seller_status', $sellers->seller_status) === 3 ? 'active' : '' }}">
                            <input type="radio" name="seller_status" id="status_cancelled" value="3" {{ old('seller_status', $sellers->seller_status) === 3 ? 'checked' : '' }}> Cancelled
                        </label>
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
