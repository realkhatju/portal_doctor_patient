<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    // direct admin list page
    public function index(){
        $userList = User::select('id','name','email','role','phone','address','gender')->get();
        return view('admin.list.index',compact('userList'));
    }

    // direct delete account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(["accountDelete" => "User Account Deleted!"]);
    }

    //admin list search
    public function adminSearchList(Request $request){
        $userList = User::orWhere('name','LIKE','%'.$request->nameSearchKey.'%')
                    ->orWhere('email','LIKE','%'.$request->nameSearchKey.'%')
                    ->orWhere('phone','LIKE','%'.$request->nameSearchKey.'%')
                    ->orWhere('address','LIKE','%'.$request->nameSearchKey.'%')
                    ->orWhere('gender','LIKE','%'.$request->nameSearchKey.'%')
                    ->get();
        return view('admin.list.index',compact('userList'));
    }
}
