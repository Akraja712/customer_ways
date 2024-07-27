@extends('layouts.admin')

@section('title', 'sellers Management')
@section('content-header', 'sellers Management')
@section('content-actions')
    <a href="{{ route('sellers.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add New seller</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-1">
           <div class="col-md-4">
                <!-- Filter Form -->
                <form id="filter-form" action="{{ route('sellers.index') }}" method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="status-filter">Filter by Status:</label>
                            <select name="seller_status" id="status-filter" class="form-control">
                                <option value="2" {{ request()->input('seller_status') === '2' ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ request()->input('seller_status') === '1' ? 'selected' : '' }}>Approved</option>
                                <option value="3" {{ request()->input('seller_status') === '3' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 offset-md-4">
                <!-- Search Form -->
                <form action="{{ route('sellers.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Actions</th>
                        <th>ID <i class="fas fa-sort"></i></th>
                        <th>Your Name</th>
                        <th>Store Name <i class="fas fa-sort"></i></th>
                        <th>Mobile Number <i class="fas fa-sort"></i></th>
                        <th>Email<i class="fas fa-sort"></i></th>
                        <th>Category<i class="fas fa-sort"></i></th>
                        <th>store Address<i class="fas fa-sort"></i></th>
                        <th>seller Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $seller)
                        <tr>
                            <td>
                                <a href="{{ route('sellers.edit', $seller) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-delete" data-url="{{ route('sellers.destroy', $seller) }}"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>{{ $seller->id }}</td>
                            <td>{{ $seller->your_name }}</td>
                            <td>{{ $seller->store_name }}</td>
                            <td>{{ $seller->mobile}}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->category }}</td>
                            <td>{{ $seller->store_address }}</td>
                            <td>
                                @if ($seller->seller_status === 1)
                                    <span class="badge badge-success">Approved</span>
                                @elseif ($seller->seller_status === 2)
                                    <span class="badge badge-primary">Pending</span>
                                @elseif ($seller->seller_status === 3)
                                    <span class="badge badge-danger">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $sellers->links() }}
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        $(document).ready(function () {
            // Submit the form when user or status selection changes
            $('#user-filter, #status-filter').change(function () {
                var userFilterValue = $('#user-filter').val();
                var statusFilterValue = $('#status-filter').val();
                
                // Check if both filters are empty or only the status filter is selected
                if ((userFilterValue === '' && statusFilterValue === '') || (userFilterValue !== '' && statusFilterValue !== '')) {
                    $('#filter-form').submit();
                } else if (statusFilterValue !== '') {
                    // If only the status filter is selected, construct the URL without the user_id parameter
                    var url = "{{ route('sellers.index') }}?seller_status=" + statusFilterValue;
                    window.location.href = url;
                } else {
                    // If only the user filter is selected, submit the form with both filters
                    $('#filter-form').submit();
                }
            });

            // Handle pagination clicks to maintain seller_status parameter
            $('.pagination a').click(function (e) {
                e.preventDefault();
                var pageUrl = $(this).attr('href');
                var statusFilterValue = $('#status-filter').val();
                
                if (statusFilterValue !== '') {
                    var separator = pageUrl.includes('?') ? '&' : '?';
                    pageUrl += separator + 'seller_status=' + statusFilterValue;
                }

                window.location.href = pageUrl;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.table th').click(function() {
                var table = $(this).parents('table').eq(0);
                var index = $(this).index();
                var rows = table.find('tr:gt(0)').toArray().sort(comparer(index));
                this.asc = !this.asc;
                if (!this.asc) {
                    rows = rows.reverse();
                }
                for (var i = 0; i < rows.length; i++) {
                    table.append(rows[i]);
                }
                // Update arrows
                updateArrows(table, index, this.asc);
            });

            function comparer(index) {
                return function(a, b) {
                    var valA = getCellValue(a, index),
                        valB = getCellValue(b, index);
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
                };
            }

            function getCellValue(row, index) {
                return $(row).children('td').eq(index).text();
            }

            function updateArrows(table, index, asc) {
                table.find('.arrow').remove();
                var arrow = asc ? '<i class="fas fa-arrow-up arrow"></i>' : '<i class="fas fa-arrow-down arrow"></i>';
                table.find('th').eq(index).append(arrow);
            }
        });
    </script>
@endsection
