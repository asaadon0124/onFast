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
                            <label for="">اجمالي سعر الشحنات </label>
                            <input type="text" id="total" class="text-center" disabled>
                        </div>
                        <h3 style="color: #a7a7a7">
                            عرض الشحنات خلال قترة معينة
                        </h3>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div><br>
                    <h3>
                        كل الشحنات التي تم خروجها خلال اليوم
                    </h3>
                </div>

				<div class="card-body">
					<div class="table-responsive">
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>

										<th class="wd-15p border-bottom-0"> رقم الاوردر</th>
										<th class="wd-15p border-bottom-0"> رقم الشحنة</th>
										<th class="wd-15p border-bottom-0"> اسم المستلم</th>
										<th class="wd-15p border-bottom-0"> سعر الشحن</th>
										<th class="wd-15p border-bottom-0">سعر الشحنة</th>
										<th class="wd-15p border-bottom-0"> اجمالي الشحن</th>

									 	<th class="wd-15p border-bottom-0"> حالة الشحنة</th>
										<th class="wd-15p border-bottom-0">تاريخ التسليم</th>
										<!-- <th class="wd-15p border-bottom-0"> الاجرائات</th> -->
									</tr>
								</thead>

                                {{-- GET ALL PRODUCTS FROM ORDER DETAILES TABLE  --}}
                                @if ($datas && $datas->count() > 0)
                                    <tbody id="productRow">

                                        @foreach ($datas as $item)
                                            <tr class="productRow">

                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->Product->package_number }}</td>
                                                <td>{{ $item->Product->resever_name }}</td>
                                                <td>{{ $item->shipping_price }}</td>
                                                <td>{{ $item->Product->product_price }}</td>
                                                <td class="total_price">{{ $item->total_price }}</td>

                                                <td>{{ $item->Product->Status->name }}</td>
                                                <td>{{ $item->created_at }}</td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                @endif

                                {{-- GET ALL PRODUCTS FROM RETURNS DETAILES TABLE  --}}
                                @if ($returns && $returns->count() > 0)
                                    <tbody id="productRow">

                                        @foreach ($returns as $item)
                                            <tr class="productRow">

                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->package_number }}</td>
                                                <td>{{ $item->resever_name }}</td>
                                                <td>{{ $item->orders->total_prices -  $item->product_price}}</td>
                                                <td>{{ $item->product_price }}</td>
                                                <td class="total_price">{{ $item->orders->total_prices }}</td>


                                                <td>{{ $item->Status->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                @endif

                                @if ($sum + $sum2 == 0)
                                    <h1 class="text-center" style="color: #f00">
                                        لا شحنات في هذه الفترة
                                    </h1>
                                @endif

							</table><br>
					</div>
				</div>
			</div>
		</div>

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
    $(document).ready(function()
    {
        // alert("hello");
        var sum = 0;
        $('.total_price').each(function ()
        {
            sum += Number($(this).html());
        });
        // alert(sum);

        $('#total').val(sum);
    });

</script>

@endsection
