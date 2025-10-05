@extends('user.layouts.app')
@section('nav_title')
    اضافة شحنة جديدة
@endsection

@section('content')
    <div class="container" style=" margin-bottom:100px">

        <div class="text-center mb-5">
            <h1>
                اضافة شحنة جديدة
            </h1>
        </div>


        <div id="message">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div id="success">
                @include('admin.alerts.success')
            </div>
            <div id="error">
                @include('admin.alerts.errors')
            </div>
        </div>

        <div class="row">

                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card" >
                        <div class="card-header" style="background-color: #f8c701">
                            <h3 class="card-title"> اضافة شحنة جديدة </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form"  action="{{ route('store.create.product') }}" method="post">
                                @csrf

                                <div class="row">

                                     <!-- RESCIVER NAME -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>اسم المستلم</label>
                                            <input type="text" class="form-control" placeholder="ادخل اسم المستلم" name="resever_name">
                                            @error('resever_name')
                                                <div class="alert alert-danger text-center rounded"
                                                    style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- RESCIVER PHONE  --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>تليفون المستلم</label>
                                            <input type="number" class="form-control" placeholder="ادخل تليفون المستلم" name="resver_phone">
                                            @error('resver_phone')
                                                <div class="alert alert-danger text-center rounded"
                                                    style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- GOVERNMENT  --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>اختار المحافظة</label>
                                            <select class="form-control" id="gov">
                                                <option value="">اختار محافظة</option>
                                                @foreach ($governorates as $gov)
                                                    <option value="{{ $gov->id }}">
                                                        {{ $gov->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                      {{-- CITY  --}}
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>اختار المدينة</label>
                                            <select class="form-control" id="city" name="city_id">
                                             <option disabled selected>اختار المدينة </option>
                                            </select>
                                            @error('city_id')
                                                <div class="alert alert-danger text-center rounded"
                                                    style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ADRESS --}}
                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>عنوان المستلم</label>
                                            <textarea class="form-control" rows="3" placeholder="ادخل عنوان المستلم" name="adress">

                                            </textarea>
                                            @error('adress')
                                                <div class="alert alert-danger text-center rounded"
                                                    style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- PRODUCT PRICE -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> سعر الشحنة</label>
                                            <input type="number" class="form-control" placeholder="ادخل سعر الشحنة" name="product_price" id="productPrice">
                                            @error('product_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <div class="alert alert-danger text-center rounded"
                                                        style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                     <!-- SHIPPING PRICE -->
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> سعر الشحن</label>
                                            <input type="number" class="form-control" placeholder="ادخل سعر الشحن" name="shipping_price" id="shippingPrice">
                                            @error('shipping_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <div class="alert alert-danger text-center rounded"
                                                        style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                     <!-- TOTAL  -->
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> الاجمالي </label>
                                            <input type="number" class="form-control" placeholder="0" id="totalPrice" disabled>
                                            <input type="number" class="form-control" placeholder="0" name="total_price" id="totalPrice2" hidden>
                                            @error('total_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <div class="alert alert-danger text-center rounded"
                                                        style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                     <!-- RESCIVE DATE  -->
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> تاريخ التسليم </label>
                                            <input type="date" class="form-control" name="rescive_date">
                                            @error('rescive_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <div class="alert alert-danger text-center rounded"
                                                        style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                      {{-- NOTES --}}
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>الملاحظات </label>
                                            <textarea class="form-control" rows="3" placeholder="ادخل الملاحظات " name="notes">

                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"
                                        style="direction: rtl !important">
                                        <input type="submit" style="direction: rtl" value="حفظ"
                                            class="btn btn-warning btn-radius btn-brd grd1 btn-block">
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div><!-- end col -->
        </div><!-- end row -->
    </div>
@endsection

@section('js')
    {{--  GET CITIES  --}}
    <script>
        $(document).ready(function() {
            $('#gov').on('change', function() {
                var gov = $(this).val();

                if (gov) {
                    $.ajax({
                        url: "{{ url('/users/cities/') }}/" + gov,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $("#city").empty();
                            $.each(data, function(key, value) {
                                $("#city").append('<option value="' + value.id + '">' +
                                    value.name + '</option>')
                            });
                        }
                    });
                } else {
                    alert('Error');
                }
            });
        });
    </script>



    {{-- GET PRODUCT PRICE --}}
    <script>
        $(document).ready(function()
        {
            $('#productPrice').on('change', function()
            {
                var product_price   = $("#productPrice").val();
                var shipping_price  = $("#shippingPrice").val();
                var total_price     = $("#totalPrice").val(parseInt(product_price) + parseInt(shipping_price));
                var total_price3    = $("#totalPrice2").val(parseInt(product_price) + parseInt(shipping_price));
            });
            $('#shippingPrice').on('change', function()
            {
                var product_price2 = $("#productPrice").val();
                var shipping_price2 = $("#shippingPrice").val();
                var total_price2 = $("#totalPrice").val(parseInt(product_price2) + parseInt(shipping_price2));
                var total_price3 = $("#totalPrice2").val(parseInt(product_price2) + parseInt(shipping_price2));
            });
        });
    </script>
@endsection
