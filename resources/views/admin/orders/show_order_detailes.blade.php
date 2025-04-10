@extends('admin.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


@endsection

@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">

								
				{{--  START GET FLASH MESSAGES   --}}
								<div class="row mr-2 ml-2" id="successMsg" style="display: none">
									<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
											تم الحزف بنجاح
									</button>
								</div>

								@include('admin.alerts.success')
								@include('admin.alerts.errors')

							{{--  END GET FLASH MESSAGES   --}}
								

					<div class="row mr-2 ml-2" id="successMsg" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							تم حزف الشحنة من المخزن بنجاح
						</button>
					</div>
					<div class="row mr-2 ml-2" id="successStatus" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							تم تعديل الحالة بنجاح
						</button>
					</div>

					
				{{--  END GET FLASH MESSAGES   --}}


								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1" rowID="{{ $order->count()+1 }}">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0"> رقم</th>
												<th class="wd-1p border-bottom-0"> الشحنة رقم</th>
												<th class="wd-1p border-bottom-0"> الشحنة ID</th>
												<th class="wd-3p border-bottom-0">اسم المستلم</th>
												<th class="wd-20p border-bottom-0">تليفون المستلم </th>
												<th class="wd-15p border-bottom-0">عنوان المستلم</th>
												<th class="wd-10p border-bottom-0">اسم المورد</th>
												<th class="wd-10p border-bottom-0">تليفون المورد</th>
												<th class="wd-10p border-bottom-0">اسم المحافظة</th>
												<th class="wd-10p border-bottom-0">اسم المدينة</th>
												<th class="wd-10p border-bottom-0">قيمة الشحنة</th>
												<th class="wd-10p border-bottom-0">قيمة الشحن</th>
												<th class="wd-10p border-bottom-0">اجمالي التكلفة</th>
												<th class="wd-10p border-bottom-0">ربح الشركة</th>
												<th class="wd-10p border-bottom-0">اسم المندوب</th>
												<th class="wd-10p border-bottom-0">حالة الشحنة</th>
												<th class="wd-10p border-bottom-0">تاريخ التسليم</th>
												
											</tr>
										</thead>
										<tbody>
											@if ($order->orders_detailes && $order->orders_detailes->count() > 0)
											@php
												$x = 1;
											@endphp
											@foreach ($order->orders_detailes as $item)
												<tr>
													<td>{{ $x++ }}</td>
													<td>{{ $item->id }}</td>
													<td>{{ $item->product->package_number }}</td>
													<td>{{ $item->product->resever_name }}</td>
													<td>{{ $item->product->phone}}</td>
													<td>{{ $item->product->adress}}</td>
													<td>{{ $item->product->supplier->name }}</td>
													<td>{{ $item->product->supplier->phone }}</td>
                                                    <td>{{ $item->product->cities->governorate->name }}</td>
                                                    <td>{{ $item->product->cities->name }}</td>
                                                    <td>{{ $item->product->product_price }} جنيه</td>
                                                    <td>{{ $item->shipping_price }} جنيه</td>
                                                    <td>{{ $item->total_price }} جنيه</td>
                                                    <td>{{ $item->profit }} جنيه</td>
                                                    <td>{{ $item->order->servant->name }}</td>
                                                    <td>{{ $item->status->name }}</td>
													<td>{{ $item->product->created_at }}</td>
												</tr>
											@endforeach
											@else
												<h1>لا يوجد مديرين</h1>
											@endif										
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

				

				
				
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
	<!-- Internal Data tables -->
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

	<!--Internal  Datatable js -->
	<script src="{{URL::asset('assets/js/table-data.js')}}"></script>


	<!--Internal  Datepicker js -->
	<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
	<!-- Internal Select2 js-->
	<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
	<!-- Internal Modal js-->
	<script src="{{URL::asset('assets/js/modal.js')}}"></script>



	{{--  CREATE NEW ADMIN   --}}

	
@endsection