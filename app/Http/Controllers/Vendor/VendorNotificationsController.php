<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Notification;


class VendorNotificationsController extends Controller
{
    /*
    |========================================================================
    | Get Listing of Recent 10 Notifications
    |========================================================================
    */
    public function recentNotifications()
    {
        if (Auth::user()->store) {
            $notifications = Notification::where('store_id',\Auth::user()->store->id)
                                         ->latest()
                                         ->take(10)
                                         ->get();

            // COUNT UNREAD-NOTIFICATIONS
            $unread_notifiations =  $notifications->filter(function ($notifications) {
                return $notifications->status == 0;
            });
            $unread_notifiations = $unread_notifiations->count();

        }
        else{
            $notifications = 0;
            $unread_notifiations = 0;
        }

        return response()->json([
            'status'        => 200,
            'notifications' => $notifications,
            'unread_noti'   => $unread_notifiations
        ]);

    }



    /*
    |========================================================================
    | Get Listing of All Notifications
    |========================================================================
    */
    public function allNotifications(Request $request)
    {
        if (Auth::user()->store) {
            if ($request->ajaxRequest == 1) {
                $notifications = Notification::query()
                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                        $query->where('message', 'LIKE', '%' . $request->search . "%");
                    })
                ->where('store_id', \Auth::user()->store->id)
                    ->latest()
                    ->paginate($request->datatable_length);
            }else{
                $notifications = NULL;

            }
        }
        else{
            $notifications = NULL;
        }

        return response()->json([
            'status'        => 200,
            'notifications' => $notifications,
        ]);
    }



}
