<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Types;
use App\Restaurants;
use App\Categories;
use App\Menu;
use App\Review;
use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index()
    { 
        if(Auth::user()->usertype == 'Admin')    
        {  
            $types = Types::count(); 
            $restaurants_count = Restaurants::count(); 
            $order = Order::count(); 
            $users = User::where('usertype', 'User')->count(); 

            // Get monthly orders data
            $ordersData = Order::select(
                DB::raw('COUNT(*) as count'),
                DB::raw('FROM_UNIXTIME(created_date, "%Y-%m") as month')
            )
            ->groupBy('month')
            ->get()
            ->keyBy('month')
            ->toArray();

            // Prepare an array with all months
            $ordersPerMonth = array_fill_keys(
                array_map(
                    function ($month) {
                        return Carbon::create()->month($month)->format('Y-m');
                    }, range(1, 12)
                ), 0
            );

            // Fill the array with actual data
            foreach ($ordersData as $month => $data) {
                $ordersPerMonth[$month] = $data['count'];
            }

            return view('admin.pages.dashboard', compact('types', 'restaurants_count', 'order', 'users', 'ordersPerMonth'));
        }

        if(Auth::user()->usertype == 'Owner')
        {
            $user_id = Auth::User()->id;

            $restaurant = Restaurants::where('user_id', $user_id)->first();

            $restaurant_id = $restaurant['id'];

            $categories_count = Categories::where(['restaurant_id' => $restaurant_id])->count();
            $menu_count = Menu::where(['restaurant_id' => $restaurant_id])->count();
            $order_count = Order::where(['restaurant_id' => $restaurant_id])->count();
            $review_count = Review::where(['restaurant_id' => $restaurant_id])->count();

            return view('admin.pages.owner_dashboard', compact('categories_count', 'menu_count', 'order_count', 'review_count')); 
        }
    }
}
