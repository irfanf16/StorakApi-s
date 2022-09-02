<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliverySlotsResource;
use App\Models\DeliverySlot;
use Illuminate\Http\Request;

class DeliverySlotsController extends Controller
{
    public function index()
    {
        try {
            $delivery_slots = DeliverySlot::all();
            $delivery_slots=DeliverySlotsResource::collection($delivery_slots);
            return response()->json([
                'status' => 200,
                'deliver_slots' => $delivery_slots
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
