<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Users not found');
        }
        $users = User::all(); 
        return view('admin.users.edit', compact('user', 'users'));
   }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'type' => 'required|string|max:255',
           
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        // Trả về danh sách danh mục sau khi cập nhật
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $users = User::all();
        foreach($users as $x ){
            if($x->parent_id==$id){
                $x->delete();
            }
        }
        // Trả về danh sách danh mục sau khi xóa
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
