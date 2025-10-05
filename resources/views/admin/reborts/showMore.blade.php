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
                        <div class="form-group">
                            <label for="">الاجمالي</label>
                            <input type="text" id="total" disabled class="text-center" value="{{ $products->total_prices }}">
                        </div>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div>

                    <button href="#" onclick="window.print();"  class="btn btn-info btn-lg " style=" margin-top:-90px; margin-right:360px;hieght:20px;">
                        <span  class="fa fa-print noPrint	" ></span>
                    </button>



				<div class="card-body">
                    <h3 style="color: #a7a7a7">
                        عرض الشحنات الخاصة  ب {{ $products->servant->name }}
                    </h3>
					<div class="table-responsive">
						<table class="table text-md-nowrap" id="example1">
							<thead>
							<tr>
								<th class="wd-15p border-bottom-0"> رقم الشحنة</th>
								<th class="wd-15p border-bottom-0"> اسم المستلم</th>
								<th class="wd-15p border-bottom-0"> تليفون المستلم</th>
								<th class="wd-15p border-bottom-0"> اسم المورد</th>
								<th class="wd-15p border-bottom-0"> تليفون المورد</th>
								<th class="wd-15p border-bottom-0"> سعر الشحنة</th>
								<th class="wd-15p border-bottom-0">سعر الشحن</th>
								<th class="wd-15p border-bottom-0"> اجمالي الشحن</th>
								<th class="wd-15p border-bottom-0"> حالة الشحنة</th>
								<th class="wd-15p border-bottom-0">  ملاحظات</th>
								<th class="wd-15p border-bottom-0">تاريخ التسليم</th>
							</tr>
							</thead>
				
								@foreach ($products->orders_detailes as $item)
								   <tr>
										<td> {{ $item->product->package_number }}</td>
										<td> {{ $item->product->resever_name }}</td>
										<td> {{ $item->product->resver_phone }}</td>
										<td> {{ $item->product->supplier->name }}</td>
										<td> {{ $item->product->supplier->phone }}</td>
										<td> {{ $item->product->product_price }}</td>
										<td> {{ $item->shipping_price }}</td>
										<td> {{ $item->total_price }}</td>
										<td> {{ $item->status->name }}</td>
										<td> {{ $item->notes }}</td>
										<td> {{ $item->product->rescive_date }}</td>
				
								   </tr>
								@endforeach
						</table><br>
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

   

@endsection
