@extends('user.layouts.app')
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/user/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/user/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/user/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('nav_title')
كل الشحنات
@endsection
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        كل الشحنات
      </h3>


       <!-- <div class="card-footer clearfix">
            <a href="{{ route('user.create.product') }}"class="float-left" style="background-color: #f8c701; color:#fff; padding:10px" ><i class="fas fa-plus"></i> اضافة شحنة جديدة</a>
        </div> -->

      <div class="card-tools">
        <div id="message">
            @if(Session::has('success'))
                <div class="row mr-2 ml-2" id="succes_msg">
                        <button type="text" class="btn btn-lg btn-block btn-outline-primary mb-2" style="background-color: rgb(16, 224, 16); margin-bottom: 10px; color: #000"
                                id="type-error">{{Session::get('success')}}
                        </button>
                </div>
            @endif

            @if(Session::has('error'))
                <div class="row mr-2 ml-2" >
                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                id="type-error">{{Session::get('error')}}
                        </button>
                </div>
            @endif
        </div>
      </div>
    </div>
    <!-- /.card-header -->
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
                                <td>
                                    @if($product->status_id == 1)
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
                                            <form action="{{ route('user.delete_product.product',$product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="حزف" class="btn btn-danger">
                                            </form>

                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @endif

                   
                </tbody>

            </table>
        </div>
    </div>
    <!-- /.card-body -->

  </div>
@endsection
@section('js')
{{-- <script src="{{ asset('asswts/user/plugins/jquery/jquery.min.js') }}"></script> --}}
<!-- Bootstrap 4 -->
{{-- <script src="{{ asset('asswts/user/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/user/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/user/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- AdminLTE App -->
{{-- <script src="{{ asset('assets/user/dist/js/adminlte.min.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('assets/user/dist/js/demo.js') }}"></script> --}}

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script>
    $("#successStatus").fadeOut(3000);
</script>
@endsection
