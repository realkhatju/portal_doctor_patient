<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermController extends Controller
{
    //perm
    public function index(){
        return view('admin.perm.index');
    }
}
