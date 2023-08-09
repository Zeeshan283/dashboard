<?php

namespace App\Http\Controllers;

use App\Models\EventCategories;
use App\Models\Events;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class EventCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $eventCategories = EventCategories::select('id', 'title')->OrderBy('id')->get();
        return view('event-categories.index', compact('eventCategories'));
    }

    public function create()
    {
        return view('event-categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        EventCategories::create($request->all());
        return redirect()->back()->with(Toastr::success('Event Category Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = EventCategories::findOrFail($id);
        return view('event-categories.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $edit = EventCategories::findOrFail($id);
        $edit->update($request->all());

        return redirect('events-categories')->with(Toastr::success('Event Category Updated Successfully!'));
    }

    public function destroy($id)
    {
        EventCategories::findOrFail($id)->delete();
        $events = Events::where('event_category_id',$id)->get();
        foreach($events as $value)
        {
            File::delete('root/upload/events/big/'.$value->image);
            File::delete('root/upload/events/medium/'.$value->image);
            File::delete('root/upload/events/small/'.$value->image);
        }
        Events::where('event_category_id',$id)->delete();
        return redirect()->back()->with(Toastr::success('Event Category Deleted Successfully!'));
    }
}
