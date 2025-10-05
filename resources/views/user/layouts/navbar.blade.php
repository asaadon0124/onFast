<body class="hold-transition sidebar-mini layout-fixed" style="direction: rtl">
  <div class="wrapper">
  
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
  
     
  
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-right">
       
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
           
           
            
            <a href="{{ route('user.profile') }}" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> الملف الشخصي
            </a>
            <div class="dropdown-divider"></div>
              <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                @csrf
                {{-- <i class="fas fa-sign out mr-2"></i> تسجيل الخروج --}}
                <input type="submit" value="تسجيل الخروج" class="form-control btn btn-primary btn-sm">
              </form>
            {{-- <a href="{{ route('logout') }}" class="dropdown-item">
                
              </a> --}}
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->