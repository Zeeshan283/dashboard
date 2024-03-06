<?php
namespace App\Http\Controllers;

use App\Models\ProductContact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductContactController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->has('supplier_name')) {
        $names = $request->input('supplier_name');
        if (is_array($names)) {
            $query->whereIn('supplier_name', $names);
        } else {
            $query->where('supplier_name', $names);
        }
    }

    if ($request->has('customer_name')) {
        $cname = $request->input('customer_name');
        if (is_array($cname)) {
            $query->whereIn('customer_name', $cname);
        } else {
            $query->where('customer_name', $cname);
        }
    }

    if ($request->has('pro_name')) {
        $proname = $request->input('pro_name');
        if (is_array($proname)) {
            $query->whereIn('pro_name', $proname);
        } else {
            $query->where('pro_name', $proname);
        }
    }

    if ($request->has('pro_model_name')) {
        $modelname = $request->input('pro_model_name');
        if (is_array($modelname)) {
            $query->whereIn('pro_model_name', $modelname);
        } else {
            $query->where('pro_model_name', $modelname);
        }
    }

    $data = "";
    if (Auth::user()->role == 'Admin') {
        $data = $query->get();
        $data = ProductContact::all();
    } elseif (Auth::user()->role == 'Vendor') {
        $data = $query->where('supplier_id', Auth::user()->id)->get();
        $data = ProductContact::orderBy('id', 'desc')->where('supplier_id', Auth::user()->id)->get();
    }

    return view('products.customerqueries', compact('data', 'query'));
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
