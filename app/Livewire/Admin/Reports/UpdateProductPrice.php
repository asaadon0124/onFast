<?php

namespace App\Livewire\Admin\Reports;

use Livewire\Component;
use App\Models\OrderDetailes;

class UpdateProductPrice extends Component
{
    public $productId;
    public $orderDetailId;
    public $product_price;
    public $currentStatus;

    public function mount($productId = null, $orderDetailId = null, $product_price,$currentStatus)
    {
        $this->productId     = $productId;
        $this->orderDetailId = $orderDetailId;
        $this->product_price = $product_price;
        $this->currentStatus = $currentStatus;

        // لو السعر اتبعت من الجدول خليه في الحقل
        if ($product_price)
        {
            $this->product_price = $product_price;
        } else
        {
            // fallback لو مش متبعت
            $orderDetail = OrderDetailes::find($this->orderDetailId);
            if ($orderDetail)
            {
                $this->product_price = $orderDetail->product_price;
            }
        }
    }

    public function update_ProductPrice()
    {
        dd($this->product_price);
        $this->validate([
            'product_price' => 'required|numeric|min:0',
        ]);

        $orderDetail = OrderDetailes::find($this->orderDetailId);

        if ($orderDetail)
        {
            $orderDetail->product_price = $this->product_price;
            $orderDetail->total_price   = $orderDetail->product_price + $orderDetail->shipping_price;
            $orderDetail->save();
        }

        $this->dispatch('ProductPriceUpdated', [
            'orderDetailId' => $this->orderDetailId,
            'newPrice'      => $this->product_price,
        ]);

        session()->flash('success', 'تم تحديث سعر الشحنة بنجاح');
    }

    public function render()
    {
        return view('livewire.admin.reports.update-product-price');
    }
}
