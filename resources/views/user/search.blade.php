@extends('user.layouts.app')

@section('content')

    <div class="container" style="margin-top: 200px; margin-bottom:100px">

        <div class="text-center">
          <h1>
              البحث حسب العميل و رقم التليفون
          </h1>
        </div>

        <h1 style="float: right">
          اسم العميل : @if ($products && $products->count() > 0)
                          {{ $products->pluck('resever_name')->implode(' , ') }}  
                        @else
                          {{ $products2->pluck('resever_name')->implode(' , ') }}
                        @endif
           
      </h1><br><br>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">رقم الشحنة</th>
                <th scope="col">اجمالي قيمة الشحنة</th>
                <th scope="col">حالة الشحنة</th>
                <th scope="col">الاجرائات</th>
              </tr>
            </thead>
            <tbody>

              @php
                  $x = 1;
              @endphp
              @foreach ($products as $pro1)
                <tr>
                  <th scope="row">{{ $x++ }}</th>
                  <td>{{ $pro1->package_number }}</td>
                  <td>{{ $pro1->ordersDetailes->pluck('total_price')->implode(',') }}</td>
                  <td>{{ $pro1->status->name }}</td>
                <td>
                  <a href="" class="btn btn-primary">
                    تفاصيل الشحنة
                    </a>
                </td>
                </tr>
              @endforeach
              @foreach ($products2 as $pro1)
                <tr>
                  <th scope="row">{{ $x++ }}</th>
                  <td>{{ $pro1->package_number }}</td>
                  <td>{{ $pro1->returnsDetailes->pluck('total_price')->implode(',') }}</td>
                  <td>{{ $pro1->status->name }}</td>
                <td>
                  <a href="" class="btn btn-primary">
                    تفاصيل الشحنة
                  </a>
                </td>
                </tr>
              @endforeach
            
            </tbody>
           
        </table>
    </div>   
@endsection