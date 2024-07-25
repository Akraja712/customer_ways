<?php

namespace App\Http\Controllers;

use App\Models\Points;
use App\Models\Users;
use App\Models\Products;
use App\Models\Verifications;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 
     public function index()
     {
         $users_count = Users::count();
         $products_count = Products::count();
         $points_count = Points::count();
         $pending_products_count = Products::where('product_status', 0)->count();
         $pending_profile_count = Users::where('profile_verified', 0)->count();
         $pending_cover_image_count = Users::where('cover_img_verified', 0)->count();
         $pending_verification = Verifications::where('status', 0)->count();
     
         // Count of pending profiles and cover images
         //$pending_profile_count = Users::where('profile_verified', 0)->whereNotNull('profile')->count();
         //$pending_cover_image_count = Users::where('profile_verified', 0)->whereNotNull('cover_img')->count();
     
         return view('home', [
             'users_count' => $users_count,
             'products_count' => $products_count,
             'points_count' => $points_count,
             'pending_products_count' => $pending_products_count,
             'pending_profile_count' => $pending_profile_count,
             'pending_cover_image_count' => $pending_cover_image_count,
             'pending_verification' => $pending_verification,
         ]);
     }
    }     