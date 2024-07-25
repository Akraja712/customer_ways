@extends('layouts.admin')

@section('title', 'Update products')
@section('content-header', 'Update products')
@section('content-actions')
    <a href="{{route('products.index')}}" class="btn btn-success"><i class="fas fa-back"></i>Back To product</a>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('products.update', $products) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="number" name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                           id="user_id"
                           placeholder="User ID" value="{{ old('user_id', $products->user_id) }}">
                    @error('user_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="button" class="btn btn-primary" onclick="toggleUserListModal()">Select User</button>

                <div class="form-group">
                    <br>
                        <label for="product_type">product Type</label>
                        <select name="product_type" class="form-control @error('product_type') is-invalid @enderror" id="profession">
                            <option value=''>--select--</option>
                            <option value='clothing' {{ old('product_type', $products->product_type) == 'clothing' ? 'selected' : '' }}>clothing</option>
                            <option value='electronic' {{ old('product_type', $products->product_type) == 'electronic' ? 'selected' : '' }}>electronic</option>
                            <option value='jewellery' {{ old('product_type', $products->product_type) == 'jewellery' ? 'selected' : '' }}>jewellery</option>
                            <option value='shoes' {{ old('product_type', $products->product_type) == 'shoes' ? 'selected' : '' }}>shoes</option>
                        </select>
                        @error('product_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                <div class="form-group">
                    <label for="product_title">product Title</label>
                    <input type="text" name="product_title" class="form-control @error('product_title') is-invalid @enderror"
                           id="product_title"
                           placeholder="product Title" value="{{ old('product_title', $products->product_title) }}">
                    @error('product_title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
    <label for="product_description">product Description</label>
    <textarea name="product_description" class="form-control @error('product_description') is-invalid @enderror"
              id="product_description" rows="3" placeholder="product Description">{{ old('product_description', $products->product_description) }}</textarea>
    @error('product_description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <span>Current product Image:</span>
    <img src="{{ asset('storage/app/public/products/' . $products->product_image) }}" alt="{{ $products->name }}" style="max-width: 100px; max-height: 100px;">
    <br>
    <label for="product_image">New product Image</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="product_image" id="product_image">
        <label class="custom-file-label" for="product_image">Choose file</label>
        @if($products->product_image)
            <input type="hidden" name="existing_product_image" value="{{ $products->product_image }}">
        @endif
    </div>
    @error('product_image')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


                <div class="form-group">
    <label for="product_status">product Status</label>
    <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
        <label class="btn btn-outline-success {{ old('product_status', $products->product_status) === 1 ? 'active' : '' }}">
            <input type="radio" name="product_status" id="status_activated" value="1" {{ old('product_status', $products->product_status) === 1 ? 'checked' : '' }}> Approved
        </label>
        <label class="btn btn-outline-primary {{ old('product_status', $products->product_status) === 0 ? 'active' : '' }}">
            <input type="radio" name="product_status" id="status_pending" value="0" {{ old('product_status', $products->product_status) === 0 ? 'checked' : '' }}> Pending
        </label>
        <label class="btn btn-outline-danger {{ old('product_status', $products->product_status) === 2 ? 'active' : '' }}">
            <input type="radio" name="product_status" id="status_cancelled" value="2" {{ old('product_status', $products->product_status) === 2 ? 'checked' : '' }}> Cancelled
        </label>
    </div>
    @error('product_status')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


                <button class="btn btn-success btn-block btn-lg" type="submit">Save Changes</button>
            </form>
        </div>
    </div>
    <div id="userListModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" onclick="toggleUserListModal()">&times;</span>
        <h2>User List</h2>
        <!-- Search input -->
        <input type="text" id="searchInput" oninput="searchUsers()" placeholder="Search...">
        <div class="table-responsive">
            <table class="table table-bordered" id="userTable">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="selected_user_id" value="{{ $user->id }}" onclick="selectUser(this)" {{ $user->id == $products->user_id ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
              
                </table>
            </div>
           <!-- Pagination -->
<nav aria-label="User List Pagination">
    <ul class="pagination justify-content-center">
        <!-- Previous button -->
        <li class="page-item">
            <button class="page-link" onclick="prevPage()" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </button>
        </li>
        
        <!-- Next button -->
        <li class="page-item">
            <button class="page-link" onclick="nextPage()" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </button>
        </li>
    </ul>
</nav>

        </div>
    </div>
</div>

@endsection
@section('js')
    <!-- Include any additional JavaScript if needed -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Define variables for pagination
        var currentPage = 1;
        var itemsPerPage = 10; // Change this value as needed
        var userListRows = $('#userTable tbody tr');

        // Function to toggle the user list modal
        function toggleUserListModal() {
            $('.modal').toggle(); // Toggle the modal
        }

        // Function to filter user list based on search input
        function searchUsers() {
            var searchText = $('#searchInput').val().toLowerCase();
            $('#userTable tbody tr').each(function() {
                var id = $(this).find('td:eq(1)').text().toLowerCase();
                var name = $(this).find('td:eq(2)').text().toLowerCase();
                var mobile = $(this).find('td:eq(3)').text().toLowerCase();
                var email = $(this).find('td:eq(4)').text().toLowerCase();
                if (id.includes(searchText) || name.includes(searchText) || mobile.includes(searchText) || email.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Function to handle checkbox click and update user_id input
        function selectUser(checkbox) {
    // Deselect all checkboxes
    $('input[name="selected_user_id"]').prop('checked', false);
    // Select only the clicked checkbox
    $(checkbox).prop('checked', true);
    // Set its value to the user_id input field
    $('#user_id').val(checkbox.value);
}
        // Function to show the specified page of users
        function showPage(page) {
            var startIndex = (page - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            userListRows.hide().slice(startIndex, endIndex).show();
        }

        // Function to go to the previous page
        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        }

        // Function to go to the next page
        function nextPage() {
            if (currentPage < Math.ceil(userListRows.length / itemsPerPage)) {
                currentPage++;
                showPage(currentPage);
            }
        }

        // Show the first page initially
        showPage(currentPage);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    var btns = document.querySelectorAll('.btn-group-toggle .btn');
    btns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            btns.forEach(function (btn) {
                btn.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});

    </script>
      <script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('product_image');
    const fileInputLabel = fileInput.nextElementSibling;

    fileInput.addEventListener('change', function () {
        const fileName = this.files[0].name;
        fileInputLabel.textContent = fileName;
    });
});
</script>
    @endsection