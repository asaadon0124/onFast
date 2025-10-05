 {{-- START SEARCH  شحنات في المخزن--}}
 <div class="table-responsive">

    <table class="table text-md-nowrap" id="">
        {{-- SEARCH FORM --}}
        <div class="container search" style="width: 50%">
            <form id="searchForm">
                <div class="form-group">
                    <input type="text" name="filter" class="form-control text-center"
                        placeholder="بحث برقم تليفون العميل او اسم العميل " id="val2"
                        style="background-color: #a1a1a1; color:#fff">
                    <span class="text-danger" id="search_error"></span>
                </div>
            </form>
        </div>

        <thead>
            <tr>

                <th class="wd-10p border-bottom-0">تاريخ الدخول</th>
                <th class="wd-10p border-bottom-0">تاريخ التسليم</th>
                <th class="wd-10p border-bottom-0">اسم المورد</th>
                <th class="wd-10p border-bottom-0">اسم المستلم</th>
                <th class="wd-5p border-bottom-0">تليفون المستلم</th>
                <th class="wd-5p border-bottom-0"> اسم المحافظة</th>
                <th class="wd-5p border-bottom-0">اسم المدينة التابعة لها</th>
                <th class="wd-30p border-bottom-0">عنوان المستلم</th>
                <th class="wd-1p border-bottom-0"> سعر الشحنة</th>
                <th class="wd-1p border-bottom-0"> سعر الشحن</th>
                <th class="wd-2p border-bottom-0"> الاجمالي</th>
                <th class="wd-5p border-bottom-0"> حالة الشحنة</th>

            </tr>
        </thead>

        <tbody id="dataRow" class="text-center">


            @if ($allOrders && $allOrders->count() > 0)
                @php
                    $x = 1;
                @endphp
                @foreach ($allOrders as $item)
                    <tr class="dataRow{{ $item->id }}" id="dataRow">

                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->rescive_date }}</td>
                        <td>{{ $item->supplier->name }}</td>
                        <td>{{ $item->resever_name }}</td>
                        <td>{{ $item->resver_phone }}</td>
                        <td>{{ $item->cities->governorate->name }}</td>
                        <td>{{ $item->cities->name }}</td>
                        <td>{{ $item->adress }}</td>
                        <td>{{ $item->product_price }}</td>
                        <td>{{ $item->shipping_price }}</td>
                        <td>{{ $item->total_price }}</td>
                        
                    </tr>
                @endforeach
            @endif
        </tbody>

        <tbody id="dataRow2" class="text-center" style="display: none">

        </tbody>

        <tfoot id="paginate2">
            <tr>
                <th colspan="12">
                    <div class="float-right">
                        {{ $allOrders->links() }}
                    </div>
                </th>
            </tr>
        </tfoot>

    </table><br>


    





</div>
{{-- END SEARCH  شحنات في  المخزن--}}