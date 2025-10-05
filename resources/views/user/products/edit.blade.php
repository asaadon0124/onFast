@extends('user.layouts.app')
@section('nav_title')
تعديل شحنة {{ $product->resever_name }}
@endsection

@section('content')


<div class="container" style="margin-bottom:100px">

    <div class="text-center mb-5">
        <h1>
            <strong style="color: #fd6802">{{ $product->resever_name }}</strong> تعديل شحنة
        </h1>
    </div>

    <div class="row">
        <div>
            <div class="contact_form">
                <div id="message">
                    @if(Session::has('success'))
                    <div class="row mr-2 ml-2" id="succes_msg">
                        <button type="text" class="btn btn-lg btn-block btn-outline-primary mb-2" style="background-color: rgb(16, 224, 16); margin-bottom: 10px; color: #000"
                            id="type-error">{{Session::get('success')}}
                        </button>
                    </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="row mr-2 ml-2">
                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                            id="type-error">{{Session::get('error')}}
                        </button>
                    </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-body">
                        <form class="row" action="{{ route('user.update.product',$product->id) }}" method="post" style="direction: rtl">
                            @csrf

                            <div class="row">

                                <!-- RESCIVER NAME -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>اسم المستلم</label>
                                        <input type="text" class="form-control" placeholder="ادخل اسم المستلم" name="resever_name" value="{{ $product->resever_name }}">
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
                                        <input type="number" class="form-control" placeholder="ادخل تليفون المستلم" name="resver_phone" value="{{ $product->resver_phone }}">
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
                                            <option value="{{ $gov->id }}" @if ($gov->id == $product->cities->governorate->id)
                                                selected
                                                @endif>
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
                                        <select class="search_form_select form-control" name="city_id" id="city">
                                            @if (isset($product->city_id))
                                            <option value="{{ $product->city_id }}">
                                                {{ $product->cities2->name }}
                                            </option>
                                            @endif
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
                                        {{ $product->adress }}
                                        </textarea>
                                        @error('adress')
                                        <div class="alert alert-danger text-center rounded"
                                            style="width: 50%; padding: 3px; margin-top: -4%; background-color: #f8c701">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- PRODUCT PRICE -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> سعر الشحنة</label>
                                        <input type="number" class="form-control" placeholder="ادخل سعر الشحنة" name="product_price" id="productPrice" value="{{ $product->product_price }}">
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
                                        <input type="number" class="form-control" placeholder="ادخل سعر الشحن" name="shipping_price" id="shippingPrice" value="{{ $product->shipping_price }}">
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
                                        <input type="number" class="form-control" placeholder="0" id="totalPrice" disabled value="{{ $product->total_price }}">
                                        <input type="number" class="form-control" placeholder="0" name="total_price" id="totalPrice2" value="{{ $product->total_price }}" hidden>
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
                                <input type="date" name="created_at" value="{{ $product->created_at->format('Y-m-d') }}" hidden>
                                <!-- RESCIVE DATE  -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> تاريخ التسليم </label>
                                        <input type="date" class="form-control" name="rescive_date" value="{{ $product->rescive_date}}">
                                        @error('rescive_date')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- NOTES --}}
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>الملاحظات </label>
                                        <textarea class="form-control" rows="3" placeholder="ادخل الملاحظات " name="notes">
                                        {{ $product->notes }}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"
                                    style="direction: rtl !important">
                                    <input type="submit" style="direction: rtl" value="تعديل"
                                        class="btn btn-warning btn-radius btn-brd grd1 btn-block">
                                </div>

                                <div>
                                    <a href="{{ route('user.index.product') }}" class="btn btn-primary">رجوع</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div>
@endsection

@section('js')

{{-- GET CITIES  --}}
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
                            $("#city").append('<option value="' + value.id + '">' + value.name + '</option>')
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
    $(document).ready(function() {
        $('#productPrice').on('change', function() {
            var product_price = $("#productPrice").val();
            var shipping_price = $("#shippingPrice").val();
            var total_price = $("#totalPrice").val(parseInt(product_price) + parseInt(shipping_price));
            var total_price3 = $("#totalPrice2").val(parseInt(product_price) + parseInt(shipping_price));
        });
        $('#shippingPrice').on('change', function() {
            var product_price2 = $("#productPrice").val();
            var shipping_price2 = $("#shippingPrice").val();
            var total_price2 = $("#totalPrice").val(parseInt(product_price2) + parseInt(shipping_price2));
            var total_price3 = $("#totalPrice2").val(parseInt(product_price2) + parseInt(shipping_price2));
        });
    });
</script>

{{-- FADE OUT FLASH MESSAGES --}}
<script>
    $("#message").fadeOut(5000);
</script>


@endsection