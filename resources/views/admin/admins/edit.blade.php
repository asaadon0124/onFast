@extends('admin.layouts.master')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Forms</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Form-Elements</span>
            </div>
        </div>
    </div>

    <!-- row -->
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Vertical Form</h4>
                        <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
                    </div>
                    <div class="card-body pt-0">
                        <form  class="parsley-style-1"  name="selectForm2"  action="{{ route('admins.update',$admin->id) }}" method="POST">
                            @csrf
                            @method('PUT')


                            <div class="row">

                                {{--  ADMIN ID   --}}
                                <input type="hidden" name="admin_id"  value="{{ $admin->id }}" >

                                {{--  ADMIN NAME   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">اسم المدير </label>
                                        <input type="text" name="name" class="form-control" placeholder="ادخل اسمالمدير" value="{{ $admin->name }}">
                                        @error("name")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{--  ADMIN PHONE   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">ايميل المدير </label>
                                        <input type="email" name="email" class="form-control" placeholder="ادخل ايميل المدير" value="{{ $admin->email }}">
                                        @error("email")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{--  ADMIN EMAIL   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">تليفون المدير </label>
                                        <input type="number" name="phone" class="form-control" placeholder="ادخل تليفون المدير" value="{{ $admin->phone }}">
                                        @error("phone")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                 {{--  ADMIN PHONE   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">كلمة السر المدير </label>
                                        <input type="text" name="password" class="form-control" placeholder="ادخل كلمة السر المدير">
                                        @error("password")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                               


                            <div class="mg-t-30">
                                <button class="btn btn-main-primary pd-x-20 makeUpdateGov"  type="submit">تعديل بيانات المدير </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- row -->



@endsection


