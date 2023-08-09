<?php

namespace App\Http\Controllers;

use App\Models\EventCategories;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Events::with('event_category:id,title')->orderBy('id')->get();
        return view('events.index', compact('data'));
    }

    public function create()
    {
        $eventsCategories = EventCategories::orderBy('id')->pluck('title','id');
        return view('events.create',compact('eventsCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'event_category_id'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg',
            'description'=>'required'
        ],
        [
            'event_category_id.required'=>'The event category field is required'
        ]);
        $e = Events::create($request->all());
        $e->slug = Str::slug($request->title);
        $e->save();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = uniqid().$file->getClientOriginalName();

            //prorgam image save in 930 x 500
            $imagePath =  base_path('upload/events/big/' . $fileName);
            $img = Image::make($file);
            $img->resize(930, 500);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/events/medium/' . $fileName);
            $img = Image::make($file);
            $img->resize(600, 420);
            $img->save($imagePath);

            //prorgam image save in 600 x 420
            $imagePath =  base_path('upload/events/small/' . $fileName);
            $img = Image::make($file);
            $img->resize(100, 70);
            $img->save($imagePath);

            $e->image = $fileName;
            $e->save();
        }

        return redirect()->back()->with(Toastr::success('Event Added Successfully!'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Events::findOrFail($id);
        $eventsCategories = EventCategories::orderBy('id')->pluck('title','id');
        if($edit)
        {
            return view('events.edit',compact('edit','eventsCategories'));
        }else{
            abort(404);
        }
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'event_category_id'=>'required',
            'image'=>'mimes:png,jpg,jpeg',
            'description'=>'required'
        ],
        [
            'event_category_id.required'=>'The event category field is required'
        ]);

        $edit1 = Events::findOrFail($id);
        $edit = Events::findOrFail($id);
        if($edit)
        {
            $edit->update($request->all());
            $edit->slug = Str::slug($request->title);
            $edit->save();


            if($request->hasFile('image'))
            {
                File::delete('root/upload/events/big/'.$edit1->image);
                File::delete('root/upload/events/medium/'.$edit1->image);
                File::delete('root/upload/events/small/'.$edit1->image);

                $file = $request->file('image');
                $fileName = uniqid().$file->getClientOriginalName();

                //prorgam image save in 930 x 500
                $imagePath =  base_path('upload/events/big/' . $fileName);
                $img = Image::make($file);
                $img->resize(930, 500);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/events/medium/' . $fileName);
                $img = Image::make($file);
                $img->resize(600, 420);
                $img->save($imagePath);

                //prorgam image save in 600 x 420
                $imagePath =  base_path('upload/events/small/' . $fileName);
                $img = Image::make($file);
                $img->resize(100, 70);
                $img->save($imagePath);

                $edit->image = $fileName;
                $edit->save();
            }


            return redirect('/our-events')->with('flash_message', 'Event Updated Successfully!');
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = Events::findOrFail($id);
        if($data)
        {
            File::delete('root/upload/events/big/'.$data->image);
            File::delete('root/upload/events/medium/'.$data->image);
            File::delete('root/upload/events/small/'.$data->image);
            $data->delete();
            return redirect()->back()->with('flash_message', 'Event Deleted Successfully');;
        }else{
            abort(404);
        }
    }
}
