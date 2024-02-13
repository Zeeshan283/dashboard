<?php

namespace App\Http\Controllers;

use App\Models\ProductContact;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class ProductContactController extends Controller
{
    public function index()
    {
        $data = "";
        if (Auth::user()->role == 'Admin') {
            $data = ProductContact::all();
        } elseif (Auth::user()->role == 'Vendor') {
            $data = ProductContact::orderBy('id', 'desc')->where('supplier_id', Auth::user()->id)->get();
        }

        return view('products.customerqueries', compact('data'));
    }


    // public function store(Request $request)
    // {
    //     $data = Notification::create([
    //         'user_id' => Auth::user()->id,
    //         'message' => 'New query created with ID ' . $data->id,
    //         'id' => $data->id,
    //     ]);

    //     return view('products.customerqueries', compact('data'));
    // }


    public function show($id)
    {
        $data = ProductContact::findorFail($id);
        return view('products.contactDetail', compact('data'));
    }
    //  public function show(Request $request)
    //  {
    //      $request->validate([
    //          'make' => 'required|string|max:255',
    //          'message' => 'required|string',
    //      ]);

    //      $value = new ProductContact();
    //      $value->make = $request->input('make');
    //      $value->message = $request->input('message');
    //      $value->timestamp = now();

    //      $value->vendor_id = Auth::user()->id;

    //      $value->save();
    //      return redirect()->route('CustomerQueries.show');
    //  }


    //     public function notification(Request $request)
    //     {
    //         $request->validate([
    //             'make' => 'required|string|max:255',
    //             'message' => 'required|string',
    //         ]);

    //         $value = new ProductContact();
    //         $value->name = Auth::user()->name;
    //         $value->message = $request->message;
    //         $value->timestamp = now();
    //         $value->save();

    //         // Create a new notification record
    //         $notification = new Notification();
    //         $notification->name = Auth::user()->name;
    //         $notification->message = $request->message;
    //         $notification->timestamp = now();
    //         $notification->save();

    //         // Get queries created within the last 24 hours
    //         $data = ProductContact::where('timestamp', '>=', now()->subDay())->get();

    //         return redirect()->route('CustomerQueries.index')->with('data', $data);
    //     }

    //     public function getNotifications()
    //     {
    //         $unreadNotifications = Notification::where('name', Auth::user()->name)
    //             ->where('read', false)
    //             ->where('timestamp', '>=', now()->subDay())
    //             ->get();

    //         $unreadNotificationsCount = $unreadNotifications->count();

    //         return view('layouts.header', compact('unreadNotifications', 'unreadNotificationsCount'));
    //     }



    // public function markNotificationAsRead($id)
    // {
    //     $notification = Notification::findOrFail($id);
    //     $notification->read = true;
    //     $notification->save();

    //     // Redirect back to the referring page
    //     return redirect()->back();
    // }


}
