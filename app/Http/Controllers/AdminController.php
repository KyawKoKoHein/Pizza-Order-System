<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // change password page
    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }

    // change password
    public function changePassword(Request $request)
    {
        // all field must be fill
        // new passsword and confirm password's length must be greater than 6
        // new password and confirm password must be same
        // client old password must be same with db password
        // password change

        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;

        $user = User::select('password')->where('id', $currentUserId)->first();
        $dbHashPassword = $user->password; // hash password

        if (Hash::check($request->oldPassword, $dbHashPassword)) {
            User::where('id', $currentUserId)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            // Auth::logout();

            return redirect()->route('category#list')->with('changePasswordSuccess', 'Password is successfully changed');
        } else {
            return back()->with(['notMatch' => 'The old password is not match! Try Again...']);
        }
    }

    // direct admin details page
    public function details()
    {
        return view('admin.account.details');
    }

    // direct admin profile page
    public function edit()
    {
        return view('admin.account.edit');
    }

    // update account
    public function update($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // For Image
        if ($request->hasFile('image')) {
            // old image name | check => delete | store
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/', $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName); // for saving image in project
            $data['image'] = $fileName; // for saving image in database
        }


        User::where('id', $id)->update($data);
        return redirect()->route('admin#details')->with('updateProfileSuccess', 'Your profile is successfully updated');
    }


    // Request User Data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

    // Account Validation Check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required',
        ])->validate();
    }

    // password validtaion check
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
