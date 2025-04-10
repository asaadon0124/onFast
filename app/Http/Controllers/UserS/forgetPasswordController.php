<?php

namespace App\Http\Controllers\UserS;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\User_forget_password;


class forgetPasswordController extends Controller
{
    public function forgetPasswordUser()
    {
        return view('user.password.forgetPassword');
    }
    
    

    public function sendEmail(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        
        if ($user) 
        {
            // return $user;
            // $user_id = base64_encode($user->id);
            $token = Str::random(32);
            Mail::to($user->email)->send(new User_forget_password($user->name, $user->email,$token));    
          
            $updatePassword = DB::table('password_reset_tokens')->insert(
            [
                'email'         => $request->email,
                'token'         => $token,
                'created_at'    => now(), // Optionally, you can add a timestamp
            ]);
            return redirect()->back()->with(['success' => 'Email Sent Successfally Please Check Your email']);

        } else 
        {
            return "no user";
            return redirect()->back()->with(['error' => 'This Email Not Found']);
        }
        
    }
    

    public function showResetPasswordForm($token) 
    { 
       return view('user.password.changePassword', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate(
        [
            'email'                   => 'required|email|exists:users',
            'password'                => 'required|string|min:6|confirmed',
            'password_confirmation'   => 'required'
        ]);
        // return $request;

        $updatePassword = DB::table('password_reset_tokens')->where(
                        [
                            'email' => $request->email, 
                            'token' => $request->token
                        ])->first();

        if(!$updatePassword)
        {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect()->route('welcome')->with('message', 'Your password has been changed!');
    }
}
