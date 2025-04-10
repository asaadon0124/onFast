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

					<img src="{{ asset('assets/admin/images/Untitled-10 copy.jpg') }}" alt="" style="margin-bottom: 20px; display: none; width: 50%; margin-right: 27%" class="text-center" id="logo">


                    <div class="d-flex justify-content-between" style="margin-bottom: 0px">
                        <div class="form-group">
                            <label for="">الاجمالي</label>
                            <input type="text" id="total" status_id="{{ $status_id }}" disabled class="text-center">
                        </div><br>
                        <h3 style="color: #a7a7a7">
                            عرض الشحنات الخاصة  ب {{ $supplier[0]->name }}
                        </h3>

						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div>

                    <button  class="btn btn-info btn-lg noPrint" style=" margin-top:10px; margin-right:360px;hieght:20px;" id="print">
                        <span  class="fa fa-print noPrint"></span>
                    </button>

				<div class="card-body">
					<div class="table-responsive">

							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
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

									@if (isset($datas_Orders) && $datas_Orders->count() > 0)

										@foreach ($datas_Orders as $item1)
										<tr class="productRow">
											<td>
												{{ $item1->created_at }}
											</td>
											<td>
												{{ $item1->rescive_date }}
											</td>
											<td></td>
											<td>
												{{ $item1->supplier->name }}
											</td>
											<td>
												{{ $item1->resever_name }}
											</td>
											<td>
												{{ $item1->resver_phone }}
											</td>
											<td>
												{{ $item1->cities->governorate->name }}
											</td>
											<td>
												{{ $item1->cities->name }}
											</td>
											<td>
												{{ $item1->adress }}
											</td>
											<td>
												{{ $item1->product_price }}
											</td>
											<td>
												{{ $item1->shipping_price }}
											</td>
											<td class="total_price">
												{{ $item1->total_price}}
											</td>
											<td class="total_price">
												{{ $item1->notes}}
											</td>
											<td>
												{{ $item1->status->name }}
											</td>
										</tr>
										@endforeach
									@endif


                                    @if (isset($datas_Returns) && $datas_Returns->count() > 0)

										@foreach ($datas_Returns as $item1)
											@foreach ($item1->orders_detailes as $item)
												<tr class="productRow">
													<td>
														{{ $item->product->created_at }}
													</td>
													<td>
														{{ $item->product->rescive_date }}
													</td>
													<td>
														{{ $item->order->servant->name }}
													</td>
													<td>
														{{ $item->product->supplier->name }}
													</td>
													<td>
														{{ $item->product->resever_name }}
													</td>
													<td>
														{{ $item->product->resver_phone }}
													</td>
													<td>
														{{ $item->product->cities->name }}
													</td>
													<td>
														{{ $item->product->cities->governorate->name }}
													</td>
													<td>
														{{ $item->product->adress }}
													</td>
													<td>
														{{ $item1->product_price }}
													</td>
													<td>
														{{ $item1->shipping_price }}
													</td>
													<td class="total_price">
														{{ $item1->total_price }}
													</td>
													<td>
														{{ $item1->notes }}
													</td>
													<td class="statusA{{ $item->id }}">
														{{ $item1->status->name }}
													</td>
													<td class="noPrint">
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
																<p class="lastUpdate{{ $item->id }}">
																	{{ $item->updated_at->format('d/m/Y') }}
																</p>

															</td>

												</tr>
											@endforeach
										@endforeach
									@endif


                                    @if (isset($products) && $products->count() > 0)
										@foreach ($products as $item1)
											<tr class="productRow">
												<td>
													{{ $item1->created_at }}
												</td>
												<td>
													{{ $item1->rescive_date }}
												</td>
												<td></td>
												<td>
													{{ $item1->supplier->name }}
												</td>
												<td>
													{{ $item1->resever_name }}
												</td>
												<td>
													{{ $item1->resver_phone }}
												</td>
												<td>
													{{ $item1->cities->governorate->name }}
												</td>
												<td>
													{{ $item1->cities->name }}
												</td>
												<td>
													{{ $item1->adress }}
												</td>
												<td>
													{{ $item1->product_price }}
												</td>
												<td>
													{{ $item1->shipping_price }}
												</td>
												<td class="total_price">
													{{ $item1->total_price}}
												</td>
												<td class="total_price">
													{{ $item1->notes}}
												</td>
												<td>
													{{ $item1->status->name }}
												</td>

											</tr>
										@endforeach

									@endif


                                    @if (isset($returns) && $returns->count() > 0)

										@foreach ($returns as $item1)
											@foreach ($item1->orders_detailes as $item)
												<tr class="productRow">
													<td>
														{{ $item->product->created_at }}
													</td>
													<td>
														{{ $item->product->rescive_date }}
													</td>
													<td>
														{{ $item->order->servant->name }}
													</td>
													<td>
														{{ $item->product->supplier->name }}
													</td>
													<td>
														{{ $item->product->resever_name }}
													</td>
													<td>
														{{ $item->product->resver_phone }}
													</td>
													<td>
														{{ $item->product->cities->name }}
													</td>
													<td>
														{{ $item->product->cities->governorate->name }}
													</td>
													<td>
														{{ $item->product->adress }}
													</td>
													<td>
														{{ $item1->product_price }}
													</td>
													<td>
														{{ $item1->shipping_price }}
													</td>
													<td class="total_price">
														{{ $item1->total_price }}
													</td>
													<td>
														{{ $item1->notes }}
													</td>
													<td class="statusA{{ $item->id }}">
														{{ $item1->status->name }}
													</td>
													<td class="noPrint">
																<form action="" class="status">
																	<select name="status_id{{ $item->id }}" id="package_status{{ $item->id }}" class="st_id{{ $item->id }} form-control" item_id="{{ $item->id }}">
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
																<p class="lastUpdate{{ $item->id }}">
																	{{ $item->updated_at->format('d/m/Y') }}
																</p>

															</td>

												</tr>
											@endforeach
										@endforeach




									@endif

								</tbody>
							</table>
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

{{-- GET TOTAL RECORDES --}}
    <script>
        $(document).ready(function()
        {
            // alert("hello");
            var sum = 0;
            var status_id = $('#total').attr('status_id');
            if (status_id == 1 || status_id == 3 || status_id == 4 || status_id == 7)
            {
                $('.total_price').each(function ()
                {
                    sum =+ 0;
                });
            } else
            {
               $('.total_price').each(function ()
                {
                	sum += Number($(this).html());
                });
            }

            // alert(sum);

            $('#total').val(sum);
        });

    </script>

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
						$('#succes_msg').html(data.msg);
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

<script>
	$('#print').on('click', function()
	{
		$("#logo").show();
		$("#example1_filter").hide();
		$("#example1_length").hide();
		window.print();
	});

</script>
@endsection
