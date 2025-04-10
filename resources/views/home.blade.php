@extends('user.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>

          <p>New Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>

          <p>Bounce Rate</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>44</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
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

            @if (isset($productCompleted) && $productCompleted != '')
                @foreach ($productCompleted as $product)
                    <tr role="row" class="even">
                        <td class="sorting_1 dtr-control">{{ $x++ }}</td>
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
                          {{ $product->order2->servant->phone }}

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






