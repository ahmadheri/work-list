<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $users = User::latest()->when(request()->q, function($users) {
      $users = $users->where('name', 'like', '%' . request()->q . '%');
    })->paginate(10);

    return view('admin.user.index', compact('users'));
  }

  public function create()
  {
    return view('admin.user.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'phone' => 'required',
      'role' => 'required',
      'email' => 'required|email',
      'password' => 'required|confirmed'
    ]);

    $user = User::create([
      'name' => $request->name,
      'phone' => $request->phone,
      'role' => $request->role,
      'email' => $request->email,
      'email_verified_at' => now(),
      'remember_token' => Str::random(10),
      'password' => bcrypt($request->password) 
    ]);

    if($user) {
      return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan']);
    } else {
      return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan']);
    }

  }
  
  public function edit(User $user)
  {
    return view('admin.user.edit', compact('user'));
  }

  public function update(Request $request, User $user)
  {
    $this->validate($request, [
      'name' => 'required',
      'phone' => 'required',
      'role' => 'required',
      'email' => 'required|email',
      'password' => 'confirmed'
    ]);

    if ($request->password == '') {

      // update tanpa password 
      $user = User::findOrFail($user->id);
      $user->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'role' => $request->role,
        'email' => $request->email
      ]);

    } else {

      // udpate dengan password
      $user = User::findOrFail($user->id);
      $user->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'role' => $request->role,
        'email' => $request->email,
        'password' => bcrypt($request->password)
      ]);

    }

    if($user) {
      return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diupdate']);
    } else {
      return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Diupdate']);
    }

  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    if($user) {
      return response()->json([
        'status' => 'success'
      ]);
    } else {
      return response()->json([
        'status' => 'error'
      ]);
    }
  }

}
