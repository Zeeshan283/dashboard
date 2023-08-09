<?php

namespace App\Http\Controllers;

use App\Models\BlogsSetting;
use App\Models\BlogsCategories;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class BlogsSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = BlogsCategories::orderBy('id')->pluck('title', 'id');
        $BlogsSetting = BlogsSetting::find(1);
        return view('blogs-settings.index', compact('categories','BlogsSetting'));
    }
    
    public function UpdateBlogsSettings(Request $request)
    {
        $blogssetting = BlogsSetting::find(1);
        $blogssetting->update($request->all());
        $blogssetting->save();
        return redirect()->back()->with(Toastr::success('Blogs Settings Update Successfully'));
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogsSetting  $blogsSetting
     * @return \Illuminate\Http\Response
     */
    public function show(BlogsSetting $blogsSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogsSetting  $blogsSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogsSetting $blogsSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogsSetting  $blogsSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogsSetting $blogsSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogsSetting  $blogsSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogsSetting $blogsSetting)
    {
        //
    }
}
