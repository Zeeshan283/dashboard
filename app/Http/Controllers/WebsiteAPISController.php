<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class WebsiteAPISController extends Controller
{
    public function GetAllMenus()
    {
        $menus = Menu::orderBy('id')->get(['id','name']);
        return $menus;
        // return json_encode(['data'=>$menus,'status'=>'ok']);
    }
}
