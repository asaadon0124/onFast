@extends('admin.layouts.master')
@section('css')



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
										@if ($errors->any())
										<div class="row mr-2 ml-2" >
												<button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2">
													لم يتم تسجيل الشحنة
												</button>
										</div>
									@endif
									
									@include('admin.alerts.success')
									@include('admin.alerts.errors')

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

								<a href="{{ route('products.create') }}" class="btn btn-primary">اضافة شحنة جديدة للمخزن</a>

								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1" rowID="{{ $products->count()+1 }}">

										{{-- <div class="table-responsive"> --}}
										@if ($products && $products->count() > 0)
											{{-- <table class="table text-md-nowrap" id="example1" rowID="{{ $products->count()+1 }}"> --}}
											<thead>
												<tr>
													<th class="wd-15p border-bottom-0"> رقم</th>
													<th class="wd-15p border-bottom-0"> رقم الشحنة</th>
													<th class="wd-15p border-bottom-0">اسم المورد</th>
													<th class="wd-15p border-bottom-0">تليفون المورد</th>
													<th class="wd-15p border-bottom-0">اسم المستلم</th>
													<th class="wd-15p border-bottom-0">تليفون المستلم</th>
													<th class="wd-15p border-bottom-0">اسم المحافظة</th>
													<th class="wd-15p border-bottom-0">اسم المدينة التابعة لها</th>
													<th class="wd-15p border-bottom-0">عنوان المستلم</th>
													<th class="wd-15p border-bottom-0"> سعر الشحنة</th>
													<th class="wd-15p border-bottom-0"> مصاريف الشحن</th>
													<th class="wd-15p border-bottom-0">  الاجمالي</th>
													<th class="wd-15p border-bottom-0"> حالة الشحنة</th>
													<th class="wd-15p border-bottom-0">  الملاحظات</th>
													<th class="wd-15p border-bottom-0">  تاريخ التسليم</th>
													<th class="wd-15p border-bottom-0">  تاريخ التسجيل</th>
													<th class="wd-10p border-bottom-0">الاجرائات</th>
												</tr>
											</thead>
											<tbody>

												@php
													$x = 1;
												@endphp
												@foreach ($products as $product)
													<tr class="productRow{{ $product->id }}">
														<td>{{ $x++ }}</td>
														<td>{{ $product->package_number }}</td>
														<td>{{ $product->supplier->name }}</td>
														<td>{{ $product->supplier->phone }}</td>
														<td>{{ $product->resever_name }}</td>
														<td>{{ $product->resver_phone }}</td>
														<td>{{ $product->cities->governorate->name }}</td>
														<td>{{ $product->cities->name }}</td>
														<td>{{ $product->adress }}</td>
														<td>{{ $product->product_price }}</td>
														<td>{{ $product->shipping_price }}</td>
														<td>{{ $product->total_price }}</td>
														<td>{{ $product->status->name }}</td>
														<td>{{ $product->notes }}</td>
														<td>{{ $product->rescive_date }}</td>
														<td>{{ $product->created_at }}</td>

														<td>
															@if ($product->status_id == 1)
																<div class="btn-icon-list">
																	<a href="{{ route('products.edit',$product->id) }}">
																		<button class="btn btn-indigo btn-icon"><i class="fa fa-edit"></i></button>
																	</a>&nbsp;
																	<a href="" class="makeDeleteProduct" product_id="{{ $product->id }}">
																		<button class="btn btn-primary btn-icon"><i class="fa fa-trash"></i></button>
																	</a>
																</div>
															@endif
														</td>
													</tr>
												@endforeach

											</tbody>
										@else
											<h1 class="text-center">لا توجد شحنات</h1>
										@endif
									</table>
									
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
		
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



	

{{--  DELETE CITY   --}}
	<script>
		$(document).on('click','.makeDeleteProduct',function(e)
		{
			e.preventDefault();



			//Get Form Data
			var product_id = $(this).attr('product_id');

			$.ajax(
			{
				type: 'post',
				url: "{{route('products.destroy')}}",
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
							$('#successMsg').show().fadeOut(500);
							// alert(data.id);
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

{{--  GET CITIES  --}}
<script>
	$(document).ready(function()
	{
		$('#gov').on('change',function()
		{
			var gov = $(this).val();

			if(gov)
			{
				$.ajax(
					{
						url:"{{ url('/admin/products/cities/') }}/" + gov,
						type:"GET",
						dataType:"json",
						success:function(data)
						{
							$("#city").empty();
							$.each(data,function(key,value)
							{
								$("#city").append('<option value="'+value.id+'">'+value.name+'</option>')
							});
						}
					});
			}else
			{
				alert('Error');
			}
		});
	});
</script>

 {{-- GET PRODUCT PRICE --}}
 <script>

    $(document).ready(function()
    {
        $('#totalPrice').on('change',function()
        {
            var total_price = $('#totalPrice').val();
            var shipping_price = $("#shippingPrice").val();
            var product_price = $("#productPrice").val(total_price-shipping_price);
        });
        $('#shippingPrice').on('change',function()
        {
            var total_price = $('#totalPrice').val();
            var shipping_price = $("#shippingPrice").val();
            var product_price = $("#productPrice").val(total_price-shipping_price);
        });
    });
</script>

<script>
    $('#prodectes').on('click',function()
    {
       $('#modaldemo8').css('display','block');
       $('modaldemo8').addClass('show');
    });
</script>

{{-- Drob Down Search  --}}
<script type="text/javascript">

      $("#nameId").select2();

	</script>

	
@endsection
