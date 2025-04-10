<?php

namespace App\Http\Controllers\UserS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\userLoginRequest;

class loginController extends Controller
{
    public function makeLogin(userLoginRequest $request)
    {
        // return $request;



        if(Auth::guard('web')->attempt(['email' =>$request->email,'password' =>$request->password]))
        {
            return redirect()->route('home');
        }
        return back()->with(['error' => 'البيانت غير صحيحة']);
    }
}
