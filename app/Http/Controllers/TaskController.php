<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::with('user')->simplePaginate(12);

        return view('task', [
            'tasks' => $tasks,
        ]);
    }

    public function create(): View
    {
        return view('task', [
        ]);
    }
}
