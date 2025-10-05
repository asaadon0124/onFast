@extends('admin.layouts.master')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل بيانات الشحنة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
            </div>
        </div>
    </div>

    <!-- row -->
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">تعديل بيانات الشحنة</h4>
                    </div>
                    {{--  START GET FLASH MESSAGES   --}}
                        @include('admin.alerts.success')
                        @include('admin.alerts.errors')
                    {{--  END GET FLASH MESSAGES   --}}
                    
                    @if ($product)
                        <div class="card-body pt-0">
                            
                            <form  class="parsley-style-1"  name="selectForm2" novalidate="" action="{{ route('orders.updateOrderItem',$product->id) }}" method="POST">
                                @csrf

                                <div class="row">

                                    {{--  PRODUCT ID   --}}
                                    <input type="hidden" name="product_id"  value="{{ $product->id }}" >

                                    {{--  RESEVER NAME   --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">اسم المستلم</label>
                                            <input type="text" name="resever_name" class="form-control" placeholder="ادخل اسم المستلم" value="{{ $product->product->resever_name }}">

                                                <span class="text-danger" id="resever_name_error"></span>
                                        </div>
                                    </div>

                                    {{--  RESEVER PHONE   --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">تليفون المستلم</label>
                                            <input type="text" name="resver_phone" class="form-control" placeholder="ادخل تليفون المستلم" value="{{ $product->product->resver_phone }}">

                                                <span class="text-danger" id="resver_phone_error"></span>
                                        </div>
                                    </div>

                                    {{--  RESEVER ADRESS   --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">عنوان المستلم</label>
                                            <input type="text" name="adress" class="form-control" placeholder="ادخل عنوان المستلم" value="{{ $product->product->adress }}">

                                                <span class="text-danger" id="resver_phone_error"></span>
                                        </div>
                                    </div>

                                    {{--  SERVANT ID   --}}
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">اسم المندوب</label> <br>
                                            <select name="servant_id" class="form-control" style="width: 100%">
                                                <option value="">اختار اسم المندوب</option>
                                                @foreach ($servants as $servant)
                                                    <option value="{{ $servant->id }}" 
                                                        @if ($servant->id == $product->order->servant_id)
                                                            selected
                                                        @endif>
                                                        {{ $servant->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <span class="text-danger" id="servant_id_error"></span>
                                        </div>
                                    </div> --}}

                                    {{-- STATUS ID --}}
                                        {{-- <div class="col-6">
                                            <div class="form-group mg-b-0">
                                                <label class="form-label">حالات الاوردر: <span class="tx-danger">*</span></label>
                                                <select name="status_id" class="form-control">
                                                    <option value=""> اختار حالة الاوردر</option>
                                                    @foreach ($allStatus as $status)
                                                        <option value="{{ $status->id }}" @if ($status->id == $product->product_status)
                                                            selected
                                                        @endif>
                                                            {{ $status->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error("status_id")
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            </div>
                                        </div> --}}

                                    {{--  TOTAL PRICE   --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">اجمالي سعر الشحنة</label>
                                            <input type="number" name="total_price" class="form-control" placeholder="ادخل اجمالي سعر الشحنة" id="totalPrice" value="{{ $product->total_price }}">

                                            <span class="text-danger" id="total_price_error"></span>
                                        </div>
                                    </div>

                                    {{--  SHIPPING PRICE   --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">سعر الشحن</label>
                                            <input type="number" name="shipping_price" class="form-control" placeholder="ادخل قيمة الشحن" id="shippingPrice" value="{{ $product->shipping_price }}">

                                            <span class="text-danger" id="shipping_price_error"></span>
                                        </div>
                                    </div>

                                    {{--  PRODUCT PRICE   --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">سعر الشحنة</label>
                                            <input type="number" name="product_price" class="form-control" placeholder="ادخل سعر الشحنة" id="productPrice" value="{{ $product->product->product_price }}">

                                            <span class="text-danger" id="product_price_error"></span>
                                        </div>
                                    </div>

                                    {{--   NOTES   --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">ملاحظات الشحنة</label>
                                            <textarea name="notes" id="" cols="50" rows="3">
                                                {{ $product->notes }}
                                            </textarea>

                                            <span class="text-danger" id="notes_error"></span>
                                        </div>
                                    </div>

                                    <input type="submit" value="تعديل" class="form-control btn btn-primary" style="background-color: #00f; color:#fff;font-size:25px">

                            </form><br><br>
                            <a href="{{ route('orders.show',$product->order->id) }}" class="btn btn-primary">رجوع</a><br><br>
                        </div>
                   
                    @endif
                </div>
            </div>
        </div>
    <!-- row -->

    @section('js')

     {{-- GET PRODUCT PRICE --}}
        <script>

            $(document).ready(function()
            {
                $('#totalPrice').on('blur',function()
                {
                    // alert("yes");
                    var total_price = $('#totalPrice').val();
                    var shipping_price = $("#shippingPrice").val();
                    var product_price = $("#productPrice").val(total_price-shipping_price);
                });
                $('#shippingPrice').on('blur',function()
                {
                    var total_price = $('#totalPrice').val();
                    var shipping_price = $("#shippingPrice").val();
                    var product_price = $("#productPrice").val(total_price-shipping_price);
                });
                $('#productPrice').on('blur',function()
                {
                    var product_price = $(this).val();
                    var data1 = parseInt($(this).val());
                    var data2 = parseInt($("#shippingPrice").val());
                    var product_price = $("#totalPrice").val(data1+data2);
                });
            });
        </script>
    @endsection
@endsection


