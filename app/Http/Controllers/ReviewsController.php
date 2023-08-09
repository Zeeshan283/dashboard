<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Reviews = Reviews::with('product')->orderBy('id','desc')->get();
        return view('products.reviews',compact('Reviews'));
    }

    public function approveReview($review_id)
    {
        Reviews::find($review_id)->update([
            'status'=>1
        ]);
        return redirect()->back()->with(Toastr::success('Review Approved Successfully!'));
    }    

    public function DeleteReview($review_id)
    {
        Reviews::find($review_id)->delete();
        return redirect()->back()->with(Toastr::success('Review Deleted Successfully!'));
    }    
}
