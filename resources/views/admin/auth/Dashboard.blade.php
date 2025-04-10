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
<style>
	@media print 
	{
	  .noPrint
	  {
		display:none;
	  }
	}
	</style>

@endsection

@section('content')
<br><br>




    <style>
/*body {
    font-family: "Lato", sans-serif;
}*/




.main {

    font-size: 18px;

}


hr{
margin-top: 10px;
	/*    margin-bottom: 10px;
*/}

td{
text-align:center;
}
.glyphicon-tag{
font-size:50px;
}
</style>

    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm noPrint">

		<div class="col-xl-12">

			<div class="card">

				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">



						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div>

<div class="main">
  <h2><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;الصفــحة الرئيسيــــة</h2>
   <ul class="breadcrumb">
    <li><a href="">الصفحـة الرئيسيـة</a> /</li>
  </ul>
    <p>أهــــلا بــك : {{ auth()->user()->name }}</p>





	



	
  <hr />
    {{-- <table class="table table-bordered ">
    <tbody>
      <tr>
        <td><i class="fa fa-address-book" style="font-size:48px;color:#03a5fc"></i><br /><br />المديرين : {{$countadmin}}</td>
               <td><i class="fa fa-car" style="font-size:48px;color:#03a5fc"></i><br /><br />المناديب : {{$countservant}}</td>

               <td><i class="fa fa-indent	" style="font-size:48px;color:#03a5fc"></i><br /><br />الأوردرات المكتملة : {{$countorder}}</td>
      </tr>
	  <tr>
               <td><i class="fa fa-tags		" style="font-size:48px;color:#03a5fc"></i><br /><br />الشحنات : {{$countproduct}}</td>
               <td><i class="fa fa-thumbs-down		" style="font-size:48px;color:#03a5fc"></i><br /><br />العملاء : {{App\Models\User::select('id')->count()}}</td>
               <td><i class="fa fa-users			" style="font-size:48px;color:#03a5fc"></i><br /><br />الموردين : {{$countsupplier}}</td>

<!--         <td><span class="glyphicon glyphicon-tag"></span><br /><br />الموردين Orders: 50</td>
 -->      </tr>
    </tbody>
  </table> --}}
  <br><br><br>
  </div>
