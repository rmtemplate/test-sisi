<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;

class GenerateMenuController extends Controller
{
    public function index($headingMenu, $menu)
    {
        $getMenu = Menu::where('slug', $menu)->first();

        if ($getMenu->id_role == Auth::user()->id_role) {

            if ($getMenu->slug == "manage-menu") {
                return (new MenuController)->index();
            } else if ($getMenu->slug == "jabatan") {
                return (new JabatanController)->index();
            } else if ($getMenu->slug == "karyawan") {
                return (new KaryawanController)->index();
            }
        } else {
            return redirect()->route('home');
        }
    }
}
