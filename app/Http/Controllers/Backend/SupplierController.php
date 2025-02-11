<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //index
    public function index()
    {
        return view('backend.suppliers.index');
    }
}
