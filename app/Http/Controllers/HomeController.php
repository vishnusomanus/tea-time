<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MenuToday;

class HomeController extends Controller
{
    public function index() 
    {

                $menuTodayKadi = MenuToday::join('menu', 'menu.id', '=', 'menu_today.kadi_kudi')
                ->join('users', 'users.id', '=', 'menu_today.user')
                ->whereDate('menu_today.created_at', today())
                ->where('menu.type', "kadi")
                ->select('menu.name as item', 'menu.image', \DB::raw('GROUP_CONCAT(users.name SEPARATOR ", ") as user_names'))
                ->groupBy('menu.type', 'menu.name', 'menu.image')
                ->get();

                $menuTodayKudi = MenuToday::join('menu', 'menu.id', '=', 'menu_today.kadi_kudi')
                ->join('users', 'users.id', '=', 'menu_today.user')
                ->whereDate('menu_today.created_at', today())
                ->where('menu.type', "kudi")
                ->select('menu.name as item', 'menu.image', \DB::raw('GROUP_CONCAT(users.name SEPARATOR ", ") as user_names'))
                ->groupBy('menu.type', 'menu.name', 'menu.image')
                ->get();
            



                $menuTodayTotals = MenuToday::join('menu', 'menu.id', '=', 'menu_today.kadi_kudi')
                ->join('users', 'users.id', '=', 'menu_today.user')
                ->whereDate('menu_today.created_at', today())
                ->groupBy('menu.name')
                ->select('menu.name', \DB::raw('count(*) as total'))
                ->get();

                //print_r($menuTodayKadi); die;

        return view('home.index', ['menuTodayKadi' => $menuTodayKadi, 'menuTodayKudi' => $menuTodayKudi, 'menuTodayTotals' => $menuTodayTotals]);
    }
}
