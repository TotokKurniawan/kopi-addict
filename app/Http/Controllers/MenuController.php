<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function updateMenu(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|in:food,drink',
            'harga' => 'required|integer',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->nama = $request->nama;
        $menu->kategori = $request->kategori;
        $menu->harga = $request->harga;

        // Jika ada upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menu'), $filename);
            $menu->foto = $filename;
        }

        $menu->save();

        return redirect()->route('menuUser')->with('success', 'Menu berhasil diperbarui.');
    }
    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus file foto jika ada
        if ($menu->foto && file_exists(public_path('uploads/menu/' . $menu->foto))) {
            unlink(public_path('uploads/menu/' . $menu->foto));
        }

        $menu->delete();

        return redirect()->route('menuUser')->with('success', 'Menu berhasil dihapus.');
    }
    public function storeMenu(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|in:food,drink',
            'harga' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu = new Menu();
        $menu->nama = $request->nama;
        $menu->kategori = $request->kategori;
        $menu->harga = $request->harga;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menu'), $filename);
            $menu->foto = $filename;
        }

        $menu->save();

        return redirect()->route('menuUser')->with('success', 'Menu berhasil ditambahkan!');
    }
    public function updateMenuadmin(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|in:food,drink',
            'harga' => 'required|integer',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->nama = $request->nama;
        $menu->kategori = $request->kategori;
        $menu->harga = $request->harga;

        // Jika ada upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menu'), $filename);
            $menu->foto = $filename;
        }

        $menu->save();

        return redirect()->route('menu')->with('success', 'Menu berhasil diperbarui.');
    }
    public function deleteMenuadmin($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus file foto jika ada
        if ($menu->foto && file_exists(public_path('uploads/menu/' . $menu->foto))) {
            unlink(public_path('uploads/menu/' . $menu->foto));
        }

        $menu->delete();

        return redirect()->route('menu')->with('success', 'Menu berhasil dihapus.');
    }
    public function storeMenuadmin(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|in:food,drink',
            'harga' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu = new Menu();
        $menu->nama = $request->nama;
        $menu->kategori = $request->kategori;
        $menu->harga = $request->harga;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menu'), $filename);
            $menu->foto = $filename;
        }

        $menu->save();

        return redirect()->route('menu')->with('success', 'Menu berhasil ditambahkan!');
    }
}
