@extends('user.layouts.app')
@section('nav_title')
    @if (isset($products) && $products->count() > 0)
        تقارير {{ $products[0]->status->name }}
    @else
        تقارير {{ $orderDtailes[0]->status->name }}
    @endif
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            @if (isset($products) && $products->count() > 0)
               <h3>
                كل تقارير {{ $products[0]->status->name }} في الفترة من في الفترة من {{ $from }} لي {{ $to }}
               </h3>
            @else
                تقارير {{ $orderDtailes[0]->status->name }} في الفترة من {{ $from }} لي {{ $to }}
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">المورد</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">العميل(s)</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">المندوب</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">سعر الشحنة</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">سعر الشحن</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">الاجمالي</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">تاريخ الاستلام</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">تاريخ التسليم</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"> الحالة</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"> التجكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @if (isset($products) && $products->count() > 0)
                                @foreach ($products as $product)
                                    <tr role="row" class="even">
                                        <td class="sorting_1 dtr-control">
                                            {{ $x++ }}
                                        </td>
                                        <td>
                                            {{ $product->supplier->name }}
                                        </td>
                                        <td>
                                            {{ $product->resever_name }} <br>
                                            {{ $product->resver_phone }}<br>
                                            {{ $product->adress }}
                                        </td>
                                        <td>
        
                                        </td>
                                        <td>
                                            {{ $product->product_price }}
                                        </td>
                                        <td>
                                            {{ $product->shipping_price }}
                                        </td>
                                        <td>
                                            {{ $product->total_price }}
                                        </td>
                                        <td>
                                            {{ $product->created_at }}
                                        </td>
                                        <td>
                                            {{ $product->rescive_date }}
                                        </td>
                                        <td>
                                            {{ $product->status->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('user.edit.product',$product->id) }}" class="btn btn-sm" style="background-color: #f8c701; color:#fff"> تعديل</a>
                                        <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                            حزف
                                            </button>
        
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    حزف الشحنة ؟
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                    <form action="{{ route('user.delete.product',$product->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" value="حزف" class="btn btn-danger">
                                                    </form>
        
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
        
                                    </tr>
                                @endforeach
                            @endif
        
                            @if (isset($orderDtailes) && $orderDtailes->count() > 0)
                                @foreach ($orderDtailes as $product)
                                <tr role="row" class="even">
                                    <td class="sorting_1 dtr-control">
                                        {{ $x++ }}
                                    </td>
                                    <td>
                                        {{ $product->product2->supplier->name }}
                                    </td>
                                    <td>
                                        {{ $product->product2->resever_name }} <br>
                                        {{ $product->product2->resver_phone }}<br>
                                        {{ $product->product2->adress }}
                                    </td>
                                    <td>
                                        {{ $product->order2->servant->name }} <br>
                                        {{ $product->order2->servant->phone }}<br>
                                        {{ $product->order2->servant->adress }}
                                    </td>
                                    <td>
                                        {{ $product->product2->product_price }}
                                    </td>
                                    <td>
                                        {{ $product->shipping_price }}
                                    </td>
                                    <td>
                                        {{ $product->total_price }}
                                    </td>
                                    <td>
                                        {{ $product->created_at }}
                                    </td>
                                    <td>
                                        {{ $product->product2->rescive_date }}
                                    </td>
                                    <td>
                                        {{ $product->status->name }}
                                    </td>
                                    <td>
        
                                    </td>
        
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
        
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection