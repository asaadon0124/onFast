

 {{-- START SEARCH FORM --}}
 <div class="container search" style="width: 50%">


    <form id="searchForm" action="" method="get">
        <div class="row">

        {{-- SELECT TYPE  --}}
            <div class="col-sm-3" id="filter_input" style="display: block">
                <div class="form-group">
                    <select name="type"  class="form-control text-center" style="background-color: #32b8e7; color:#000; font-size:18px" id="filter">
                        <option value=""> اختار نوع البحث</option>
                        <option value="resever"> المستلمين</option>
                        <option value="supplier"> الموردين</option>
                        <option value="date">التاريخ</option>
                        <option value="status">حالة الشحنة</option>
                        <option value="city">المدينة</option>
                    </select>

                    @error("type")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        {{-- SELECT STATUS  --}}
            <div class="col-sm-3" id="staus_input" style="display: none">
                <div class="form-group">
                    <select name="status"  class="form-control text-center" style="background-color: #32b8e7; color:#000; font-size:18px" id="status" >
                        <option value=""> اختار حالة الشحنة</option>
                        @foreach ($allStatus as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error("status")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        {{-- SELECT GOV  --}}
            <div class="col-sm-3" id="gov_input" style="display: none">
                <div class="form-group">
                    <select name="gov"  class="form-control text-center" style="background-color: #32b8e7; color:#000; font-size:18px" id="gov">
                        <option value=""> اختار  المحافظة</option>
                        @foreach ($govs as $gov)
                            <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                        @endforeach
                    </select>
                    @error("gov")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        {{-- SELECT CITY  --}}
            <div class="col-sm-3" id="city_input" style="display: none">
                <div class="form-group">
                    <select name="city"  class="form-control text-center" style="background-color: #32b8e7; color:#000; font-size:18px" id="city">
                        <option value=""> اختار  المدينة</option>

                    </select>

                    <span class="text-danger" id="city_error"></span>
                </div>
            </div>


        {{-- FROM DATE  --}}
            <div class="col-sm-3" id="from_input" style="display: none">
                <div class="form-group">
                    <input type="date" name="from" class="form-control" style="background-color: #32b8e7; color:#000; font-size:18px" id="from">
                    @error("from")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

        {{-- TO DATE  --}}
            <div class="col-sm-3" id="to_input" style="display: none">
                <div class="form-group">
                    <input type="date" name="to" class="form-control" style="background-color: #32b8e7; color:#000; font-size:18px" id="to">
                    @error("to")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>



        {{-- INPUT SEARCH  --}}
            <div class="col-sm-3" id="search_input" style="display: block">
                <div class="form-group">
                    <input type="text" name="search" class="form-control text-center"
                        placeholder="بحث" id="search"
                        style="background-color: #42b8e7; color:#000; font-size:18px">
                        @error("search")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
            </div>

        {{-- SUBMIT INPUT   --}}
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="submit" value="بحث"  class="form-control text-center btn btn-success" style="border-color: #080; background-color: rgb(139, 250, 65)" id="val" >
                </div>
            </div>
        </div>
    </form>
</div>
{{-- END SEARCH FORM --}}

<div class="table-responsive">

<table class="table text-md-nowrap">



    <thead>
        <tr>

            <th class="wd-10p border-bottom-0">تاريخ الدخول</th>
            <th class="wd-10p border-bottom-0">تاريخ التسليم</th>
            <th class="wd-10p border-bottom-0">المندوب</th>
            <th class="wd-10p border-bottom-0">المورد</th>
            <th class="wd-10p border-bottom-0"> المستلم</th>
            <th class="wd-5p border-bottom-0"> اسم المحافظة</th>
            <th class="wd-1p border-bottom-0"> سعر الشحنة</th>
            <th class="wd-1p border-bottom-0"> سعر الشحن</th>
            <th class="wd-2p border-bottom-0"> الاجمالي</th>
            <th class="wd-30p border-bottom-0"> الملاحظات</th>
            <th class="wd-5p border-bottom-0"> حالة الشحنة</th>
            <th class="wd-20p border-bottom-0"> الاجرائات</th>

        </tr>
    </thead>

    <tbody id="productRow" class="text-center">
        @if ($productsAll && $productsAll->count() > 0)

            @foreach ($productsAll as $product)
                @if ($product->orders_detailes && $product->orders_detailes->count() > 0)
                    @foreach ($product->orders_detailes as $pro)
                        <tr>
                            <td>{{ $pro->created_at }}</td>
                            <td>{{ $pro->product->rescive_date }}</td>
                            @if(isset($pro->order->servant->name))
                                <td>{{ $pro->order->servant->name }} <br> {{ $pro->order->servant->phone }}</td>
                            @endif
                            <td>{{ $pro->product->supplier->name }} <br> {{ $pro->product->supplier->phone }}</td>
                            <td>{{ $pro->product->resever_name }} <br> {{ $pro->product->resver_phone }}</td>
                            <td>{{ $pro->product->cities->governorate->name }} <br> {{ $pro->product->cities->name }} <br> {{ $pro->product->adress }}</td>
                            <td>{{ $pro->product->product_price }}</td>
                            <td>{{ $pro->shipping_price }}</td>
                            <td>{{ $pro->total_price }}</td>
                            <td>
                                <form action="">
                                    <input type="text" name="notes" class="form-control" id="notes{{ $pro->id }}" value="{{ $pro->notes }}">
                                    <button class="notes btn btn-success btn-block" id="{{ $pro->id }}">تعديل</button>
                                </form>
                            </td>
                            <td class="statusA{{ $pro->id }}">{{ $pro->status->name }}</td>
                            @if($pro->product_status != 6)
                            
                                <td class="pro_row{{ $pro->id }}">
                                <form action="" class="status">
                                    <select name="status_id{{ $pro->id }}" id="package_status{{ $pro->id }}" class="st_id{{ $pro->id }} form-control ">
                                        <option value="">اختار الحالة</option>
                                        @foreach ($allStatus as $status)
                                            <option value="{{ $status->id }}"@if ($status->id == $pro->product_status)
                                                selected
                                            @endif>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="noPrint">
                                        <button class="btn btn-primary makeStatus btn-block" id="{{ $pro->id }}" >تعديل</button>
                                    </div>
                                </form>	<br>
                                <p class="lastUpdate{{ $pro->id }}">
                                    {{ $pro->updated_at->format('d/m/Y') }}
                                </p>
                                

                            </td>
                           
                            @endif
                             <td>{{ $pro->updated_at->format('d/m/Y') }}</td>
                            
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->rescive_date }}</td>
                        <td></td>
                        <td>{{ $product->supplier->name }} <br> {{ $product->supplier->phone }}</td>
                        <td>{{ $product->resever_name }} <br> {{ $product->resver_phone }}</td>
                        <td>{{ $product->cities->governorate->name }} <br> {{ $product->cities->name }} <br> {{ $product->adress }}</td>
                        <td>{{ $product->product_price }}</td>
                        <td>{{ $product->shipping_price }}</td>
                        <td>{{ $product->total_price }}</td>
                        <td></td>
                        <td>{{ $product->status->name }}</td>
                      
                    </tr>
                @endif
            @endforeach
        @endif


    </tbody>

    <tbody id="productRow2">

    </tbody>


     <div class="mt-3" id="paginate">
         @if ($request->type)
             {{-- START CASTOM PAGINATE LINKS --}}
                <div class="mb-32pt" id="paginate_castom">
                    @php
                        $paginator = $productsAll->links()->paginator;
                        $urlGet = $_SERVER['REQUEST_URI'];
                        // dd($urlGet);
                        $replace = str_replace("/admin/test","",$urlGet);
                        // dd($replace);
                    @endphp
                    @if($request->search || $request->status || $request->to || $request->city)
                        <ul class="pagination justify-content-start pagination-xsm m-0">
                            @if( $paginator->currentPage() > 1 )
                            <li class="page-item">
                                <a href="{{$replace}}&page={{$paginator->currentPage() - 1}}" class="page-link"><</a>
                            </li>
                            @endif

                        @for ($i = 1; $i < $productsAll->lastPage(); $i++)
                                <li class="page-item @if ($i == $paginator->currentPage())
                                    active
                                @endif">
                                    <a href="{{$replace}}&page={{$i }}" class="page-link">{{$i}}</a>
                                </li>
                        @endfor

                            @if( $paginator->currentPage()  < $paginator->lastPage())
                            <li class="page-item">
                                <a href="{{$replace}}&page={{$paginator->currentPage() + 1}}" class="page-link">></a>
                            </li>
                            @endif
                        </ul>

                    @endif
                </div>
            {{-- END CASTOM PAGINATE LINKS --}}

            <a href="{{ route('Dashboard.history') }}" style="float: left" class="btn btn-warning">رجوع</a>

         @else
            <div id="paginate_master">
                {{ $productsAll->links() }}
            </div>
         @endif





    </div>

</table><br>


</div>



