<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class adminsController extends Controller
{
   
    public function index()
    {
        $admins = Admin::orderBy('created_at','desc')->get();
        return \view('admin.admins.index',\compact('admins'));
    }

   

    
    public function store(AdminRequest $request)
    {
        try
        {
            // CREATE DATA ON DATABASE 
            $create = Admin::create(
                [
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'phone'     => $request->phone,
                    'password'  => bcrypt($request->password),
                ]);
                

                // RETURN FLASH MESSAGE 
                if($create)
                {
        
                    return response()->json(
                        [
                            'status' => true,
                            'msg' => 'تم الحفظ بنجاح',
                            'dataa' => $create
                        ]);
                }else
                {
                    return response()->json(
                        [
                            'error' => 'هناك خطا ما برجاءالمحاولة فيما بعد'
                        ]);
                }
        }catch (\Throwable $th) 
        {

            return $th;
            return \redirect()->route('admins.index')->with(['error' => 'Something Error Please Try Again Later']);
        }
    }

   
    public function edit($id)
    {
        $admin = Admin::find($id);
        return \view('admin.admins.edit',\compact('admin'));
    }


   
    public function update(Request $request,$id)
    {
        $adminUpdate = Admin::find($id);
        // return $request;
        
        if($adminUpdate)
        {
            // return $request;
            $updateaa = $adminUpdate->update(
                [
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'phone'         => $request->phone,
                    'password'  => bcrypt($request->password),
                ]);
        
            return \redirect()->route('admins.index')->with(['success' => 'تم تعديل بيانات المدير بنجاح']);
        }else
        {
            return \redirect()->route('admins.index')->with(['error' => 'هذا المدير غير موجود']);
        }
    }

    
    public function destroy(Request $request)
    {
        $admin_delete = Admin::find($request->id);
        $admin_delete->delete();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم الحزف بنجاح',
                'id' => $request->id,
            ]);
    }
}
