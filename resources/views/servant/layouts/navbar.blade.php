 
 
 
 
 
<div id="content">
 
 <!-- header -->
 <header >
    <div class="container">
        <div class="row bor_bottom">
            <div class="col-md-3">
                <div class="full">
                    <a class="logo" href="index.html"><img src="{{ asset('assets/admin/images/ca297136-78d1-422c-8274-0afa15d1b748.jpg') }}" style="height: 100px" alt="#" /></a>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="full">
                    <div class="right_header_info">
                        <ul>
                            <li style="margin-left:0;">
                                <button type="button" id="sidebarCollapse">
                                    <a href="{{ route('servant.logout') }}" class="btn btn-dark" style="color:#fff; float: right;margin-left:4px">الملف الشخصي</a>
                                    <a href="{{ route('servant.logout') }}" class="btn btn-dark" style="color:#fff;">تسجيل الخروج</a>
                                    {{-- <img src="{{ asset('assets/servant/images/menu_icon.png') }}" alt="#"> --}}
                                    
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->