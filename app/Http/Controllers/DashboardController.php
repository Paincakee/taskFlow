<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->get();
        return view('dashboard', [
            'tasks' => $tasks,
        ]);
    }
}
