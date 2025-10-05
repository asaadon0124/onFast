@extends('user.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
         @if(isset( $proCount->products_supplier_count ))
          <h3>{{ $proCount->products_supplier_count }}</h3>
         @else
          <h3>0</h3>
         @endif

          <p>كل الشحنات</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          @if(isset($proUnCompletedCount->products_supplier_count))
            <h3>{{ $proUnCompletedCount->products_supplier_count }}</h3>
          @else
            <h3>0</h3>
          @endif

          <p>شحنات تحت  التسليم</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->


    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
        @if(isset( $proCompletedCount->products_supplier_count ))
          <h3>{{ $proCompletedCount->products_supplier_count }}</h3>
         @else
          <h3>0</h3>
         @endif

          <p>شحنات تم توصيلها</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->

   
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
      <!-- TO DO List -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            كل الشحنات
          </h3>

          <div class="card-tools">

          </div>
        </div>
        <!-- /.card-header -->
        <div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">#</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">المورد</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">العميل</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">المندوب</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">سعر الشحنة</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">سعر الشحن</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"> الاجمالي</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">تاريخ الاستلام</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">تاريخ التسليم</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"> الحالة</th>
            </tr>
        </thead>
        <tbody>
            @php
                $x = 1;
            @endphp
            @if (isset($products) && $products != '')
                @foreach ($products as $product)
                    <tr role="row" class="even">
                        <td class="sorting_1 dtr-control">{{ $x++ }}</td>
                        <td>
                            {{ $product->supplier->name }}
                        </td>
                        <td>
                            {{ $product->resever_name }} <br>
                            {{ $product->resver_phone }}<br>
                            {{ $product->adress }}
                        </td>
                        <td>
                        @if(isset($product->orders_detailes2[0]))
                            {{ $product->orders_detailes2[0]->order->servant->name }}
                        @endif
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
                    </tr>
                @endforeach
            @endif

           

        </tbody>

        </table></div></div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="{{ route('user.index.product') }}" class="btn btn-info float-right">
              <i class="fas fa-plus"></i>
              كل الشحنات
          </a>
        </div>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.Left col -->



  </div>
@endsection






