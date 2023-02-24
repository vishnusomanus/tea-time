<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuToday;

class MenuTodayController extends Controller
{
    /**
     * Show the form for creating a new menu item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;

        $menuToday = MenuToday::where('user', $user_id)
            ->whereDate('created_at', today())
            ->pluck('kadi_kudi')
            ->toArray();

        $menuTodayId = MenuToday::where('user', $user_id)
            ->whereDate('created_at', today())
            ->pluck('id')
            ->toArray();

           

        $menuKadi = Menu::where('type', 'kadi')->get();
        $menuKudi = Menu::where('type', 'kudi')->get();
        // print_r(count($menuToday)); die;
        if(count($menuToday) > 0){
            return view('menu_today.create', ['edit' => true,'menuToday' => $menuToday,"menuTodayId" => $menuTodayId,'menuKadi' => $menuKadi,'menuKudi' => $menuKudi]);
        }else{
            return view('menu_today.create', ['edit' => false,'menuToday' => [],"menuTodayId" => [],'menuKadi' => $menuKadi,'menuKudi' => $menuKudi]);
        }
    }

    /**
     * Store a newly created menu item in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $formData = $request->all();

        $menuToday = new MenuToday;
        $menuToday->kadi_kudi = $formData['Kadi'];
        $menuToday->user = $user_id;
        $menuToday->save();

        $menuToday = new MenuToday;
        $menuToday->kadi_kudi = $formData['Kudi'];
        $menuToday->user = $user_id;
        $menuToday->save();

        return redirect()->back()->with('success', 'Menu item created successfully!');
    }

    public function update(Request $request)
    {
        $formData = $request->all();

        $menuToday = MenuToday::find($formData['id'][0]);
        // print_r($formData['id'][0]); die;

        $menuToday->kadi_kudi = $formData['Kudi'];
        $menuToday->save();

        $menuToday = MenuToday::find($formData['id'][1]);
        $menuToday->kadi_kudi = $formData['Kadi'];
        $menuToday->save();

        return redirect()->back()->with('success', 'Menu item updated successfully!');
    }
}
