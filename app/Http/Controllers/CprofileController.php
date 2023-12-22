<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cprofile;

class CprofileController extends Controller
{
    public function index()
    {
        $data = Cprofile::all();
        return view('cprofile.index', compact('data'));
    }

    public function create()
    {
        return view('cprofile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pcategory' => 'required|string|max:255',
        ]);
        Cprofile::create([
            'pcategory' => $request->input('pcategory'),
        ]);

        return redirect()->route('cprofile.index')->with('success', 'Category created successfully');
    }

    public function destroy($id)
    {
        $profile = Cprofile::findOrFail($id);
        $profile->delete();

        return redirect()->route('cprofile.index')->with('success', 'Category deleted successfully');
    }
}
