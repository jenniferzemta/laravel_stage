<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Brian2694\Toastr\Facades\Toastr;


class ForgotPasswordController extends Controller
{
    /** get email*/
    public function getEmail()
    {
       return view('auth.passwords.email');
    }

    /** post email */
    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.verify',['token' => $token], function($message) use ($request) {
            $message->from($request->email);
            $message->to('laurejennifer06@gmail.com'); /** input your email to send */
            $message->subject('Reset Password Notification');
            });
        Toastr::success('We have e-mailed your password reset link! :)','Success');
        return redirect()->back();
    }


/*class ForgotPasswordController extends Controller
{
    public function getEmail()
    {
       return view('auth.passwords.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.verify',['token' => $token], function($message) use ($request) {
                  $message->from($request->email);
                  $message->to('laurejennifer06@gmail.com');
                  $message->subject('Reset Password Notification');
               });
        Toastr::success('We have e-mailed your password reset link! :)','Success');
        return back();
    }*/

//resert password//
    public function getPassword($token)
    {

       return view('auth.passwords.reset', ['token' => $token]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        if(!$updatePassword)
        {
            Toastr::error('Invalid token! :)','Error');
            return back();
        }
        else{
            
            $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
            Toastr::success('Your password has been changed! :)','Success');
            return redirect('/login');
        }
       
    }
}
