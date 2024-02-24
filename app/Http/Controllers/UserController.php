<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class UserController extends Controller
{
    //
    function login(Request $req)
    {

        $req->validate([
            // 'name' => 'string|required|min:2',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where(['email' => $req->email])->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return back()->with('error', 'Invalid Emailid or passowrd');
        } else {
            $req->session()->put('user', $user);
            return redirect('/');
        }
    }

    // public function userlogin(Request $req)
    // {
    //     $user = User::where(['email' => $req->email])->first();
    //     if (!$user || !Hash::check($req->password, $user->password)) {
    //         return "Username or password is not matched";
    //     } else {
    //         $req->session()->put('user', $user);
    //         return redirect('/');
    //     }
    // }

    public function register(Request $req)
    {

        if (empty($req->all())) {
            $req->validate([
                'name' => 'required |alpha',
                'email' => 'required | email',
                'password' => 'required |min:10',
                'confirm_password' => 'required |same:password ',
                'phone' => 'required |numeric|digits:10',
                'gender' => 'required',
                'file' => [File::types(['pdf', 'doc', 'docx', 'rtf'])->min(512)->max(12 * 1024)]

            ]);
            echo '<pre>';
            print_r($req->all());
        }

        $customer  = new User;

        $vname = $req->validate(['name' => 'required | alpha']);
        $customer->name = implode(" ", $vname);

        $vemail = $req->validate(['email' => 'required | email']);
        $customer->email = implode(' ', $vemail);

        $vpassword = $req->validate(['password' => 'required |min:10']);
        $vpass_string = implode(' ', $vpassword);
        $customer->password = Hash::make($vpass_string);

        $vconfim_pass = $req->validate(['confirm_password' => 'required |same:password']);

        $customer->save();

        return back()->with('success', 'Register successfully');
    }

    // public function register()
    // {
    //     $user->name = $req->name;
    //     $user->email = $req->email;
    //     $user->password = Hash::make($req->password);
    //     $user->save();
    //     return  redirect('/login');
    // }
}
