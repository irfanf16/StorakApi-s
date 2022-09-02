<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class AdminSubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::all();
        return response()->json([
            'status' => 200,
            'subscribers' => $subscribers
        ]);
    }
    
}
