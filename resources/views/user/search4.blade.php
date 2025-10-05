@extends('user.layouts.app')

@section('content')

   
    <div class="container" style="margin-top: 200px; margin-bottom:100px">

        <div class="text-center">
            <h1>
                البحث حسب المورد و رقم التليفون
            </h1>
        </div>
        <h1 style="float: right">
            {{-- اسم العميل : @if ($supplierPhone && $supplierPhone->count() > 0)
            {{ $supplierPhone->pluck('resever_name')->implode(' , ') }}  
          @else
            {{ $supplierPhone2->pluck('resever_name')->implode(' , ') }}
          @endif              --}}
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
              @foreach ($supplierPhone as $pro1)
                <tr>
                  <th scope="row">{{ $x++ }}</th>
                  <td>{{ $pro1->products->pluck('package_number')->implode(' ,') }}</td>
                  <td>{{ $pro1->products->pluck('ordersDetailes')[0]->pluck('total_price')->implode(',') }}</td>
                  <td>{{ $pro1->products->pluck('status')->pluck('name')->implode(' ,') }}</td>
                  
                <td>
                  <a href="" class="btn btn-primary">
                    تفاصيل الشحنة
                    </a>
                </td>
                </tr>
              @endforeach
              {{ $supplierPhone3->pluck('returns')->count() }}
              @if ($supplierPhone3->pluck('returns') && $supplierPhone3->pluck('returns')->count() > 0)
              @foreach ($supplierPhone3 as $pro1)
              <tr>
                <th scope="row">{{ $x++ }}</th>
                <td>{{ $pro1->returns->pluck('package_number')->implode(' ,') }}</td>
                {{-- <td>{{ $pro1->returns->pluck('ordersDetailes')[0]->pluck('total_price')->implode(',') }}</td> --}}
                <td>{{ $pro1->returns->pluck('status')->pluck('name')->implode(' ,') }}</td>
              <td>
                <a href="" class="btn btn-primary">
                  تفاصيل الشحنة
                </a>
              </td>
              </tr>
            @endforeach
              @endif
            
            
            </tbody>
           
        </table>
    </div>   
@endsection