<?php

namespace App\Livewire\Admin;

use App\Models\Status;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderDetailes;
use Illuminate\Support\Facades\Cache;

class StatusSelector extends Component
{
    public $productId;
    public $orderDetailId;
    public $currentStatus;
    public $lastUpdate;
    public $statuses = [];

    public function mount($productId = null, $orderDetailId = null, $currentStatus, $lastUpdate)
    {
        $this->productId        = $productId;
        $this->orderDetailId    = $orderDetailId;
        $this->currentStatus    = $currentStatus;
        $this->lastUpdate       = $lastUpdate;

        if (Cache::has('statuses'))
        {
            $this->statuses = Cache::get('statuses');
        } else
        {
            $this->statuses = Cache::rememberForever('statuses', function ()
            {
                return Status::select('id', 'name')->where('id', '!=', 1)->get();
            });
        }
    }

    public function updateStatus()
    {
        dd($this->productId);
        if ($this->productId)
        {
            Product::where('id', $this->productId)->update(['status_id' => $this->currentStatus]);
        }

        if ($this->orderDetailId)
        {
            OrderDetailes::where('id', $this->orderDetailId)->update(['status_id' => $this->currentStatus]);
        }

        $this->lastUpdate = now()->format('d/m/Y');

        session()->flash('success', 'تم تحديث الحالة بنجاح');
    }


    public function render()
    {
        return view('livewire.admin.status-selector');
    }
}
