<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $query = Customers::query()->with('user'); // Eager load the user relationship

        // Filter by user if user_id is provided
        if ($request->has('user_id')) {
            $user_id = $request->input('user_id');
            $query->where('user_id', $user_id);
        }

        $customers = $query->latest()->paginate(10); // Paginate the results

        $users = Users::all(); // Fetch all users for the filter dropdown

        return view('customers.index', compact('customers', 'users')); // Pass customers and users to the view
    }

    public function destroy(Customers $customers)
    {
        $customers->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
