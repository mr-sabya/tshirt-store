<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class CallHistoryController extends Controller
{
    //
    public function index($leadId)
    {
        $lead = Lead::findOrFail($leadId);
        return view('backend.lead.history.index', compact('lead'));
    }
}
