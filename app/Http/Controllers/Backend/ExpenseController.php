<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    //
    public function index()
    {
        return view('backend.expense.expense.index');
    }
}
