<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function index()
    {
        $data = []; 

        return view('emails.index', compact('data'));
    }

    public function edit($emailId)
    {    
        return view('emails.edit', compact('emailId'));
    }
    
}
