<div class="invoice-container">

    <div class="d-flex justify-content-between align-items-center mb-3 noPrint">
        <h4 class="text-secondary">تقرير الشحنات</h4>
        <button class="btn btn-primary" id="print">
            <i class="fa fa-print"></i> طباعة الفاتورة
        </button>
    </div>


    <div class="invoice-header text-center">
        <img src="{{ asset('assets/admin/images/Untitled-10 copy.jpg') }}" alt="Logo"
            style="width: 120px; border-radius: 50%;">
        <h2 class="mt-2">فاتورة شحنات</h2>
        <p>تاريخ الطباعة: {{ now()->format('Y-m-d') }}</p>
    </div>

    <hr>

    @if (!empty($reports))
        <div class="invoice-info row mb-4">
            <div class="col-md-6">
                <h5>بيانات المورد</h5>
                <p><strong>الاسم:</strong>
                    @if (!empty($reports->first()))
                        {{ optional(optional($reports->first())->product)->supplier->name ?? optional($reports->first())->supplier->name }}
                    @endif


                </p>
                <p><strong>عدد الشحنات:</strong> {{ $reports->count() }} شحنة</p>
            </div>
            <div class="col-md-6 text-end">
                <h5>فترة التقرير</h5>
                <p><strong>من:</strong> {{ $date1 ?? '---' }}</p>
                <p><strong>إلى:</strong> {{ $date2 ?? '---' }}</p>
            </div>
        </div>
    @endif


    <div class="table-responsive">
        <table class="table table-bordered invoice-table text-center">
            <thead class="table-light">
                <tr>
                    <th>تاريخ الدخول</th>
                    <th>تاريخ التسليم</th>
                    <th class="noPrint">اسم المورد</th>
                    <th class="noPrint">اسم المندوب</th>
                    <th>بيانات المستلم</th>
                    <th>المحافظة</th>
                    <th>المدينة</th>
                    <th>سعر الشحنة</th>
                    <th>سعر الشحن</th>
                    <th>الإجمالي</th>
                    <th>الملاحظات</th>
                    <th class="noPrint">الحالة</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($reports))
                    @foreach ($reports as $item)
                        <tr>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>{{ $item->rescive_date ?? $item->product->rescive_date }}</td>
                            <td class="noPrint">{{ $item->product->supplier->name ?? $item->supplier->name }}</td>
                            <td class="noPrint">{{ $item->order->servant->name ?? '-' }}</td>
                            <td>
                                {{ $item->resever_name ?? $item->product->resever_name }} <br>
                                {{ $item->resver_phone ?? $item->product->resver_phone }}
                            </td>
                            <td>{{ $item->cities->governorate->name ?? $item->product->cities->governorate->name }}
                            </td>
                            <td>{{ $item->cities->name ?? $item->product->cities->name }}</td>
                        {{-- <h1>{{ $item->product}}</h1> --}}
                            <!-- عمود سعر الشحنة -->
                            <td class="notes-cell">
                                @livewire(
                                    'admin.reports.update-product-price',
                                    [
                                        'productId'     => $item->product->id ?? null,
                                        'orderDetailId' => $item->id,
                                        'currentStatus' => $item->product_status ?? 1,
                                        'product_price' => $item->product->product_price ?? $item->product_price,
                                    ],
                                    key('price-'.$item->id)
                                )
                            </td>



                            <td>{{ number_format($item->shipping_price, 2) }}</td>
                            <td>{{ number_format($item->total_price, 2) }}</td>
                            <!-- عمود الملاحظات -->
                            @if (!empty($item->product->status))
                                <td class="notes-cell">
                                    <form wire:submit.prevent="update_notes({{ $item->id }})" class="w-100">
                                        @csrf
                                        <div class="input-group input-group-sm notes-input-group noPrint">
                                            <input type="text" class="form-control"
                                                wire:model="notes.{{ $item->id }}" placeholder="ادخل الملاحظات">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </div>
                                        @if ($item->notes)
                                            <small class="text-muted d-block mt-1">
                                                <i class="fa fa-sticky-note"></i> {{ $item->notes }}
                                            </small>
                                        @endif
                                    </form>
                                </td>
                            @else
                                <td>{{ $item->notes }}</td>
                            @endif

                            {{-- عمود الحالات  --}}
                            @if (!empty($item->product->status) && $item->product_status != 6)
                                <td>
                                    @livewire(
                                        'admin.status-selector',
                                        [
                                            'productId' => $item->product->id ?? null,
                                            'orderDetailId' => $item->id,
                                            'currentStatus' => $item->product_status,
                                            'lastUpdate' => $item->updated_at->format('d/m/Y'),
                                        ],
                                        key($item->id)
                                    )
                                </td>
                            @endif

                            {{-- <td class="noPrint">{{ $item->status->name ?? $item->product->status->name }}</td> --}}
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="noPrint">
            @if (!empty($reports))
                {{ $reports->links() }}
            @endif
        </div>

    </div>

    <div class="invoice-total text-end mt-4">
        <h4><strong>الإجمالي الكلي: </strong> {{ number_format($total, 2) }} جنيه</h4>
    </div>
</div>
