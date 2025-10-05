  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('assets/admin/images/ca297136-78d1-422c-8274-0afa15d1b748.jpg') }}" alt="On Fast Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
          <a href="{{ route('user.profile') }}" style="height: 40px;"  class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               
          <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link @if(Request::segment(1) == 'home' && Request::segment(2) == '') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                الصفحة الرئيسية
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="{{ route('user.index.product') }}" class="nav-link @if(Request::segment(1) == 'users' && Request::segment(2) == 'index_product') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                كل الشحنات
                @php 
                  $products = App\Models\Supplier::where('phone',auth()->user()->phone)->with('products_supplier')->first();
                @endphp
                 @if(isset($products))
                <span class="badge badge-info right">{{ $products->products_supplier->count() }}</span>
              @else
                <span class="badge badge-info right">0</span>
              @endif
              </p>
            </a>
           
          </li>
         


          <!-- <li class="nav-item">
            <a href="{{ route('user.create.product') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                اضافة شحنة جديدة
              </p>
            </a>
          </li> -->


          <li class="nav-item">
            <a href="{{route('user.index.reborts')}}" class="nav-link @if(Request::segment(1) == 'users' && Request::segment(2) == 'reborts') active @endif">
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
