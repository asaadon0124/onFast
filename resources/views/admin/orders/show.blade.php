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

<img src="{{ asset('assets/admin/images/Untitled-10 copy.jpg') }}" alt="" style="margin-bottom: 20px; display: none; width: 50%; margin-right: 27%" class="text-center" id="logo">


    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0"> تفاصيل الاوردر رقم {{ $order->id }}</h4>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
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
							<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2" >
								تم تعديل حالة الشحنة بنجاح
							</button>
						</div>
						<div class="row mr-2 ml-2" id="errorStatus" style="display: none">
							<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
								تم تعديل حالة الشحنة بنجاح
							</button>
						</div>

						<div class="row mr-2 ml-2" id="successMsg" style="display: none">
							<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
								تم تعديل ربح الشركة بنجاح
							</button>
						</div>


					{{--  END GET FLASH MESSAGES   --}}
					
						

                    <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                               <label for="">رقم الاوردر</label>
                            <input type="text" name="" class="form-control text-center" value="{{ $order->id }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">الاجمالي</label>
                             <input type="text" id="total" class="form-control text-center" value="{{ $order->total_prices }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            @if ($order->orders_detailes && $order->orders_detailes->count() > 0)
								<div class="form-group">
									<label for="">المحافظة</label>
								<input type="text" value="{{ $order->orders_detailes->pluck('product')->pluck('cities')->pluck('governorate')->pluck('name')->first() }}" name="" class="form-control text-center" disabled>
								</div>
							@else
								<div class="form-group">
									<label for="">المحافظة</label>
									<input type="text" value="{{ $order->orders_detailes->pluck('product')->pluck('cities')->pluck('governorate')->pluck('name')->first() }}" name="" class="form-control text-center" disabled>
								</div>
							@endif
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">اسم المندوب</label>
                             <input type="text" name="" value="{{ $order->servant->name }}" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""> تاريخ التسليم</label>
                             <input type="text" name="" value="{{ $order->created_at }}" class="form-control text-center" disabled>
                            </div>
                        </div>

                        <div class="btn-icon-list col-md-2 noPrint">
                            <a href="{{ route('orders.edit',$order->id) }}">
                                <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
                            </a>
                        </div>
                        <div class="btn-icon-list col-md-2">
							<button class="btn btn-info btn-lg " style=" margin-top:-90px; margin-right:360px;hieght:20px;" id="print">
								<span  class="fa fa-print noPrint" ></span>
							</button>
                        </div>
                    </div>
				</div>

				


					<div class="table-responsive">
						@if ($order->orders_detailes && $order->orders_detailes->count() > 0)
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-3p border-bottom-0"> رقم </th>
										<th class="wd-10p border-bottom-0"> اسم الراسل</th>
										<th class="wd-10p border-bottom-0"> تليفون الراسل</th>
										<th class="wd-10p border-bottom-0"> اسم المستلم</th>
										<th class="wd-10p border-bottom-0"> تليفون المستلم</th>
										<th class="wd-10p border-bottom-0"> عنوان المستلم</th>
										<th class="wd-5p border-bottom-0"> سعر الشحن</th>
										<th class="wd-1p border-bottom-0">سعر الشحنة</th>
										<th class="wd-1p border-bottom-0"> اجمالي الشحن</th>
										<th class="wd-3p border-bottom-0">  المدينة</th>
										<th class="wd-5p border-bottom-0 noPrint"> حالة الشحنة</th>
										<th class="wd-5p border-bottom-0 noPrint"> الربح</th>
										<th class="wd-7p border-bottom-0 noPrint">تاريخ التسليم</th>
										<th class="wd-5p border-bottom-0 noPrint"> الملاحظات</th>
										<th class="wd-35p border-bottom-0 noPrint"> الاجرائات</th>
									</tr>
								</thead>
								<tbody >
									@php
										$x = 1;
									@endphp

									@foreach ($order->orders_detailes as $item)
										<tr class="productRow">
											<td>{{ $x++ }}</td>
									
										
											<td>
											    	@if(isset(  $item->product->supplier->name ))
											    	 {{ $item->product->supplier->name }}
											    	@endif
											   </td>
											<td>@if(isset($item->product->supplier->phone))
											{{ $item->product->supplier->phone }}
											@endif</td>
											<td>@if(isset( $item->product->resever_name ))
											{{ $item->product->resever_name}}
											@endif
											</td>
											<td>@if(isset( $item->product->resver_phone))
											    {{ $item->product->resver_phone }}@endif</td>
											<td>@if(isset( $item->product->adress))
											    {{ $item->product->adress }}
											    @endif
											    </td>
											<td>
											    {{ $item->shipping_price}}
											    </td>
											<td id="check{{$item->id}}">
											    @if(isset($item->product->product_price))
											      {{ $item->product->product_price}}
											    @endif
											  </td>
											<td id="check2{{$item->id}}">
											    @if(isset( $item->product->product_price))
											    {{  $item->shipping_price + $item->product->product_price}}
											    @endif
											    </td>
											<td>@if(isset($item->product->cities->name))
											    {{ $item->product->cities->name }}
											    @endif</td>

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
			
													<div class="noPrint">
														<button class="btn btn-primary makeStatus" id="{{ $item->id }}" >تعديل</button> 
													</div>
												</form>	<br>
												<p class="lastUpdate{{ $item->id }}">
													{{ $item->updated_at->format('d/m/Y') }}
												</p>
			
											</td>

											<td class="noPrint">						{{-- COMPANY PROFIT --}}
												<form class="shipping_price">
													<input type="number" class="price{{ $item->id }} text-center" name="price{{ $item->id }}" style="width: 100%" id="price{{ $item->id }}" value="{{ $item->profit }}">
												<div class="noPrint">	<button row_id="{{ $item->id }}" class="change_price btn btn-success" style="background-color:#0162e8">تعديل</button> </div>
												</form>
											</td>

											<td class="text-center noPrint">
											    @if(isset($item->product->rescive_date))
											    {{ $item->product->rescive_date}}
											    @endif</td>

                                            <td class="noPrint">
                                                <form action="{{ route('orders.productNote',$item->id) }}" method="post">
                                                    @csrf

                                                    <input type="text" name="notes" class="form-control" value="{{ $item->notes }}">
                                                    <input type="submit" class="btn btn-success btn-sm" value="حفظ" style="width: 100%">
                                                </form>

                                            </td >
											
											<td class="control{{ $item->id }} noPrint">
												<a href="{{ route('orders.forceDeleteItem',$item->id) }}">
													<button class="btn btn-danger btn-sm" style="width: 40%">حزف</button>
												</a>
												<a href="{{ route('orders.editOrderItem',$item->id) }}">
													<button class="btn btn-info btn-sm" style="width: 40%">تعديل</button>
												</a>
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


      {{-- CHANGE STATUS  1 --}}
    <script>
        $(document).on('click', '.makeStatus', function(e) {
            e.preventDefault();

            //Get Form Data
            var itemId = $(this).attr('id');
            // var sel_val = document.getElementById("package_status"+itemId).value;
            var sel_val = $(".st_id" + itemId).val();
            // alert(sel_val);

            $.ajax({
                type: 'post',
                url: "{{ route('orders.restoreReturns') }}",
                data: 
                {
                    '_token': "{{ csrf_token() }}",
                    'product_status': sel_val,
                    'id': itemId,
                },

                success: function(data) {
                    if (data.status == true) {

                        if (data.status == true) {
                            $('#succes_msg').html(data.msg);
                            // alert(itemId);
                            $('.statusA' + itemId).html(data.status_name);
                            $('#successStatus').show().fadeOut(500);
                            if (data.status_name == 'تم رفضه') {
                                $('#last_status' + itemId).show().fadIn(500);
                            } else {
                                $('#last_status' + itemId).hide();
                            }
                        }
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }

            });
        });
    </script>


    {{-- CHANGE STATUS  2 --}}
    <script>
        $(document).on('click', '.makeStatus', function(e) {
            e.preventDefault();

            //Get Form Data
            var itemId = $(this).attr('id');
            // var sel_val = document.getElementById("package_status"+itemId).value;
            // var sel_val = $(".st_id"+itemId).val();
            var sel_val = $("#select" + itemId).val();
            // alert(sel_val);

            $.ajax({
                type: 'post',
                url: "{{ route('orders.restoreReturns') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'product_status': sel_val,
                    'id': itemId,
                },

                success: function(data) {
                    if (data.status == true) {

                        if (data.status == true) {
                            $('#succes_msg').html(data.msg);
                            // alert(itemId);
                            $('.statusA' + itemId).html(data.status_name);
                            $('#successStatus').show().fadeOut(500);
                            if (data.status_name == 'تم رفضه') {
                                $('#last_status' + itemId).show().fadIn(500);
                            } else {
                                $('#last_status' + itemId).hide();
                            }
                        }
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }

            });
        });
    </script>


      {{--  CHANGE PROFIT PRICE  --}}
	 <script>
		$(document).on('click','.change_price',function(e)
		{
			e.preventDefault();

			//Get Form Data
			var itemId = $(this).attr('row_id');

			var sel_val = document.getElementById("price"+itemId).value;
			
			$.ajax(
			{
				url: "{{route('orders.profit')}}",
				type: 'post',
				cache: false,
				setTimeout :250000,
				data:
				{
					'_token' : "{{ csrf_token() }}",
					'price' : sel_val,
					'id'     : itemId,
				},

				success: function(data)
				{
					if(data.status == true)
					{
						if(data.status == true)
						{
							$('#successMsg').show().fadeOut(500);
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
			window.print();  
			return false; // why false?
		});

	</script>
@endsection

