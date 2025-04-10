@extends('servant.layouts.app')
@section('content')
    
    <!-- start slider section -->
    <div class="slider_section banner_main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="main_text">
                        <h1>مرحبا <br><strong class="bold_text">On</strong><strong class="bold_text_black">Fast</strong></h1>
                        <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a</span>
                        <a href="{{ route('servant.allOrders') }}"> <i class="fa fa-angle-left" aria-hidden="true"></i> كل الشحنات </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
    <!-- end slider section -->

    

    

    <!-- training -->
    <div id="training" class="training">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>خطوط السير <strong class="black"> المفتوحة</strong></h2>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <table class="table responsive">
                            <thead style="background-color: #f8c701; font-weight:bold">
                                <tr>
                                    <th>رقم</th>
                                    <th>المدينة</th>
                                    <th>عدد الشحنات</th>
                                    <th>اجمالي سعر الشحنات</th>
                                    <th>اجمالي سعر الشحن</th>
                                    <th>الاجمالي</th>
                                    <th>حالة خط السير</th>
                                    <th>  الملاحظات</th>
                                    <th>التفاصيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{ $data[0]->orders->count() }}
                                @if ($data[0]->orders &&  $data[0]->orders->count() > 0)

                                    @php
                                        $x = 1;
                                    @endphp

                                    @foreach ($data[0]->orders as $order)
                                        
                                        <tr style="background-color: #2d2d2d">
                                            <td style="color: #fff; font-weight:bold">{{ $x++ }}</td>
                                            <td style="color: #fff; font-weight:bold">
                                                @if (isset( $order->orders_detailes[0]->product->cities->name) && $order->orders_detailes->count() > 0)
                                                    {{ $order->orders_detailes[0]->product->cities->name }}												
                                                @endif
                                            </td>
                                            <td style="color: #fff; font-weight:bold">
                                                {{$order->orders_detailes->count() }}
                                            </td>
                                            <td style="color: #fff; font-weight:bold">{{ $order->total_prices - $order->total_shipping }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $order->total_shipping }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $order->total_prices }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $order->status->name }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $order->notes }}</td>
                                            <td>
                                                <a href="{{ route('servant.showOrderDetailes',$order->id) }}" class="btn btn-warning">عرض التفاصيل</a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <h1>لا يوجد خطوط سير مفتوحة</h1>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end training -->

@endsection