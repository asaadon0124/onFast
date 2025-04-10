@extends('admin.layouts.master')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ auth()->user()->name }}</h4>
            </div>
        </div>
    </div>
	@include('admin.alerts.errors')

    <!-- row -->
        <div class="row row-sm">
            
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">تغير كلمة السر</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form  class="parsley-style-1"  name="selectForm2"  action="{{ route('pro.make_change_password',$admin->id) }}" method="POST">
                            @csrf
                           
                            
                        
                            <div class="row">
                        
                                {{--  ADMIN ID   --}}
                                <input type="hidden" name="admin_id"  value="{{ $admin->id }}" >
                            
                                {{--  ADMIN OLD PASSWORD   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> كلمة السر القديمة </label>
                                        <input type="text" name="old_password" class="form-control" placeholder="ادخل كلمة السر القديمة">
                                        @error("old_password")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{--  ADMIN NEW PASSWORD   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> كلمة السر الجديدة </label>
                                        <input type="text" name="new_password" class="form-control" placeholder="ادخل  كلمة السر الجديدة">
                                        @error("new_password")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{--  ADMIN CONFERM NEW PASSWORD   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> تاكيد كلمة السر الجديدة </label>
                                        <input type="text" name="confirm_password" class="form-control" placeholder="ادخل كلمة السر الجديدة مرة اخري">
                                        @error("confirm_password")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="mg-t-30">
                                <button class="btn btn-main-primary pd-x-20 makeUpdateGov"  type="submit">تعديل كلمة السر </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    <!-- row -->

				
			
@endsection


