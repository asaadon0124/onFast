



@extends('admin.layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('content')

 {{--  SUCCESS MESSAGE   --}}
                    <div class="row mr-2 ml-2" id="succes_msg" style="display: none">
                        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
                                تم الحفظ بنجاح
                        </button>
                    </div>

                    {{--  ERROR MESSAGE   --}}
                    <div class="row mr-2 ml-2" id="error_msg" style="display: none">
                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2">
                                هناك خطا ما برجاء المحاولة فيما بعد
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <form  class="parsley-style-1" id="createٍProduct" name="selectForm2" novalidate="" action="{{ route('products.store') }}" method="post">
                                        @csrf

                                        <div class="row">

                                                {{--  SUPPLIER ID   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اسم المورد</label> <br>
                                                        <select name="supplier_id" class="form-control" id="nameId" style="width: 100%">
                                                            <option value="">اختار اسم المورد</option>
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">
                                                                    {{ $supplier->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('supplier_id')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{--  RESEVER NAME   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اسم المستلم</label>
                                                        <input type="text" name="resever_name" class="form-control" placeholder="ادخل اسم المستلم">

                                                        @error('resever_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{--  RESEVER PHONE   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">تليفون المستلم</label>
                                                        <input type="text" name="resver_phone" class="form-control" placeholder="ادخل تليفون المستلم">

                                                        @error('resver_phone')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{--  GOVERNORATE_ID   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اسم المحافظة</label>

                                                        <select  class="form-control" id="gov">
                                                            <option value="">اختار محافظة</option>
                                                            @foreach ($governorates as $gov)
                                                                <option value="{{ $gov->id }}">
                                                                    {{ $gov->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                {{-- CITY ID  --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اختار المدينة</label>
                                                        <select class="search_form_select form-control" name="city_id" id="city">
                                                            <option disabled selected>Select City</option>

                                                        </select>
                                                        @error('city_id')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{--  ADRESS   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">عنوان المستلم</label>
                                                        <input type="text" name="adress" class="form-control" placeholder="ادخل عنوان المستلم">

                                                        @error('adress')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{--  TOTAL PRICE   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اجمالي سعر الشحنة</label>
                                                        <input type="number" name="total_price" class="form-control" placeholder="ادخل اجمالي سعر الشحنة" id="totalPrice">

                                                        @error('total_price')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{--  SHIPPING PRICE   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">سعر الشحن</label>
                                                        <input type="number" name="shipping_price" class="form-control" placeholder="ادخل قيمة الشحن" id="shippingPrice">

                                                        @error('shipping_price')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                                </div>

                                                {{--  PRODUCT PRICE   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">سعر الشحنة</label>
                                                        <input type="number" name="product_price" class="form-control" placeholder="ادخل سعر الشحنة" id="productPrice">

                                                        @error('product_price')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                 {{--   NOTES   --}}
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">ملاحظات الشحنة</label>
                                                        <textarea name="notes" id="" cols="50" rows="3">

                                                        </textarea>

                                                        @error('notes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                 {{--   RESCIVE DATE   --}}
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">تاريخ تسليم الشحنة</label>
                                                        <input type="date" name="rescive_date" class="form-control" min="1997-01-01" max="2030-12-31">

                                                        @error('rescive_date')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                        </div>



                                        <div class="mg-t-30">
                                            <button class="btn btn-main-primary pd-x-20" id="makeCreateProduct" type="submit">اضافة شحنة جديدة للمخزن</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
               
    <!-- End Modal effects-->

<br>

@endsection
@section('js')
	<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>


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

{{-- Drob Down Search  --}}
<script type="text/javascript">

      $("#nameId").select2();

	</script>
@endsection       

                   





