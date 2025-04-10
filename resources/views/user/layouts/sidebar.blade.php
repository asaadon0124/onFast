  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">On Fast</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="{{ route('user.profile') }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               
          <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                الصفحة الرئيسية
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="{{ route('user.index.product') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                كل الشحنات
                <span class="badge badge-info right">2</span>
              </p>
            </a>
           
          </li>
         
          <li class="nav-item">
            <a href="{{ route('user.create.product') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                اضافة شحنة جديدة
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{route('user.index.reborts')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                التقارير
                <span class="right badge badge-danger">جديد</span>
              </p>
            </a>
          </li>
         
         
         
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
