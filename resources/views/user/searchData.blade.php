@extends(' user.layouts.app')




@section('content')

    <div class="container test">


    @if ($product && $product->count() > 0)
        <table class="table table table-borderless">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">حالة الطلب</th>
                <th scope="col">تاريخ التسليم</th>
                <th scope="col">اسم المستلم</th>
                <th scope="col">عنوان المستلم</th>
                <th scope="col">سعر الشحنة</th>
                <th scope="col">سعر الشحن</th>
                <th scope="col">الاجمالي </th>
                <th scope="col"> تاريخ التحديث</th>
                <th scope="col">الاجرائات</th>
            </tr>
            </thead>
            <tbody>




                <tr>
                    @if ($product && $product->count() > 0)
                       @foreach ($product as $pro)
                           <th>1</th>
                           <td>{{ $pro->status->name }}</td>
                           <td>{{ $pro->rescive_date }}</td>
                           <td>{{ $pro->resever_name }}</td>
                           <td>{{ $pro->adress }}</td>
                           <td>{{ $pro->product_price }}</td>
                           <td>{{ $pro->shipping_price }}</td>
                           <td>{{ $pro->total_price }}</td>
                           <td>{{ $pro->updated_at }}</td>
                           <td>
                               <a href="">
                                   تفاصيل الشحنة
                               </a>
                           </td>
                       @endforeach
                    @endif

               </tr>




                   @if ($returns && $returns->count() > 0)
                   <tr>
                    @foreach ($returns as $return)
                        <th>1</th>
                        <td>{{ $return->status->name }}</td>
                        <td>{{ $return->rescive_date }}</td>
                        <td>{{ $return->resever_name }}</td>
                        <td>{{ $return->adress }}</td>
                        <td>{{ $return->returnduct_price }}</td>
                        <td>{{ $return->shipping_price }}</td>
                        <td>{{ $return->total_price }}</td>
                        <td>{{ $return->updated_at }}</td>
                        <td>
                            <a href="">
                                تفاصيل الشحنة
                            </a>
                        </td>
                    @endforeach
                </tr>
                   @endif





            </tbody>
        </table>
    @else

    <h3 class="text-center">
        لا يوجد شحنات
    </h3>
    @endif
</div>

@endsection