<!-- 					<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
 -->				</div>

			</div>
		</div>
		<!--/div-->
	</div>




    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header pb-0">
					
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0">الشحنات المتاحة بخط السير</h4>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
						<button href="#" onclick="window.print();"  class="btn btn-info btn-lg " style=" margin-top:-1%; margin-right:-81%;">
							<span  class="fa fa-print noPrint	" ></span>
						</button>
						<a href="{{ route('Dashboard') }}" class="btn btn-info">
							الصفحة الرئسية الجديدة
						</a>
					</div>

				</div>
				<div class="card-body">
					
				{{--  START GET FLASH MESSAGES   --}}
					@include('admin.alerts.success')
					@include('admin.alerts.errors')

					<div class="row mr-2 ml-2" id="successMsg" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							تم حزف الشحنة من المخزن بنجاح
						</button>
					</div>
				{{--  END GET FLASH MESSAGES   --}}
				


			{{-- START SEARCH  --}}
					<div class="table-responsive">
						
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										
										<th class="wd-10p border-bottom-0"> رقم</th>
										<th class="wd-10p border-bottom-0">تاريخ الدخول</th>
										<th class="wd-10p border-bottom-0">تاريخ التسليم</th>
										<th class="wd-10p border-bottom-0">اسم المندوب</th>
										<th class="wd-10p border-bottom-0">اسم المورد</th>
										<th class="wd-10p border-bottom-0">اسم المستلم</th>
										<th class="wd-5p border-bottom-0">تليفون المستلم</th>
										<th class="wd-5p border-bottom-0"> اسم المحافظة</th>
										<th class="wd-5p border-bottom-0">اسم المدينة التابعة لها</th>
										<th class="wd-30p border-bottom-0">عنوان المستلم</th>
										<th class="wd-5p border-bottom-0"> سعر الشحنة</th>
										<th class="wd-5p border-bottom-0"> سعر الشحن</th>
										<th class="wd-5p border-bottom-0">  الاجمالي</th>
										<th class="wd-5p border-bottom-0">  الملاحظات</th>
										<th class="wd-5p border-bottom-0"> حالة الشحنة</th>
										<th class="wd-20p border-bottom-0"> الاجرائات</th>
										
									</tr>
								</thead>
								<tbody id="productRow">
									@if ($allOrders && $allOrders->count() > 0)
										@foreach ($allOrders as $product)
										@php
													$x = 1;
												@endphp
											<tr class="adminRow{{ $product->id }}">
												
												<td>{{$x++ }}</td>
												<td>{{ $product->created_at }}</td>
												<td>{{ $product->rescive_date }}</td>
												<td>{{ $product->orders_detailes->pluck('order')->pluck('servant')->pluck('name')->implode('') }}</td>
												<td>{{ $product->supplier->name }}</td>
												<td>{{ $product->resever_name }}</td>
												<td>{{ $product->resver_phone }}</td>
												<td>{{ $product->cities->governorate->name }}</td>
												<td>{{ $product->cities->name }}</td>
												<td>{{ $product->adress }}</td>
												<td>{{ $product->product_price }}</td>
												<td>{{ $product->shipping_price }}</td>
												<td>{{ $product->total_price }}</td>
												<td>{{ $product->notes }}</td>
												<td>{{ $product->status->name }}</td>
												<td></td>
												
											</tr>
										@endforeach	
									@endif

									@if ($allOrders2 && $allOrders2->count() > 0)
										@php
											$x = 1;
										@endphp
										@foreach ($allOrders2 as $item)
											<tr class="adminRow{{ $item->id }}">
											
											<td>{{$x++ }}</td>
												<td>{{ $item->created_at }}</td>
												<td>{{ $item->product->rescive_date }}</td>
												<td>
													@if (isset($item->order->servant->name))
														{{ $item->order->servant->name }}
													@endif
												</td>
												
												<td>{{ $item->product->supplier->name }}</td>
												 <td>{{ $item->product->resever_name }}</td>
												<td>{{ $item->product->resver_phone }}</td>
												<td>{{ $item->product->cities->governorate->name }}</td>
												<td>{{ $item->product->cities->name }}</td>
												<td>{{ $item->product->adress }}</td>
												<td>{{ $item->product->product_price }}</td> 
												<td>{{ $item->shipping_price }}</td>
												<td>{{ $item->total_price }}</td>
												<td>
													<form action="">
														<input type="text" name="notes" class="form-control" id="notes{{ $item->id }}" value="{{ $item->notes }}">
														<button class="notes btn btn-success" id="{{ $item->id }}">تعديل</button>
													</form>
												</td>
												
												<td class="statusA{{ $item->id }}">{{ $item->status->name }}</td>
												<td>
													@if ($item->product_status != 3 && $item->product_status != 2)
														<form action="" class="status" id="form{{ $item->id }}">
															<select name="status_id{{ $item->id }}" id="package_status{{ $item->id }}" class="st_id{{ $item->id }} form-control ">
																<option value="">اختار الحالة</option>
																@foreach ($allStatus as $status)
																	<option value="{{ $status->id }}"@if ($status->id == $item->product_status)
																		selected
																	@endif>
																		{{ $status->name }}
																	</option>
																@endforeach
															</select>

															<div class="noPrint">	<button class="btn btn-primary makeStatus" id="{{ $item->id }}" >تعديل</button> </div>
														</form>	
													@elseif ($item->product_status == 3)
														<form action="" class="status">
															<select name="status_id{{ $item->id }}" id="package_status{{ $item->id }}" class="st_id{{ $item->id }} form-control ">
																<option value="">اختار الحالة</option>
																@foreach ($allStatus as $status)
																	<option value="{{ $status->id }}"@if ($status->id == $item->product_status)
																		selected
																	@endif>
																		{{ $status->name }}
																	</option>
																@endforeach
															</select>

															<div class="noPrint">	<button class="btn btn-primary makeStatus" id="{{ $item->id }}" >تعديل</button> </div>
														</form>	<br>

														<a href="{{ route('Dashboard.endStatus',$item->id) }}" class="btn btn-warning" id="last_status{{ $item->id }}">تم تسليم المرتجع للعميل</a>
														
													
													@elseif($item->product_status == 7)
														<a href="{{ route('Dashboard.restore2',$item->id) }}" id="status4{{ $item->id }}" class="btn btn-danger status4"> تم رفضه</a>
													
													@endif
													
												</td>
												
											</tr>
										@endforeach	
									@endif
									
									
								</tbody>
							</table><br>
						

					</div>
				</div>
			</div>
		</div>
		<!--/div-->
	</div>

	
	{{-- END SEARCH  --}}
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



	


{{--  CHANGE STATUS  --}}
<script>
	$(document).on('click','.makeStatus',function(e)
	{
		e.preventDefault();

		//Get Form Data
		var itemId = $(this).attr('id');
		var sel_val = document.getElementById("package_status"+itemId).value;

		$.ajax(
		{
			type: 'post',
			url: "{{route('orders.restoreReturns')}}",
			data:
			{
				'_token' 			: "{{ csrf_token() }}",
				'product_status' 	: sel_val,
				'id'     			: itemId,
			},

			success: function(data)
			{
				if(data.status == true)
				{

					if(data.status == true)
					{
						$('#Smessage').html(data.msg);
						$('.statusA'+itemId).html(data.status_name);
						$('#successStatus').show().fadeOut(500);
						if (data.status_name == 'تم رفضه') 
						{
							$('#last_status'+itemId).show().fadIn(500);
						}else
						{
							$('#last_status'+itemId).hide();
						}
					}
				}
			},
			error: function(reject)
			{
				var response = $.parseJSON(reject.responseText);
				$.each(response.errors,function(key,val)
				{
				$("#" + key + "_error").text(val[0]);
				});
			}

		});
	});
</script>

	  
{{--  CHANGE NOTES  --}}
<script>
	$(document).on('click','.notes',function(e)
	{
		e.preventDefault();

		//Get Form Data
		var itemId = $(this).attr('id');
		
		var sel_val = document.getElementById("notes"+itemId).value;
		// alert(sel_val);

		$.ajax(
		{
			type: 'get',
			url	: "{{route('Dashboard.notes')}}",
			data:
			{
				'_token' 			: "{{ csrf_token() }}",
				'notes' 			: sel_val,
				'id'     			: itemId,
			},

			success: function(data)
			{
				if(data.status == true)
				{

					$('#successS').html(data.msg);
					$('#successS').show().fadeOut(500);
				}
			},
			error: function(reject)
			{
				var response = $.parseJSON(reject.responseText);
				$.each(response.errors,function(key,val)
				{
				$("#" + key + "_error").text(val[0]);
				});
			}

		});
	});
</script>



@endsection
