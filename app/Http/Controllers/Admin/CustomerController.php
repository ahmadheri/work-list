<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionContextPass;

class CustomerController extends Controller
{
    public function index()
    {
      $customers = Customer::latest()->when(request()->q, function($customers) {
        $customers = $customers->where('name', 'like', '%' . request()->q . '%');
      })->paginate(10);

      return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
      return view('admin.customer.create');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|email'
      ]);

      $customer = Customer::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email
      ]);

      if ($customer) {
        return redirect()->route('admin.customer.index')->with(['success' => 'Data Berhasil Disimpan']);
      } else {
        return redirect()->route('admin.customer.index')->with(['error' => 'Data Gagal Disimpan']);
      }

    }
}
