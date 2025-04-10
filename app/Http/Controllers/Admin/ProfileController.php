<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\changePasswordRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = auth()->user();
        return \view('admin.profile.edit',compact('admin'));
    }

    public function update(Request $request)
    {
        // return $request;
        $admin_id= auth()->user()->id;

        if (!$admin_id) 
        {
            return \redirect()->route('admins.index')->with(['error' => 'هذا المدير غير موجود']);
        }else
        {
            try 
            {
                $admin = Admin::find($admin_id);
                $admin->update(
                    [
                        'name'          => $request->name,
                        'email'         => $request->email,
                        'phone'         => $request->phone,
                    ]);
                    return \redirect()->route('admins.index')->with(['success' => 'تم تعديل بيانات المدير بنجاح']);

            } catch (\Throwable $th) 
            {
                return \redirect()->route('admins.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
            }
        }
    }

    public function change_password()
    {
        $admin = auth()->user();
        return \view('admin.profile.change_password',compact('admin'));
    }

    public function make_change_password(changePasswordRequest $request)
    {
        // return $request;
        $admin_id= auth()->user()->id;
        $admin = auth()->user();

       try 
       {
            if (Hash::check($request->old_password,$admin->password)) 
            {
                $update = $admin->update(
                    [
                        'password' => \bcrypt($request->new_password)
                    ]);
                    return \redirect()->route('admins.index')->with(['success' => 'تم تغير كلمة السر بنجاح']);

            }else
            {
                return redirect()->back()->with(['error' => 'كلمة السر القديمة غير صحيحة']);
            }

       } catch (\Throwable $th) 
       {
            return \redirect()->route('admins.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
       }
    }
}
