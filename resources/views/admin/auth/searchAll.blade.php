@extends('admin.layouts.master')
@section('css')
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
				
@endsection







@section('content')
<br><br>
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card mg-b-20">
							<div class="card-body">
								
								<div class="row">
									<!-- col -->
									<div class="col-lg-12 text-center">
										
                                       
                                        {{-- @if($returns)
                                            <h2> اوردر رقم : {{ $returns->id }}</h2>
                                        @endif --}}
                                        
									</div>
									<!-- /col -->
								</div>
							</div>
						</div>


						<div class="card">

                           
                           
                            @if(isset($returns))
                                @foreach ($returns->returnsDetailes as $item)
                                    <div class="card-body">
                                        <div class="main-content-label mg-b-5">
                                            <h4>
                                                <strong>شحنة رقم   : {{ $item->package_number }}</strong>
                                            </h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table main-table-reference text-nowrap mg-t-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>رقم الشحنة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->package_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>اسم المستلم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->resever_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>تليفون المستلم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->resver_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>عنوان المستلم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->adress }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong> اسم المورد :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->supplier->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong> اسم المحافظة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->cities->governorate->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong> اسم المدينة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->cities->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  قيمة الشحنة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->product_price }} جنيه</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  سعر الشحن :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->shipping_price }} جنيه</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>   اجمالي التكلفة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->total_price }} جنيه</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  اسم المندوب :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->orders->servant->name }}</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  حالة الشحنة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->status->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>   تاريخ التسليم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $item->returns->created_at }}</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(isset($products))
                                
                                    <div class="card-body">
                                        <div class="main-content-label mg-b-5">
                                            <h4>
                                                <strong>شحنة رقم   : {{ $products->package_number }}</strong>
                                            </h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table main-table-reference text-nowrap mg-t-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>رقم الشحنة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->package_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>اسم المستلم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->resever_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>تليفون المستلم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->resver_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>عنوان المستلم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->adress }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong> اسم المورد :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->supplier->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong> اسم المحافظة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->cities->governorate->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong> اسم المدينة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->cities->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  قيمة الشحنة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->product_price }} جنيه</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  سعر الشحن :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->shipping_price }} جنيه</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>   اجمالي التكلفة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->total_price }} جنيه</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  اسم المندوب :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->orders->servant->name }}</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>  حالة الشحنة :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->status->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-gray-100 wd-20p" style="font-size: 18px"><b><strong>   تاريخ التسليم :</strong></b></td>
                                                        <td style="color: #b91d7e; font-size:18px">{{ $products->created_at }}</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                               
                            @else
                                <h1 class="text-center">
                                    لا يوجد شحنات لهذا الاوردر
                                </h1>
                            @endif
						</div>
						
					</div>
				</div>
				<!-- row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
@endsection