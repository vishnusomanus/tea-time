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
                ->select('menu.name as item', 'users.name')
                ->get();
                $menuTodayKudi = MenuToday::join('menu', 'menu.id', '=', 'menu_today.kadi_kudi')
                ->join('users', 'users.id', '=', 'menu_today.user')
                ->whereDate('menu_today.created_at', today())
                ->where('menu.type', "kudi")
                ->select('menu.name as item', 'users.name')
                ->get();

                $menuTodayTotals = MenuToday::join('menu', 'menu.id', '=', 'menu_today.kadi_kudi')
                ->join('users', 'users.id', '=', 'menu_today.user')
                ->whereDate('menu_today.created_at', today())
                ->groupBy('menu.name')
                ->select('menu.name', \DB::raw('count(*) as total'))
                ->get();

                // print_r($menuTodayTotals); die;

        return view('home.index', ['menuTodayKadi' => $menuTodayKadi, 'menuTodayKudi' => $menuTodayKudi, 'menuTodayTotals' => $menuTodayTotals]);
    }
}