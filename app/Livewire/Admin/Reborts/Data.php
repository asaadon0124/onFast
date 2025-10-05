<?php

namespace App\Livewire\Admin\Reborts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Interfaces\Admin\ReportsInterface;
use App\Http\Requests\supplierRebortsRequest;

class Data extends Component
{
    public $suppliers;
    public $status;
    public $supplier_id;
    public $status_id;
    public $date1;
    public $date2;

    // use WithPagination;

    public $hasReports = false;


    public function mount(ReportsInterface $reportService)
    {
        $data = $reportService->index();

        $this->suppliers = $data['suppliers'];
        $this->status    = $data['status'];
    }


    public function submit()
    {
        $validated = $this->validate((new supplierRebortsRequest())->rules(), (new supplierRebortsRequest())->messages());
        // dd($validated);

        // نعمل emit للأحداث ونبعت البيانات للكومبوننت التاني
        $this->dispatch('filterSubmitted',$validated);

        $this->hasReports = true;
    }


    public function render()
    {
        return view('livewire.admin.reborts.data');
    }
}
