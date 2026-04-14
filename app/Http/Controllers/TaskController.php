<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;

        $query = Task::query();

        if ($type && $type != 'all') {
            $query->where('task_type', $type);
        }

        $tasks = $query->orderBy('due_date')->get();

        return view('SalesRep.sales_tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'customer_name' => $request->customer_name,
            'task_type' => $request->task_type,
            'priority' => $request->priority,
            'status' => 'pending',
            'due_date' => $request->due_date
        ]);

        return back()->with('success', 'Task Created');
    }
}