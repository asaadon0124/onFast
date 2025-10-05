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
<br><br>




    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0">كل الاوردرات</h4>

					</div>
    				</div>
				<div class="card-body">

				{{--  START GET FLASH MESSAGES   --}}
					<div id="message">
						@include('admin.alerts.success')
						@include('admin.alerts.errors')
					</div>

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
						@if ($orders && $orders->count() > 0)
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-5p border-bottom-0"> رقم الاوردر</th>
										<th class="wd-10p border-bottom-0">اسم المندوب</th>
										<th class="wd-10p border-bottom-0"> المدينة</th>
										<th class="wd-5p border-bottom-0"> اجمالي سعر الشحنات</th>
										<th class="wd-5p border-bottom-0"> اجمالي الشحن</th>
										<th class="wd-5p border-bottom-0"> الاجمالي </th>
										<th class="wd-5p border-bottom-0"> اجمالي ربح الشركة</th>
										<th class="wd-5p border-bottom-0"> عدد الشحنات</th>
										<th class="wd-10p border-bottom-0">تاريخ التسليم</th>
										<th class="wd-40p border-bottom-0"> الاجرائات</th>
									</tr>
								</thead>
								<tbody >
									@php
										$x = 1;
									@endphp


									@foreach ($orders as $order)
										<tr class="productRow">
											<td>{{ $x++}}</td>
											<td>
												<form action="{{ route('orders.changeServant',$order->id) }}" method="post">
													@csrf
													<select name="servant_id" class="form-control text-center">
														@foreach ($servants as $servant)
															<option value="{{ $servant->id }}" @if ($servant->id == $order->servant->id)
																selected
															@endif>
																{{ $servant->name }}
															</option>
														@endforeach
													</select>
													<input type="submit" class="btn btn-success form-control btn-sm" value="تعديل" style="background-color: #080; color:#fff">
												</form>
											</td>
											

											@if (isset($order->orders_detailes[0]->product->cities->name) && $order->orders_detailes->count() > 0)

												<td>{{ $order->orders_detailes[0]->product->cities->name }}</td>
												@else
												<td></td>
											@endif

											<td>
												{{ $order->total_prices - $order->total_shipping }}
											</td>
											<td>
												{{ $order->total_shipping }}
											</td>
											
											<td>{{ $order->total_prices}}</td>
											<td>{{ $order->total_profits}}</td>
											<td>{{ $order->orders_detailes->count()}}</td>
											<td>{{ $order->created_at}}</td>


											<td>
												<div class="btn-icon-list text-center">
													<a href="{{ route('orders.addProduct.get',$order->id) }}">
														<button class="btn btn-indigo ">
                                                           اضافة شحنات لخط السير
                                                        </button>&nbsp;
													</a>
													<a href="{{ route('orders.show',$order->id) }}">
														<button class="btn btn-primary">
                                                            تعديل بيانات خط السير
                                                        </button>
													</a>
													<a href="{{ route('orders.deleteOrder',$order->id) }}" style="margin-inline: 10px">
														<button class="btn btn-danger">
                                                            حزف
                                                        </button>
													</a>
												</div>
											</td>


										</tr>
									@endforeach


								</tbody>
							</table>
						
                        @else
							<h1 class="text-center">لا يوجد اوردرات</h1>
                        @endif
					</div>
				</div>
			</div>
		</div>
		<!--/div-->
	</div>
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

	<script>
		$("#successStatus").fadeOut(3000);
	</script>

@endsection
