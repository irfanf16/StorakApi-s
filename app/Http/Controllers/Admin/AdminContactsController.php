<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class AdminContactsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::all();
        return response()->json([
            'status' => 200,
            'contacts' => $contacts
        ]);
    }
    
}
