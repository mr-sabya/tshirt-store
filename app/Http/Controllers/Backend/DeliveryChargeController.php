<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    //
    public function index()
    {
        return view('backend.delivery-charge.index');
    }
}
