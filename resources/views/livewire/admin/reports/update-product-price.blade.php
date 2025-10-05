<div>
    @if (!empty($currentStatus) && $currentStatus == 1)
        {{ number_format($product_price, 2) }}
    @else
        <form wire:submit.prevent="update_ProductPrice" class="w-70">
            <div class="input-group input-group-sm">
                <input type="text"
                       class="form-control w-50"
                       wire:model="product_price"
                       placeholder="ادخل سعر الشحنة"
                       style="max-width: 70px; font-size: 13px;">

                <button type="submit" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-save"></i>
                </button>
            </div>

            @if ($product_price)
                <small class="d-block mt-1" style="font-size: 15px; font-weight: bold; color:#2c3e50;">
                    <i class="fa fa-sticky-note"></i> {{ number_format($product_price, 2) }}
                </small>
            @endif
        </form>
    @endif
</div>
