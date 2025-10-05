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
					<form action="{{ route('servant') }}" method="post">
                        @csrf

                       <div class="row">
                            <div class="form-group col-md-3">
                                <label for="" value="" disabled>اختار مندوب</label>
                                <select class="form-control"  name="date">
                                    <option>اختيار مندوب</option>
                                    @foreach($servants as $item )
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error("date")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label>من :</label>
                                <input type="date" name="date1" class="form-control">
                                @error("date1")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label>الي :</label>
                                <input type="date" name="date2" class="form-control">
                                @error("date2")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <input type="submit"  class="btn btn-primary btn-lg"   value="عرض" class="form-control" style="margin-top: 10%">
                            </div>
                       </div>
                    </form>
			    </div>
		    </div>
	    </div>
    </div>

    <div class="table-responsive">
        @if ($projects)
        <table class="table text-md-nowrap" id="example1">
            <thead>
            <tr>
                <th class="wd-15p border-bottom-0"> رقم الشحنة</th>
                <th class="wd-15p border-bottom-0"> اسم المستلم</th>
                <th class="wd-15p border-bottom-0"> تليفون المستلم</th>
                <th class="wd-15p border-bottom-0"> اسم المورد</th>
                <th class="wd-15p border-bottom-0"> تليفون المورد</th>
                {{-- <th class="wd-15p border-bottom-0"> اسم المندوب </th> --}}
                <th class="wd-15p border-bottom-0"> سعر الشحنة</th>
                <th class="wd-15p border-bottom-0">سعر الشحن</th>
                <th class="wd-15p border-bottom-0"> اجمالي الشحن</th>
                <th class="wd-15p border-bottom-0"> حالة الشحنة</th>
                <th class="wd-15p border-bottom-0">  ملاحظات</th>
                <th class="wd-15p border-bottom-0">تاريخ التسليم</th>
            </tr>
            </thead>

                @foreach ($projects as $item)
                   <tr>
                        <td> {{ $item->package_number }}</td>
                        <td> {{ $item->resever_name }}</td>
                        <td> {{ $item->resver_phone }}</td>
                        <td> {{ $item->supplier->name }}</td>
                        <td> {{ $item->supplier->phone }}</td>
                        {{-- <td> {{ $item->status->orders }}</td> --}}
                        <td> {{ $item->product_price }}</td>
                        <td> {{ $item->shipping_price }}</td>
                        <td> {{ $item->total_price }}</td>
                        <td> {{ $item->status->name }}</td>
                        <td> {{ $item->notes }}</td>
                        <td> {{ $item->rescive_date }}</td>

                   </tr>
                @endforeach

                @if ($returns)
                    @foreach ($returns as $returns1)
                        @foreach ($returns1->orders_detailes as $item)
                            <tr>
                                <td> {{ $item->product->package_number }}</td>
                                <td> {{ $item->product->resever_name }}</td>
                                <td> {{ $item->product->resver_phone }}</td>
                                <td> {{ $item->product->supplier->name }}</td>
                                <td> {{ $item->product->supplier->phone }}</td>
                                {{-- <td> {{ $item->order->pluck('') }}</td> --}}
                                <td> {{ $item->product->product_price }}</td>
                                <td> {{ $item->shipping_price }}</td>
                                <td> {{ $item->total_price }}</td>
                                <td> {{ $item->status->name }}</td>
                                <td> {{ $item->product->notes }}</td>
                                <td> {{ $item->product->rescive_date }}</td>

                            </tr>
                        @endforeach
                    @endforeach
                @endif
        </table><br>
        @endif
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
