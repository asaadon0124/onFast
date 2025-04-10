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
				<!-- <div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0"> تفاصيل الملف رقم {{ $proDetailes->id }}</h4>
                        <a href="{{ route('reserves.edit',$proDetailes->id) }}" class="btn btn-primary">اضافة شحنة</a>
					</div>
				</div> -->
				<div class="card-body">

					{{--  START GET FLASH MESSAGES   --}}
						<div id="message">
							@include('admin.alerts.success')
							@include('admin.alerts.errors')
						</div>
						<div class="row mr-2 ml-2" id="successMsg" style="display: none">
							<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
								تم حزف الشحنة من التحصيلات بنجاح
							</button>
						</div>
						
						<div class="row mr-2 ml-2" id="errorStatus" style="display: none">
							<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
								تم تعديل حالة الشحنة بنجاح
							</button>
						</div>

					{{--  END GET FLASH MESSAGES   --}}



                    <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                               <label for="">رقم الملف</label>
                            <input type="text" name="" class="form-control text-center" value="{{ $proDetailes->id }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">الاجمالي</label>
                             <input type="text" id="total" class="form-control text-center" value="{{ $data }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            @if ($proDetailes->reservesDetailes && $proDetailes->reservesDetailes->count() > 0)
								<div class="form-group">
									<label for="">المحافظة</label>
								<input type="text" value="{{ $proDetailes->reservesDetailes->pluck('product')->pluck('cities')->pluck('governorate')->pluck('name')->first() }}" name="" class="form-control text-center" disabled>
								</div>
							@else
								<div class="form-group">
									<label for="">المحافظة</label>
									<input type="text" value="{{ $proDetailes->reservesDetailes->pluck('product')->pluck('cities')->pluck('governorate')->pluck('name')->first() }}" name="" class="form-control text-center" disabled>
								</div>
							@endif
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">اسم المورد</label>
                             <input type="text" name="" value="{{ $proDetailes->supplier->name }}" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""> تاريخ التسليم</label>
                             <input type="text" name="" value="{{ $proDetailes->created_at }}" class="form-control text-center" disabled>
                            </div>
                        </div>

                       
                        <div class="btn-icon-list col-md-2">
							<button class="btn btn-info btn-lg " style=" margin-top:-90px; margin-right:360px;hieght:20px;" id="print">
								<span  class="fa fa-print noPrint" ></span>
							</button>
                        </div>
                    </div>
				</div>




					<div class="table-responsive">
						@if ($proDetailes->reservesDetailes && $proDetailes->reservesDetailes->count() > 0)
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-3p border-bottom-0"> رقم </th>
										<th class="wd-10p border-bottom-0">  الراسل</th>
										<th class="wd-10p border-bottom-0">المستلم</th>
										<th class="wd-5p border-bottom-0"> سعر الشحن</th>
										<th class="wd-5p border-bottom-0">سعر الشحنة</th>
										<th class="wd-5p border-bottom-0"> اجمالي الشحن</th>
										<th class="wd-5p border-bottom-0">  المدينة</th>
										<th class="wd-5p border-bottom-0 noPrint"> حالة الشحنة</th>
										<th class="wd-7p border-bottom-0 noPrint">تاريخ التسليم</th>
										<th class="wd-35p border-bottom-0 noPrint"> الاجرائات</th>
									</tr>
								</thead>
								<tbody >
									@php
										$x = 1;
									@endphp

									@foreach ($proDetailes->reservesDetailes as $item)
										<tr class="productRow">
											<td>{{ $x++ }}</td>
											<td>{{ $item->product->supplier->name }} <br> {{ $item->product->supplier->phone }}</td>
											<td>{{ $item->product->resever_name }} <br> {{ $item->product->resver_phone }} <br> {{ $item->product->adress }}</td>
											<td>{{ $item->product->shipping_price}}</td>
                                            
											<td>{{ $item->product->product_price}}</td>
											<td>{{  $item->product->shipping_price + $item->product->product_price}}</td>
											<td>{{ $item->product->cities->name }}</td>

											<td>
												تم تسليم التحصيل للعميل
											</td>

											

											<td class="text-center noPrint">{{ $item->product->rescive_date}}</td>

                                           

											<td class="control{{ $item->id }} noPrint">
                                                <form action="{{ route('reserves.destroy',$item->id) }}" method="post">
                                                    @csrf
                                                    <input type="submit" value="حزف" class="btn btn-danger btn-sm" style="width: 40%">
                                                </form>
												<!-- <a href="{{ route('reserves.destroy',$item->id) }}">
													<button class="btn btn-danger btn-sm" style="width: 40%">حزف</button>
												</a> -->
												
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
		$('#print').on('click', function()
		{
			$("#logo").show();
			window.print();
			return false; // why false?
		});

	</script>
@endsection

