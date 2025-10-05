<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveriesOrders extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
   

   


    public function render()
    {
        return view('livewire.deliveries-orders',
        [
            'from'      => '2024-12-01',
            'to'        => Carbon::now(),
            'orders'    => Order::onlyTrashed()->with('orders_detailes')->orderBy('created_at', 'DESC')->search($this->search)->limit(300)->paginate($this->perPage),
        ]);
    }
}
