@extends('admin.layouts.master')
@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">



@endsection

@section('content')
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">كل الشحنات المسلمة</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
						<!-- <a href="{{ route('reserves.create') }}" class="btn btn-success"> اضافة</a> -->
<br><br>

                        {{--  START GET FLASH MESSAGES   --}}
							<div id="flashMessages">
								@include('admin.alerts.success')
								@include('admin.alerts.errors')
							</div>
                            <div class="row mr-2 ml-2" id="successMsg" style="display: none">
                                <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
                                        تم الحزف بنجاح
                                </button>
                            </div>
                        {{--  END GET FLASH MESSAGES   --}}


                            <div class="table-responsive">
                                @if ($reserves && $reserves->count() > 0)
                                    <table class="table text-md-nowrap" id="done">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0"> رقم</th>
                                                <th class="wd-15p border-bottom-0">اسم المورد</th>
                                                <th class="wd-15p border-bottom-0">   عدد الشحنات</th>
                                                <th class="wd-15p border-bottom-0">   اجمالي المستحق </th>
                                                <th class="wd-15p border-bottom-0">   اجمالي الشحن </th>
                                                      <th class="wd-15p border-bottom-0">    التاريخ </th>
                                                <th class="wd-10p border-bottom-0">الاجرائات</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @php
                                                $x = 1;
                                            @endphp
                                            @foreach ($reserves as $reserve)
                                                <tr>
                                                    <td>{{ $x++ }}</td>
                                                    <td>{{ $reserve->supplier->name }}</td>
                                                    <td>{{ $reserve->reservesDetailes->count() }}</td>
                                                    <td>{{ $reserve->reservesDetailes->pluck('product')->sum('product_price') }}</td>
                                                    <td>{{ $reserve->reservesDetailes->pluck('product')->sum('shipping_price') }}</td>
                                                    <td>{{ $reserve->created_at}}</td>
                                                    <td>
														<a href="{{ route('reserves.show',$reserve->id) }}" class="btn btn-info"> عرض</a>
													</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <h1 class="text-center">لا يوجد شحنات تم تسليمها</h1>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--/div-->
            </div>
            <!-- /row -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

	
	   <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function()
    {
        $('#done').DataTable(
            {
                processing: true,
            });
    });
</script>
	 

	<script>
		$("#flashMessages").fadeOut(500);
	</script>
@endsection