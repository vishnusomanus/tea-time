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
            ->orderBy('created_at', 'asc')
            ->pluck('kadi_kudi')
            ->toArray();

        $menuTodayId = MenuToday::where('user', $user_id)
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'asc')
            ->pluck('id')
            ->toArray();

           

        $menuKadi = Menu::where('type', 'kadi')->get();
        $menuKudi = Menu::where('type', 'kudi')->get();
        // print_r($menuKadi); die;
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

        if(isset($formData['Kadi'])){
            $menuToday = new MenuToday;
            $menuToday->kadi_kudi = $formData['Kadi'];
            $menuToday->user = $user_id;
            $menuToday->save();
        }else{
            $menuToday = new MenuToday;
            $menuToday->kadi_kudi = null;
            $menuToday->user = $user_id;
            $menuToday->save();
        }
        
        if(isset($formData['Kudi'])){
            $menuToday = new MenuToday;
            $menuToday->kadi_kudi = $formData['Kudi'];
            $menuToday->user = $user_id;
            $menuToday->save();
        }else{
            $menuToday = new MenuToday;
            $menuToday->kadi_kudi = null;
            $menuToday->user = $user_id;
            $menuToday->save();
        }

        return redirect()->back()->with('success', 'Menu item created successfully!');
    }

    public function update(Request $request)
    {
        $user_id = auth()->user()->id;
        $formData = $request->all();
        if(isset($formData['Kudi']) && isset($formData['id'][0])){
            $menuToday = MenuToday::find($formData['id'][0]);
            $menuToday->kadi_kudi = $formData['Kudi'];
            $menuToday->save();
        }

        if(isset($formData['Kadi']) && isset($formData['id'][1])){
            $menuToday = MenuToday::find($formData['id'][1]);
            $menuToday->kadi_kudi = $formData['Kadi'];
            $menuToday->save();
        }
        return redirect()->back()->with('success', 'Menu item updated successfully!');
    }
}
