<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Traits\fontAwesomeTrait;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    use fontAwesomeTrait;
    public function index()
    {
        return view('test');
    }

    public function GetUSersRelations()
    {
        $product = Product::all();
        return $product[0]->categories;
    }
}
