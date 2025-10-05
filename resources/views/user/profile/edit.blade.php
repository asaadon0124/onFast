@extends('user.layouts.app')
@section('nav_title')
    الملف الشخصي
@endsection
@section('content')
    <div id="contact" class="section wb">


        <div class="card">
            <div class="card-title">
                <div id="flashMessages">
                    @include('admin.alerts.success')
                    @include('admin.alerts.errors')
               </div>
               <h3 class="text-center">تعديل الملف الشخصي</h3>
            </div>


            <div class="card-body">
                <form  class="row" action="{{ route('user.profile.update') }}" name="contactform" method="post" style="direction: rtl">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="name"  class="form-control" placeholder=" اسم المستخدم" value="{{ auth()->user()->name }}">
                            @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="email"  class="form-control" placeholder=" البريد الالكتروني للمستخدم" value="{{ auth()->user()->email }}">
                            @error("email")
                                    <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="phone"  class="form-control" placeholder="  تليفون المستخدم" value="{{ auth()->user()->phone }}">
                            @error("phone")
                                    <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="password"  class="form-control" placeholder="   كلمة المرور">
                            @error("password")
                                    <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="password_confirmation"  class="form-control" placeholder="  تاكيد كلمة المرور ">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="submit" value="تعديل" class="btn btn-warning btn-radius btn-brd grd1 btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="section-title text-center">

             

               
            </div><!-- end title -->



            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                       
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
            
          
            
        </div><!-- end container -->
    </div>
@endsection
@section('js')
    <script>
        $("#flashMessages").fadeOut(3000);
    </script>
@endsection