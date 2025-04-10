<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">

				<a class="desktop-logo logo-light active" href="{{ route('Dashboard.history') }}" style="margin-bottom: 10px">
					<img src="{{ asset('assets/admin/images/Untitled-10 copy.jpg') }}" alt="" style="margin-bottom: 20px">
				</a>


				{{-- <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a> --}}
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">

				<ul class="side-menu">
					<li class="side-item side-item-category">Main</li>



					{{--  المديرين   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">المديرين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admins.index') }}">كل المديرين</a></li>
							<span class="badge badge-success side-badge">
								{{ App\Models\Admin::all()->count() }}
							</span>

						</ul>
					</li>

					{{--  المناديب   --}}

					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">المناديب</span><i class="angle fe fe-chevron-down"></i></a>

						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('servants.index') }}">كل المناديب</a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Servant::all()->count() }}
								</span>
							</li>

							<li>
								<a class="slide-item" href="{{ route('servants.getSoftDelete') }}"> المناديب المحزوفة</a>
								<span class="badge badge-danger side-badge">
									{{ App\Models\Servant::onlyTrashed()->get()->count() }}
								</span>
							</li>
						</ul>

					</li>


					{{--  الوظائف   --}}

					<li class="slide" hidden>

						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">الوظائف</span><i class="angle fe fe-chevron-down"></i></a>

						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('permissions.index') }}">كل الصلاحيات</a>
								<span class="badge badge-success side-badge">
									{{ App\Permission::all()->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('roles.index') }}">كل الوظائف</a>
								<span class="badge badge-success side-badge">
									{{ App\Role::all()->count() }}
								</span>
							</li>
						</ul>

					</li>



					{{--   المحافظات   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label"> المحافظات</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('governorates.index') }}">كل المحافظات</a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Governorate::all()->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('governorates.getSoftDelete') }}"> المحافظات المحزوفة</a>
								<span class="badge badge-danger side-badge">
									{{ App\Models\Governorate::onlyTrashed()->get()->count() }}
								</span>
							</li>
						</ul>
					</li>

					{{--   المدن   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label"> المدن</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('cities.index') }}">كل المدن</a>
								<span class="badge badge-success side-badge">
									{{ App\Models\City::all()->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('cities.getSoftDelete') }}"> المدن المحزوفة</a>
								<span class="badge badge-danger side-badge">
									{{ App\Models\City::onlyTrashed()->get()->count() }}
								</span>
							</li>
						</ul>
					</li>

					{{--   الموردين   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">  ( الراسلين ) الموردين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('suppliers.index') }}">كل الموردين(الراسلين)</a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Supplier::all()->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('suppliers.getSoftDelete') }}"> الموردين (الراسلين)المحزوفة</a>
								<span class="badge badge-danger side-badge">
									{{ App\Models\Supplier::onlyTrashed()->get()->count() }}
								</span>
							</li>
						</ul>
					</li>

					{{--   الشحنات ( المخزن)   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">   المخزن </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('products.index') }}">   ( المخزن) </a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Product::where('type',0)->where('returns',0)->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('products.newProducts_Index') }}">   ( الشحنات الجديدة) </a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Product::where('type',4)->where('returns',0)->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('products.uncompleateProducts') }}">  شحنات تحت التسليم </a>
								<span class="badge badge-danger side-badge">
									{{ App\Models\Product::where('type',1)->where('status_id',2)->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('products.compleatedProducts') }}">  التسليمات </a>
								<span class="badge badge-danger side-badge">
									{{ App\Models\Product::where('type',1)->where('status_id',5)->orWhere('status_id',6)->count() }}
								</span>
							</li>
							
							
							<li>
								<a class="slide-item" href="{{ route('products.deletedProducts') }}">  الشحنات المحزوفة </a>
								<span class="badge badge-danger side-badge">
									{{ App\Models\Product::onlyTrashed()->count() }}
								</span>
							</li>
						</ul>
					</li>


					{{--    ( خطوط السير)   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">  انشاء خط سير جديد </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('orderDetailes.create') }}"> انشاء خط سير جديد</a>
								<span class="badge badge-success side-badge">
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('orderDetailes.submit_new_order') }}">طباعة خط السير</a>
								<span class="badge badge-danger side-badge">
								</span>
							</li>
						</ul>
					</li>

					{{--   خطوط السير   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">  خطوط السير  </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('orders.index') }}"> كل خطوط السير </a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Order::all()->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('orders.softDelete') }}"> التسليمات</a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Order::onlyTrashed()->get()->count() }}
								</span>
							</li>
							
							 <li>
                        <a class="slide-item" href="{{ route('reserves.index') }}">  الشحنات المسلمة </a>
                        <span class="badge badge-danger side-badge">
                             {{ App\Models\Reserve::get()->count() }}
                        </span>
                    </li>
						</ul>
					</li>


					{{--   المرتجعات   --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">  المرتجعات  </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>
								<a class="slide-item" href="{{ route('returns.index') }}"> كل الالغائات </a>
								<span class="badge badge-success side-badge">
									{{ App\Models\OrderDetailes::where('product_status',3)->orWhere('product_status',4)->withTrashed()->count() }}
								</span>
							</li>
							<li>
								<a class="slide-item" href="{{ route('returns.softDelete') }}"> المرتجعات المسلمة للعميل</a>
								<span class="badge badge-success side-badge">
									{{ App\Models\Product::where('returns',1)->where('type',2)->count() }}
								</span>
							</li>
						</ul>
					</li>

					{{--    التقارير  --}}
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href=""><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">  التقارير  </span><i class="angle fe fe-chevron-down"></i></a>

						<ul class="slide-menu">
							{{-- <li><a class="slide-item" href="{{ route('reborts.index') }}"> كل التقارير </a></li> --}}
							{{-- <li><a class="slide-item" href="{{ route('reborts.allProducts') }}"> كل الشحنات </a></li> --}}
							<li><a class="slide-item" href="{{ route('reborts.servantindex') }}">تقارير المناديب</a></li>
							<li><a class="slide-item" href="{{ route('reborts.castomerIndex') }}">تقارير (الموردين) العملاء</a></li>
							<li><a class="slide-item" href="{{ route('reborts.orderNumber_index') }}">تقارير  برقم الفاتورة</a></li>
						</ul>
					</li>

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
