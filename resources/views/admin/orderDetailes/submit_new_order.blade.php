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
	@media print {
	  .noPrint{
		display:none;
	  }
	}
	</style>
@endsection

@section('content')
<br>
<h1>فاتــــــورة خــــــــط سيـــــر</h1>


    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">
                                @if ($orders && $orders->count() > 0)
                                    <div class="form-group">
                                        <label for="">رقم الفاتورة</label>
                                            <input type="number" value="{{ $orders->id+1 }}">
                                    </div>
                                @endif
                            </h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
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
                        <div class="row mr-2 ml-2" id="successStatus" style="display: none">
                            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2" id="Smessage">
                                تم تعديل الحالة بنجاح
                            </button>
                        </div>


                    {{--  END GET FLASH MESSAGES   --}}


                    {{-- START SUBMIT FORM FOR ORDER TABLE  --}}
                        <form action="{{ route('orders.store') }}" id="createOrder" method="post" @if ($orderDetailes->count() < 1)
                            hidden
                            @endif>
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">الاجمالي</label>
                                        <input type="number" name="total_price" class="form-control total" value="{{ $totalPrice }}" disabled>
                                        <input type="hidden" name="total_price" class="form-control total" value="{{ $totalPrice }}">
                                        @error("total_price")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label for="">اسم المندوب</label>
                                        <select name="servant_id" class="form-control">
                                            <option value="">اختار مندوب خط السير</option>
                                            @foreach ($servants as $servant)
                                                <option value="{{ $servant->id }}">
                                                    {{ $servant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("servant_id")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <button href="#" onclick="window.print();"  class="btn btn-info btn-lg " style=" margin-top:-90px; margin-right:360px;hieght:20px;">
                                        <span  class="fa fa-print noPrint" ></span>
                                    </button>
                                </div>


                            <div class="noPrint">
                                    <div class="form-group">

                                        <button class="btn btn-primary form-control "  style="width:50%; margin-right:20%; background-color:#00b9ff">
                                            اضافة الاوردر
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    {{-- END SUBMIT FORM FOR ORDER TABLE  --}}


                        <div class="table-responsive">
                            @if ($orderDetailes && $orderDetailes->count() > 0)
                                <table class="table text-md-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p  border-bottom-0"> رقم</th>
                                            <th class="wd-15p border-bottom-0">اسم المورد</th>
                                            <th class="wd-15p border-bottom-0">تليفون المورد</th>
                                            <th class="wd-15p border-bottom-0">اسم المستلم</th>
                                            <th class="wd-15p border-bottom-0">تليفون المستلم</th>
                                            <th class="wd-15p border-bottom-0">اسم المدينة التابعة لها</th>
                                            <th class="wd-15p border-bottom-0">عنوان المستلم</th>
                                            <th class="wd-5p border-bottom-0"> سعر الشحنة</th>
                                            <th class="wd-15p border-bottom-0"> قيمة الشحن</th>
                                            <th class="wd-15p border-bottom-0"> اجمالي الشحن</th>
                                            {{-- <th class="wd-15p border-bottom-0"> حالة الشحنة</th> --}}
                                            <th class="wd-15p border-bottom-0">تاريخ التسليم</th>
                                            <th> ---- </th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @php
                                            $x = 1;
                                        @endphp

                                        @foreach ($orderDetailes as $index=>$item)
                                            <tr class="productRow">
                                                <td>{{ $x++ }}</td>
                                                <td>{{ $item->product->supplier->name}}</td>
                                                <td>{{ $item->product->supplier->phone}}</td>
                                                <td>{{ $item->product->resever_name}}</td>
                                                <td>{{ $item->product->resver_phone}}</td>
                                                <td>{{ $item->product->cities->name}}</td>
                                                <td>{{ $item->product->adress}}</td>
                                                <td class="product_price" id="product_price{{ $item->id }}">
                                                    {{ $item->product->product_price}}
                                                </td>
                                                <td>						{{-- SHIPPING PRICE --}}
                                                    <form class="shipping_price">
                                                        <input type="number" class="price{{ $item->id }}" name="price{{ $item->id }}" style="width: 100%" id="price{{ $item->id }}" value="{{ $item->shipping_price }}">
                                                    <div class="noPrint">	<button row_id="{{ $item->id }}" class="change_price btn btn-success" style="background-color:#0162e8">تعديل</button> </div>
                                                    </form>
                                                </td>
                                                                        {{-- TOTAL PRICE --}}
                                                <td class="total_price" id="total_price{{ $item->id }}">
                                                    {{ $item->product->product_price + $item->shipping_price }}
                                                </td>
                                                
                                                <td> {{ $item->created_at }}</td>
                                                                            {{-- DELETE ROW --}}
                                                <td>
                                                    <form action="{{ route('orderDetailes.forceDelete',$item->id) }}" method="post">
                                                        @csrf

                                                    <div class="noPrint">
                                                            <button class="btn btn-danger">
                                                                <i class="fa fa-trash">

                                                                </i>
                                                        </button>
                                                    </div>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            @else
                                <h1 class="text-center">لا يوجد شحنات</h1>
                            @endif
                            <div class="noPrint">
                            <p>
                                <strong style="color: #f00">Note</strong>:	يجب ادخال قيمة الشحن قبل انشاء خط السير
                            </p>
                        </div>
                        {{-- NEXT BUTTON  --}}
                        <div class="noPrint">
                            <a href="{{ route('orders.index') }}" class="text-center " style="margin-right: 91%;">

                                <button class="btn btn-primary">
                                    متابعـــة
                                </button>

                            </a>
                        </div>
                        {{-- NEXT BUTTON  --}}
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




     {{--  CHANGE SHIPPING PRICE  --}}
        <script>
            $(document).on('click','.change_price',function(e)
            {
                e.preventDefault();
               
                //Get Form Data
                var itemId              = $(this).attr('row_id');
                var sel_val             = document.getElementById("price"+itemId).value;
                var productPrice_row    = $("#product_price"+itemId).html();

                //GET CALCULATE OF TOTAL PRICE FOR EVRY ROW
                var sumRow              = parseFloat(sel_val) + parseFloat(productPrice_row);


                //CALCULATE TOTAL PRICE OF ORDER IN TOTAL INPUT
                var numRow =  $(".total_price").length;

                var sum = 0;
                $('.total_price').each(function ()
                {
                    sum += Number($(this).html());
                });

            $('.total').val(sum);

                $.ajax(
                {
                    type: 'post',
                    url: "{{route('orderDetailes.changeShippingPrice')}}",
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
                                $('#total_price' + itemId).html(sumRow);
                            }

                            // DELETE ROW FROM TABLE
                            $('.supplierRow'+data.id).remove();
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
