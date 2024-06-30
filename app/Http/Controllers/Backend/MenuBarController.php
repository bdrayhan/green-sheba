<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuBar;
use Illuminate\Http\Request;

class MenuBarController extends Controller
{
    public function allMenu(){
        $menubars = MenuBar::where('menu_status', 1)->orderBy('menu_order' , 'ASC')->get();
        return view('backend.menubar.index', compact('menubars'));
    }

    public function menuStore(Request $request)
    {
        $menu = new MenuBar();
        $menu->menu_name = $request->menu_name;
        $menu->menu_link = $request->menu_link;
        $menu->menu_color = $request->menu_color;
        $menu->menu_bg_color = $request->menu_bg_color;
        $menu->menu_order = $request->menu_order;
        $menu->save();
        $notification = array(
            'message' => 'Menu Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function menuUpdate(Request $request, $id)
    {
        $request->validate([
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_order' => 'required',
        ]);
        $menu = MenuBar::findOrFail($id);
        $menu->menu_name = $request->menu_name;
        $menu->menu_link = $request->menu_link;
        $menu->menu_order = $request->menu_order;
        $menu->update();

        $notification = array(
            'message' => 'Menu Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
