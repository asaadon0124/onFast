@extends(' user.layouts.app')




@section('content')

		<!-- row -->
        <div class="row">
            <div class="col-md-12">



                <div id="features" class="section lb">
                    <div class="container">

                        <div class="section-title text-center">
                            <h3>تفاصيل الشحنة </h3>
                        </div><!-- end title -->


                        <div class="row">
                            @if ($product && $product->count() > 0)
                                @if ($product->orders_detailes && $product->orders_detailes->count() > 0)
                                    @foreach ($product->orders_detailes as $pro)
                                        <div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" style="padding: 10px">
                                                <ul class="features-left">
                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                       <i class="flaticon-new-file"></i>
                                                        <div class="fl-inner" style="margin-top: 6%">
                                                            <h3 style="color: orange">رقم الشحنة</h3>
                                                            <strong><p>{{ $product->package_number }} </p></strong>
                                                        </div>
                                                    </li>

                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                       <i class="flaticon-new-file"></i>
                                                        <div class="fl-inner" style="margin-top: 6%">
                                                            <h3 style="color: orange">اسم المستلم</h3>
                                                            <strong><p>{{ $product->resever_name  }} </p></strong>
                                                        </div>
                                                    </li>

                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                       <i class="flaticon-new-file"></i>
                                                        <div class="fl-inner" style="margin-top: 6%">
                                                            <h3 style="color: orange">تليفون المستلم</h3>
                                                            <strong><p>{{ $product->resver_phone   }} </p></strong>
                                                        </div>
                                                    </li>

                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                       <i class="flaticon-new-file"></i>
                                                        <div class="fl-inner" style="margin-top: 6%">
                                                            <h3 style="color: orange">عنوان المستلم</h3>
                                                            <strong><p>{{ $product->adress }} </p></strong>
                                                        </div>
                                                    </li>
                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                       <i class="flaticon-new-file"></i>
                                                        <div class="fl-inner" style="margin-top: 6%">
                                                            <h3 style="color: orange">اسم المورد</h3>
                                                            <strong><p>{{ $product->supplier->name   }} </p></strong>
                                                        </div>
                                                    </li>
                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                       <i class="flaticon-new-file"></i>
                                                        <div class="fl-inner" style="margin-top: 6%">
                                                            <h3 style="color: orange">تاريخ التسليم</h3>
                                                            <strong><p>{{ $product->rescive_date   }} </p></strong>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                            {{-- ********************************* --}}

                                            <div class="col-md-4 hidden-xs hidden-sm text-center">
                                                <ul class="features-left">
                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                       <i class="flaticon-new-file"></i>
                                                        <div class="fl-inner" style="margin-top: 6%">
                                                            <h3 style="color: orange">حالة الشحنة</h3>
                                                            @if ($pro->type == 4)
                                                                <strong><p>في انتظار الموافقة </p></strong>
                                                            @else
                                                                <strong><p>{{ $pro->status->name   }} </p></strong>
                                                            @endif
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                            {{-- ********************************* --}}

                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <ul class="features-right">
                                                    @if (isset($pro->order->servant->name))
                                                        <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                            <i class="flaticon-new-file"></i>
                                                            <div class="fl-inner" style="margin-top: 6%">
                                                                <h3 style="color: orange">اسم المندوب</h3>
                                                                <strong><p>{{ $pro->order->servant->name   }} </p></strong>
                                                            </div>
                                                        </li>
                                                    @endif

                                                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                        <i class="flaticon-new-file"></i>
                                                         <div class="fl-inner" style="margin-top: 6%">
                                                             <h3 style="color: orange">اسم المحافظة</h3>
                                                             <strong><p>{{ $product->cities->governorate->name   }} </p></strong>
                                                         </div>
                                                     </li>

                                                     <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                        <i class="flaticon-new-file"></i>
                                                         <div class="fl-inner" style="margin-top: 6%">
                                                             <h3 style="color: orange">اسم المدينة</h3>
                                                             <strong><p>{{ $product->cities->name   }} </p></strong>
                                                         </div>
                                                     </li>
                                                     <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                        <i class="flaticon-new-file"></i>
                                                         <div class="fl-inner" style="margin-top: 6%">
                                                             <h3 style="color: orange">قيمة الشحنة </h3>
                                                             <strong><p>{{ $product->product_price   }} </p></strong>
                                                         </div>
                                                     </li>
                                                     <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                        <i class="flaticon-new-file"></i>
                                                         <div class="fl-inner" style="margin-top: 6%">
                                                             <h3 style="color: orange">سعر الشحن</h3>
                                                             <strong><p>{{ $pro->shipping_price   }} </p></strong>
                                                         </div>
                                                     </li>
                                                     <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                        <i class="flaticon-new-file"></i>
                                                         <div class="fl-inner" style="margin-top: 6%">
                                                             <h3 style="color: orange"> الاجمالي</h3>
                                                             <strong><p>{{ $pro->total_price   }} </p></strong>
                                                         </div>
                                                     </li>
                                                </ul>
                                            </div><!-- end col -->
                                        </div>
                                        <hr style="padding: 10px; width:100%; color:#000">
                                    @endforeach
                                @else
                                    <div>
                                        <div class="col-md-4 col-sm-6 col-xs-12" style="padding: 10px">
                                            <ul class="features-left">
                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">رقم الشحنة</h3>
                                                        <strong><p>{{ $product->package_number }} </p></strong>
                                                    </div>
                                                </li>

                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">اسم المستلم</h3>
                                                        <strong><p>{{ $product->resever_name  }} </p></strong>
                                                    </div>
                                                </li>

                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">تليفون المستلم</h3>
                                                        <strong><p>{{ $product->resver_phone   }} </p></strong>
                                                    </div>
                                                </li>

                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">عنوان المستلم</h3>
                                                        <strong><p>{{ $product->adress }} </p></strong>
                                                    </div>
                                                </li>
                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">اسم المورد</h3>
                                                        <strong><p>{{ $product->supplier->name   }} </p></strong>
                                                    </div>
                                                </li>
                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">تاريخ التسليم</h3>
                                                        <strong><p>{{ $product->rescive_date   }} </p></strong>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>

                                        {{-- ********************************* --}}

                                        <div class="col-md-4 hidden-xs hidden-sm text-center">
                                            <ul class="features-left">
                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">حالة الشحنة </h3>
                                                        @if ($product->type == 4)
                                                            <strong><p>في انتظار الموافقة </p></strong>
                                                        @else
                                                            <strong><p>{{ $product->status->name   }} </p></strong>
                                                        @endif
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>

                                        {{-- ********************************* --}}

                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <ul class="features-right">



                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                    <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">اسم المحافظة</h3>
                                                        <strong><p>{{ $product->cities->governorate->name   }} </p></strong>
                                                    </div>
                                                </li>

                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                    <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">اسم المدينة</h3>
                                                        <strong><p>{{ $product->cities->name   }} </p></strong>
                                                    </div>
                                                </li>
                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                    <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">قيمة الشحنة </h3>
                                                        <strong><p>{{ $product->product_price   }} </p></strong>
                                                    </div>
                                                </li>
                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                    <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange">سعر الشحن</h3>
                                                        <strong><p>{{ $product->shipping_price   }} </p></strong>
                                                    </div>
                                                </li>
                                                <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                                    <i class="flaticon-new-file"></i>
                                                    <div class="fl-inner" style="margin-top: 6%">
                                                        <h3 style="color: orange"> الاجمالي</h3>
                                                        <strong><p>{{ $product->total_price   }} </p></strong>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div><!-- end col -->
                                    </div>
                                @endif
                            @endif
                        </div>


{{-- ************************************************************************************************************* --}}


                    </div>

                </div>
            </div>
        </div>
        <!-- row -->

<!-- main-content closed -->


</div><br><br><br>
@endsection
