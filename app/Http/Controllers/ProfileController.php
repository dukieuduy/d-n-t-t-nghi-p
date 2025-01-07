<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('client.pages.profile', compact('user'));
    }
    public function edit(Request $request)
    {
        $role = $request->query('role');
        $layout = $role == 'admin' ? 'admin.app' : 'app';
        $user = Auth::user();
        return view('client.pages.profile_edit', compact('user', 'layout', 'role'));
    }

    public function update(UserFormRequest $request)
    {
        try {
            $user = Auth::user();
            $data = $request->all();
            $role = $data['role'] ?? null;
            unset($data['role']);
            if($request->hasFile('avatar'))
            {
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
                if ($user->avatar && file_exists($user->avatar))
                {
                    unlink($user->avatar);
                }
            }
            $user->update($data);
            if ($role == 'admin')
            {
                return redirect()->route('admin.admin-profile-edit')->with('success', 'Cập nhật thôgn tin cá nhân thành công!');
            }
            return redirect()->route('profile')->with('success', 'Cập nhật thôgn tin cá nhân thành công!');
        } catch (\Exception $exception) {
            throw $exception;
        }

    }
}
