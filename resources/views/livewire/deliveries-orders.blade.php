<div>
    <div class="row row-sm mt-5">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mg-b-0">كل خطوط السير المحزوفة</h4>
                        <div class="d-flex align-items-center">
                            <input wire:model.live.debounce.300ms="search" type="text" name="search" placeholder="Search" class="form-control me-2">
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    {{-- START GET FLASH MESSAGES --}}
                    @include('admin.alerts.success')
                    @include('admin.alerts.errors')

                    <div class="row mr-2 ml-2" id="successMsg" style="display: none">
                        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
                            تم التفعيل بنجاح و تغير حالة الاوردر
                        </button>
                    </div>
                    {{-- END GET FLASH MESSAGES --}}


                    <div class="table-responsive">
                        @if ($orders && $orders->count() > 0)
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-5p border-bottom-0"> رقم</th>
                                        <th class="wd-5p border-bottom-0" wire:click="sortName('servant.name')"> اسم المندوب</th>                                        <th class="wd-5p border-bottom-0"> اسم المدينة</th>
                                        <th class="wd-5p border-bottom-0"> اجمالي سعر الشحنات</th>
										<th class="wd-5p border-bottom-0"> اجمالي الشحن</th>
                                        <th class="wd-5p border-bottom-0"> اجمالي الشحن</th>
                                        <th class="wd-15p border-bottom-0"> حالة الاوردر</th>
                                        <th class="wd-15p border-bottom-0"> تاريخ التسليم</th>
                                        <th class="wd-10p border-bottom-0">الاجرائات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr class="orderRow{{ $order->id }}">
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $order->servant->name }}</td>
                                            
                                           <td>
                                            @if (isset($order->orders_detailes[0]->product->cities->name) && $order->orders_detailes->count() > 0)
                                            {{ $order->orders_detailes[0]->product->cities->name }}												
                                        @endif
                                           </td>
                                            <td>
												{{ $order->total_prices - $order->total_shipping }}
											</td>
 											<td>
												{{ $order->total_shipping }}
											</td>
                                            <td>{{ $order->total_prices }}</td>
                                            <td>{{ $order->status->name }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <div class="btn-icon-list" style="width: 50%; display:inline-block">
                                                    <a href="{{ route('orders.show_order_detailes', $order->id) }}">
                                                        <button class="btn btn-primary">
                                                             تفاصيل خط السير
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="btn-icon-list" style="width: 50%; display: inline">
                                                    <a class="makeRestoreOrder" order_id="{{ $order->id }}">
                                                        <button class="btn btn-success">
                                                         اعادة تفعيل
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                           
                           
                            

                            <div class="py-4 px-3">
                                <div class="flex">
                                    <div class="flex space-x-4 items-center mb-3" style="width: 300px">
                                        <label for="" class="w-32 text-sm font-medium text-gray-900"> Per Page</label>
                                        <select name="" id="" wire:model.live="perPage" class="form-control">
                                            <option value="5">5</option>
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                {{ $orders->links() }}
                            </div>
                           
                        @else
                            <h1 class="text-center">لا يوجد اوردرات</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
</div>
