<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index()
    {
        return view('admin.stock-movements.index');
    }
}
