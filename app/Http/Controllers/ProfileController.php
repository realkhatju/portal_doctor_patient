<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $id = Auth::user()->id;

        $userInfo = User::select('name','id','gender','email','phone','address','password')->where('id',$id)->first();
        // dd($userInfo->toArray());
        return view('admin.profile.index',compact('userInfo'));
    }

    // update admin account
    public function adminAccountUpdate(Request $request){
        $userData = $this->getUserInfo($request);

        $validator = $this->userValidationCheck($request);

        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Account Updated Successfully']);
    }

    // direct Change Password
    public function directChangePassword(){
        return view('admin.profile.changePassword');
    }

    // Direct Change Password
    public function changePassword(Request $request){
        $validator = $this->changePasswordValidationCheck($request);

        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        // dd($request->all());
        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        $hashUserPassword = Hash::make($request->newPassword);

        $updateData = [
            'password' => $hashUserPassword,
            'updated_at' => Carbon::now()
        ];
        // dd($hashUserPassword);
        if(Hash::check($request->currentPassword,$dbPassword)){
            User::where('id',Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        }else{
            return back()->with(['fail'=>"Old Password doesn't match"]);
        }
        // dd($dbPassword->toArray());
    }

    // get user info
    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'address' => $request->adminAddress,
            'phone' => $request->adminPhone,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now(),
        ];
    }

    // user validation check
    private function userValidationCheck($request){
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required'
            ],[
                'adminName.required' => 'Need to Fill Name',
                'adminEmail.required' => 'Need to Fill Email'
            ]);
    }

    // validation change password
    private function changePasswordValidationCheck($request){
        $validationRules = [
                'currentPassword' => 'required',
                'newPassword' => 'required|min:8|max:15',
                'confirmPassword' => 'required|same:newPassword|min:8|max:15',
            ];
            // $validationMessageShowing = [
            //     'currentPassword.required' => 'Need to Fill Current Password',
            //     'newPassword.required' => 'Need to Fill New Password',
            //     'confirmPassword.required' => 'Need to Fill Confirm Password',
            // ];
            $validationMessage = [
                'confirmPassword.same' => 'Newpassword and Confirmpassword are not match',
            ];
            return Validator::make($request->all(),$validationRules,$validationMessage);
    }
}
