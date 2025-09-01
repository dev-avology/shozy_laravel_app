<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => 1,
            'customers' => 1,
            'technicians' => 1,
            'delivery' => 1,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
