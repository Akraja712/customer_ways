<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStoreRequest;
use App\Models\Products;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Berkayk\OneSignal\OneSignalClient;

class ProductsController extends Controller
{
    protected $oneSignalClient;

    public function __construct(OneSignalClient $oneSignalClient)
    {
        $this->oneSignalClient = $oneSignalClient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function updateStatus(Request $request)
     {
         $productIds = $request->input('product_ids', []);
         $status = $request->input('status');
 
         foreach ($productIds as $productId) {
             $product = Products::find($productId);
             if ($product) {
                 $oldStatus = $product->product_status;
                 $product->product_status = $status;
                 $product->product_datetime = now();
                 $product->save();
 
                 // Only send notifications if the status has changed
                 if ($oldStatus !== $status) {
                     if ($status == 1) {
                        $userId = $product->user_id;

                         $this->sendNotificationToAllUsers($product->user_id);
 
                         // Send notification to the user who posted the product
                         $this->sendNotificationToUser(strval($userId));
                     }
                 }
             }
         }
 
         return response()->json(['success' => true]);
     }
 
     /**
      * Send notification to all users that a new product has been posted.
      *
      * @param int $userId
      * @return void
      */
     protected function sendNotificationToAllUsers($userId)
     {
         $user = Users::find($userId);
         if ($user) {
             $message = $user->name . " posted a new product";
             $this->oneSignalClient->sendNotificationToAll(
                 $message,
                 $url = null,
                 $data = null,
                 $buttons = null,
                 $schedule = null
             );
         }
     }
 
     /**
      * Send notification to the user that their product has been approved.
      *
      * @param int $userId
      * @return void
      */
     protected function sendNotificationToUser($userId)
     {
             $message = "Your product has been approved successfully";
             $this->oneSignalClient->sendNotificationToExternalUser(
                 $message,
                 $userId,
                 $url = null,
                 $data = null,
                 $buttons = null,
                 $schedule = null
             );
     }
     public function index(Request $request)
     {
         $query = Products::query()->with('users');
     
         if ($request->has('user_id')) {
             $user_id = $request->input('user_id');
             $query->where('user_id', $user_id);
         }
     
         if ($request->has('product_status')) {
             $product_status = $request->input('product_status');
             $query->where('product_status', $product_status);
         } else {
             // By default, fetch pending products
             $query->where('product_status', 0);
         }
     
         $products = $query->latest()->paginate(10);
         $users = Users::all();
     
         return view('products.index', compact('products', 'users'));
     }
     
     
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Users::all(); // Fetch all products
        return view('products.create', compact('users')); // Pass products to the view
    }
  


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    
    public function store(ProductsStoreRequest $request)
    {
    
        // Check if a file has been uploaded
   if ($request->hasFile('product_image')) {
    $imageName = $request->file('product_image')->getClientOriginalName(); // Get the original file name
    $imagePath = $request->file('product_image')->storeAs('products', $imageName);
} else {
    // Handle the case where no file has been uploaded
    $imagePath = null; // or provide a default image path
}
        $products = Products::create([
            'product_type' => $request->product_type,
            'product_title' => $request->product_title,
            'product_description' => $request->product_description,
            'user_id' => $request->user_id,
            'product_image' => $imageName, // Save only the image name in the database
            'product_datetime' => now(),
            
        ]);
    
        if (!$products) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while creating user.');
        }
    
        return redirect()->route('products.index')->with('success', 'Success, New products has been added successfully!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {

    }

    public function user()
    {
        return $this->belongsTo(users::class);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        $users = Users::all(); // Fetch all shops
        return view('products.edit', compact('products', 'users'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)

    {

        $request->validate([
            'product_type' => 'required|string',
            'product_title' => 'required|string',
            'product_description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $products->product_type = $request->product_type;
        $products->product_title = $request->product_title;
        $products->product_description = $request->product_description;
        $products->user_id = $request->user_id;
        $products->product_status = $request->product_status;
        $products->product_datetime = now(); 

        if ($request->hasFile('product_image')) {
            $newImagePath = $request->file('product_image')->store('products', 'public');
            Storage::disk('public')->delete('products/' . $products->product_image);
            $products->product_image = basename($newImagePath);
        }


        if (!$products->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the customer.');
        }
        return redirect()->route('products.edit', $products->id)->with('success', 'Success, product has been updated.');
    }

    public function destroy(Products $products)
    {

         // Check if the profile image exists and delete it
         if (Storage::disk('public')->exists('products/' . $products->product_image)) {
            Storage::disk('public')->delete('products/' . $products->product_image);
        }
        $products->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
