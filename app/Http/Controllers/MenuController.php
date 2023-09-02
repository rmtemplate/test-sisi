<?php

namespace App\Http\Controllers;

use App\Models\HeadingMenu;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $headingMenu = HeadingMenu::latest()->get();
        $role = Role::latest()->get();
        $getMenu = Menu::where('parent_id', NULL)->latest()->get();
        return view('admin.menu.index', compact('headingMenu', 'role', 'getMenu'));
    }

    public function storeHeadingMenu(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            HeadingMenu::create([
                'name' => $request->name,
            ]);

            return redirect()->back()->with('success', 'Selamat! Anda Berhasil menambahkan heading menu');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e->withMessages(['name' => 'Nama Harus Diisi!']);
        }
    }

    public function storeMenu(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'id_role' => 'required',
                'icon' => 'required',
            ]);

            if ($request->id_menu) {
                Menu::find($request->id_menu)->update([
                    'id_heading_menu' => $request->id_heading_menu,
                    'id_role' => $request->id_role,
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'parent_id' => $request->parent_id,
                ]);
            } else {
                Menu::create([
                    'id_heading_menu' => $request->id_heading_menu,
                    'id_role' => $request->id_role,
                    'name' => $request->name,
                    'icon' => $request->icon,
                    'parent_id' => $request->parent_id,

                ]);
            }

            return redirect()->back()->with('success', 'Selamat! Anda Berhasil menambahkan menu');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e->withMessages(
                ['name' => 'Nama Harus Diisi!'],
                ['id_role' => 'Role Harus Diisi!'],
                ['icon' => 'Icon Harus Diisi!']
            );
        }
    }

    public function destroyHeadingMenu(Request $request)
    {
        try {
            HeadingMenu::find($request->id)->delete();
            return redirect()->back()->with('success', 'Selamat! Anda Berhasil menghapus heading menu');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', $e->getMessage());
        }
    }

    public function destroyMenu(Request $request)
    {
        try {
            Menu::find($request->id)->delete();
            return redirect()->back()->with('success', 'Selamat! Anda Berhasil menghapus menu');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', $e->getMessage());
        }
    }
}
