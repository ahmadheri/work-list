<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionContextPass;

class CustomerController extends Controller
{
    /**
     * index
     */
    public function index()
    {
      $customers = Customer::latest()->when(request()->q, function($customers) {
        $customers = $customers->where('name', 'like', '%' . request()->q . '%');
      })->paginate(10);

      return view('admin.customer.index', compact('customers'));
    }

    /**
     * create
     */
    public function create()
    {
      return view('admin.customer.create');
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */
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

    /**
     * edit
     * 
     * @param mixed $customer
     * @return void
     */
    public function edit(Customer $customer)
    {
      return view('admin.customer.edit', compact('customer'));
    }

    /**
     * update
     * 
     * @param mixed $request
     * @param mixed $customer
     * 
     */
    public function update(Request $request, Customer $customer)
    {
      $this->validate($request, [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|email'
      ]);

      $customer = Customer::findOrFail($customer->id);
      $customer->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email
      ]);

      if ($customer) {
        return redirect()->route('admin.customer.index')->with(['success' => 'Data Berhasil Diupdate']);
      } else {
        return redirect()->route('admin.customer.index')->with(['error' => 'Data Gagal Diupdate']);
      }
    }

    /**
     * delete
     * 
     */
    public function destroy($id)
    {
      $customer = Customer::findOrFail($id);
      $customer->delete();

      if($customer) {
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
