<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Progress;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * index
     * 
     */
    public function index()
    {
      $tasks = Task::with(['user', 'customer','progress'])->latest()->when(request()->q, 
        function($tasks) {
          $tasks = $tasks->where('title', 'like', '%' . request()->q . '%');
      })->paginate(10);

      return view('admin.task.index', compact('tasks'));
    }

    /**
     * create
     * 
     */
    public function create()
    {
      return view('admin.task.create');
    }

    /**
     * store
     * 
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
        'quantity' => 'required',
        'deadline' => 'required',
        'payment_method' => 'required',
        'paid_amount' => 'required',
        'invoice_number' => 'required'
      ]);

      $customerId = Customer::where('name', 'Like', '%' . $request->customer_name . '%')->first();
      $picId = User::where('name', 'Like', '%' . $request->pic_name . '%')->first();

      $task = Task::create([
        'customer_id' => $customerId->id,
        'user_id' => $picId->id,
        'title' => $request->title,
        'quantity' => $request->quantity,
        'deadline' => $request->deadline,
        'invoice_number' => $request->invoice_number,
      ]);

      // get the last id of task table
      $taskId = $task->id;

      $progress = Progress::create([
        'task_id' => $taskId,
        'design' => 0,
        'print' => 0,
      ]);

      $payment = Payment::create([
        'task_id' => $taskId,
        'payment_method' => $request->payment_method,
        'down_payment' => $request->down_payment,
        'paid_amount' => $request->paid_amount
      ]);

      if ($task && $progress && $payment) {
        return redirect()->route('admin.task.index')->with(['success' => 'Data Berhasil Disimpan']);
      } else {
        return redirect()->route('admin.task.index')->with(['error' => 'Data Gagal Disimpan']);
      }

    }

    /**
     * Search Customer
     * 
     */
    public function searchCustomer(Request $request)
    {
      $output='';

      $customer = Customer::where('name', 'Like', '%'. $request->search .'%' )
        ->orWhere('email', 'Like', '%'. $request->search .'%')
        ->get();

      foreach($customer as $cust) 
      {
        $output.=
        '<tr>
          <td>' .$cust->name. '</td>
          <td>' .$cust->email. '</td>
          <td><button onclick="searchCustomerID(this.id)" type="button" class="btn btn-primary" id="'.$cust->id.'">Pilih</button></td>

        </tr>';
      }

      return response($output);

    }

    /**
     * Search Customer ID
     * 
     */
    public function searchCustomerID($id)
    {
      $customer = Customer::findOrFail($id);

      if ($customer) {
        return response()->json([
          'name' => $customer->name
        ]);
      }
    }

    /**
     * Search Person In Charge / PIC
     * 
     */
    public function searchPersonInCharge(Request $request)
    {
      $output = '';

      $user = User::where('name', 'Like', '%' . $request->search . '%')
        ->orWhere('email', 'Like', '%' . $request->search . '%')
        ->get();

      foreach( $user as $user ) 
      {  
        $output.= 
        '<tr>
          <td>' .$user->name. '</td>
          <td>' .$user->email. '</td>
          <td><button onclick="searchPICID(this.id)" type="button" class="btn btn-primary" id="'.$user->id.'">Pilih</button></td>
        </tr>';
      }

      return response($output);
    }

    /**
     * Search PIC ID
     *
     */
    public function searchPICID($id)
    {
      $user = User::findOrFail($id);

      if($user) {
        return response()->json([
          'name' => $user->name
        ]);
      }
    }


}
