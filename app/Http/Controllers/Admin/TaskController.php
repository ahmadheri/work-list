<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
      $tasks = Task::with(['user', 'customer','progress'])->latest()->when(request()->q, function($tasks) {
        $tasks = $tasks->where('title', 'like', '%' . request()->q . '%');
      })->paginate(10);

      return view('admin.task.index', compact('tasks'));
    }
}
