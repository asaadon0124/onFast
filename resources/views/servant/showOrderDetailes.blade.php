@extends('servant.layouts.app')
@section('content')
      <!-- training -->
      <div id="training" class="training" style="margin-top: 20px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2> تفاصيل  <strong class="black"> خطوط السير</strong></h2>
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
                                    <th>اسم المستلم</th>
                                    <th>تليفون المستلم</th>
                                    <th>عنوان المستلم</th>
                                    <th>تاريخ الاستلام المستلم</th>
                                    <th>المورد </th>
                                    <th>  المحافظة</th>
                                    <th>المدينة</th>
                                    <th> سعر الشحنة</th>
                                    <th> سعر الشحن</th>
                                    <th>الاجمالي</th>
                                    <th>حالة الشحنة </th>
                                    <th>  الملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{ $detailes->orders_detailes->count() }}
                                @if ($detailes->orders_detailes &&  $detailes->orders_detailes->count() > 0)

                                    @php
                                        $x = 1;
                                    @endphp

                                    @foreach ($detailes->orders_detailes as $product)
                                        
                                        <tr style="background-color: #2d2d2d">
                                            <td style="color: #fff; font-weight:bold">{{ $x++ }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $product->product->resever_name }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $product->product->resver_phone }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $product->product->adress }}</td>
                                            <td style="color: #fff; font-weight:bold">{{ $product->product->rescive_date }}</td>
                                            <td style="color: #fff; font-weight:bold">
                                                {{ $product->product->supplier->name }} <br>
                                                {{ $product->product->supplier->phone }}
                                            </td>
                                            <td style="color: #fff; font-weight:bold">
                                                @if (isset( $product->product->cities->governorate->name) && $product->count() > 0)
                                                    {{ $product->product->cities->governorate->name }}												
                                                @endif
                                            </td>
                                            <td style="color: #fff; font-weight:bold">
                                                @if (isset( $product->product->cities->name) && $product->count() > 0)
                                                    {{ $product->product->cities->name }}												
                                                @endif
                                            </td>
                                            <td style="color: #fff; font-weight:bold">{{$product->product->product_price }}</td>
                                            <td style="color: #fff; font-weight:bold">{{$product->product->shipping_price }}</td>
                                            <td style="color: #fff; font-weight:bold">{{$product->product->total_price }}</td>
                                            <td style="color: #fff; font-weight:bold">{{$product->product->status->name }}</td>
                                            <td style="color: #fff; font-weight:bold">{{$product->product->notes }}</td>  
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