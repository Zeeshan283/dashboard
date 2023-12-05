<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\FAQCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class FAQController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = FAQ::get(['id', 'question', 'answer', 'faq_category_id']);
        return view('faqs.index', compact('data'));
    }

    public function create()
    {
        $category = FAQCategory::all();
        return view('faqs.create', compact('category'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ], []);

        FAQ::create($request->all());


        Toastr::success('FAQ Added Successfully!');
        return redirect()->route('faqs.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = FAQ::with('faq_category')->findOrFail($id);
        $category = FAQCategory::all();
        return view('faqs.edit', compact('edit', 'category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ], []);

        $update1 = FAQ::findOrFail($id);
        $update = FAQ::findOrFail($id);
        $update->update($request->all());


        Toastr::success('FAQ Updated Successfully!');
        return redirect()->route('faqs.index');
    }

    public function destroy($id)
    {
        $delete = FAQ::findOrFail($id);
        $delete->delete();

        return redirect()->back()->with(Toastr::success('FAQ Deleted Successfully!'));
    }
}
