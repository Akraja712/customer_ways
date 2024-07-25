<?php
namespace App\Http\Controllers;

use App\Http\Requests\SellersStoreRequest;
use App\Models\Sellers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Sellers::query();

        // Check if there's a search query
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('your_name', 'like', "%$search%")
                  ->orWhere('store_name', 'like', "%$search%");
        }
        if ($request->has('seller_status')) {
            $seller_status = $request->input('seller_status');
            $query->where('seller_status', $seller_status);
        } else {
            // By default, fetch pending products
            $query->where('seller_status', 0);
        }
        $sellers = $query->latest()->paginate(10); // Paginate the results

        return view('sellers.index')->with('sellers', $sellers);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellers = Sellers::all(); // Fetch all users
        return view('sellers.create', compact('sellers')); // Pass users to the view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellersStoreRequest $request)
    {
        $sellers = Sellers::create([
            'your_name' => $request->your_name,
            'store_name' => $request->store_name,
            'mobile' => $request->mobile, // Make sure this line is correct
            'email' => $request->email,
            'category' => $request->category,
            'store_address' => $request->store_address,
        ]);

        if (!$sellers) {
            return redirect()->back()->with('error', 'Sorry, something went wrong while creating the chat.');
        }

        return redirect()->route('sellers.index')->with('success', 'Success, new Sellers has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function show(Sellers $sellers)
    {
        // Implement show logic if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function edit(Sellers $sellers)
    {
        return view('sellers.edit', compact('sellers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sellers $sellers)
    {
        $sellers->your_name = $request->your_name;
        $sellers->store_name = $request->store_name;
        $sellers->mobile = $request->mobile;
        $sellers->email = $request->email;
        $sellers->category = $request->category;
        $sellers->store_address = $request->store_address;
        $sellers->seller_status = $request->seller_status;

        if (!$sellers->save()) {
            return redirect()->back()->with('error', 'Sorry, something went wrong while updating the chat.');
        }

        return redirect()->route('sellers.edit', $sellers->id)->with('success', 'Success, sellers has been updated.');
    }

    public function destroy(Sellers $sellers)
    {
        $sellers->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}

