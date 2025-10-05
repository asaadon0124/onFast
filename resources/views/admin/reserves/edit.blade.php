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

{{-- START FORM TO SEARCH FOR PRODUCTS AND SELECT SERVANT TO CREATE ORDER   --}}
	<div class="row">

		<div class="col-sm-9">
			<form id="createٍOrder" >
				@csrf

				<div class="row">
					{{--  SUPPLIER_ID   --}}
					<div class="col-md-2">
						<div class="form-group">
							<label for="">اسم المورد</label>
							<input type="text" class="form-control text-center" value="{{ $reserve->supplier->name }}" disabled>
						</div>
					</div>


					

					
				</div>
			</form>
		</div>

		<div class="col-sm-2 mr-5">
			<form action="">
				<input type="text" class="form-control" placeholder="بحث" class="text-center" id="data">
			</form>
		</div>

	</div>

{{-- END FORM TO SEARCH FOR PRODUCTS AND SELECT SERVANT TO CREATE ORDER   --}}


    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0">الشحنات المتاحة بخط السير</h4>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div>

				</div>
				<div class="card-body">

					{{--  START GET FLASH MESSAGES   --}}
						@include('admin.alerts.success')
						@include('admin.alerts.errors')

						<div class="row mr-2 ml-2" id="successMsg" style="display: none">
							<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
								تم تحصيل الشحنة بنجاح
							</button>
						</div>
					{{--  END GET FLASH MESSAGES   --}}



					<div class="table-responsive">
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-15p border-bottom-0"> رقم</th>
										<th class="wd-15p border-bottom-0">اسم المستلم</th>
										<th class="wd-15p border-bottom-0">تليفون المستلم</th>
										<th class="wd-15p border-bottom-0">اسم المدينة التابعة لها</th>
										<th class="wd-15p border-bottom-0">عنوان المستلم</th>
										<th class="wd-15p border-bottom-0"> سعر الشحنة</th>
										<th class="wd-15p border-bottom-0"> سعر الشحن</th>
										<th class="wd-15p border-bottom-0"> حالة الشحنة</th>
										<th class="wd-10p border-bottom-0">الاجرائات</th>
									</tr>
								</thead>
								<tbody id="productRow">
                                    @php
                                        $x = 1 
                                    @endphp
									@if(isset($products) && $products->count() > 0))
                                        @foreach($products as $pro)
                                            <tr class="productRow">
                                                <td>{{ $x++ }}</td>
                                                <td>{{ $pro->resever_name }}</td>
                                                <td>{{ $pro->resver_phone }}</td>
                                                <td>{{ $pro->cities->name }}</td>
                                                <td>{{ $pro->adress }}</td>
                                                <td>{{ $pro->product_price }}</td>
                                                <td>{{ $pro->shipping_price }}</td>
                                                <td>{{ $pro->status->name }}</td>
                                                <td>
                                                    <button class='btn btn-success createProductToOrder' id='add' product_id="{{ $pro->id }}" reseved_id="{{ $reserve->id }}">
                                                        تحصيل   
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
								</tbody>

								<!-- <tbody id="productRow2" class="text-center" style="display: none">

								</tbody> -->
							</table><br>
                            
                            <br><br>

                            <a href="{{ route('reserves.show',$reserve->id) }}" class="form-control text-centerpoducts_detailes_export" style="background-color: #0ff ;">
                                رجوع
                            </a>
                            
						

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



	

<!-- ***************************************************************************** -->

	{{--  CREATE PRODUCT TO ORDER   --}}
	<script>
		$(document).on('click','.createProductToOrder',function(e)
		{
			e.preventDefault();

			//Get Form Data
			$(this).hide();
           var product_id = $(this).attr('product_id');
           var reseved_id = $(this).attr('reseved_id');
			$.ajax(
			{
				url: "{{route('reserves.update')}}",
				type: 'post',
				cache: false,
				setTimeout :250000,
				data:
				{
					'_token' : "{{ csrf_token() }}",
             		'id'     : product_id,
                    'reserve': reseved_id
				},

				success: function(data)
				{
					if(data.status == true)
					{

						if(data.status == true)
						{
							$('#successMsg').show();
                        }

                        // DELETE ROW FROM TABLE
                        $('.productRow'+data.id).remove();
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

<!-- ****************************************** -->


	{{--  DELETE PRODUCT FROM LIST--}}
	<script>
		$(document).on('click','.deleteProductToOrder',function(e)
		{
			e.preventDefault();

			//Get Form Data
			$(this).hide();
           var product_id = $(this).attr('product_id');
			$.ajax(
			{
				url: "{{route('orderDetailes.deleteProduct')}}",
				type: 'post',
				cache: false,
				setTimeout :250000,
				data:
				{
					'_token' : "{{ csrf_token() }}",
             		'id'     : product_id
				},

				success: function(data)
				{
					if(data.status == true)
					{

						if(data.status == true)
						{
							$('#successMsg').show();
                        }

                        // DELETE ROW FROM TABLE
                        $('.productRow'+data.id).remove();
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

   
<!-- ************************************************* -->

	{{-- FILTER DATA  --}}
	<script>
		$(document).ready(function()
		{
			$(document).on('keyup', '#data', function()
			{

				var query = $(this).val();
				// alert(query);

				$.ajax(
				{
					type: 'get',
					url	: "{{route('orderDetailes.filter')}}",
					data:
					{
						'_token' 			: "{{ csrf_token() }}",
						'results' 			: query,
					},
					dataType:'json',

					success: function(data)
					{
						if (query != '')
							{
								// alert('yes');
								$("#productRow").hide();
								// alert(data.ahmed);
								$('#productRow2').show().html(data.ahmed);
							}else
							{
								$("#productRow").show();
								$("#productRow2").hide();
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
		});
	</script>

@endsection
