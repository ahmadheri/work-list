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
  
}
