<?php
namespace App\Livewire\Admin\Reports;

use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\Admin\ReportsInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierReportFilter extends Component
{
    use WithPagination;

    public $supplier_id;
    public $status_id;
    public $date1;
    public $date2;
    public $total;
    public $allStatus;
    public $notes   = [];
    public $filters = [];
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['filterSubmitted' => 'loadReports'];

    public function loadReports($validated)
    {
        $this->filters  = $validated;
        $this->date1    = $validated['date1'];
        $this->date2    = $validated['date2'];
        if (Cache::has('statuses'))
        {
            $this->allStatus = Cache::get('statuses');
        } else
        {
            $this->allStatus = Cache::rememberForever('statuses', function ()
            {
                return Status::select('id', 'name')->where('id', '!=', 1)->get();
            });
        }

        $this->resetPage();
    }



    public function update_notes($id,ReportsInterface $reportService)
    {
        // $poduct         = $reportService->UpdateNote($this->filters,$id,$this->notes);
        $note = $this->notes[$id] ?? null;
        // dd($this->filters);
        $reportService->UpdateNote($this->filters, $id, $note);

        session()->flash('success', 'تم تعديل الملاحظات بنجاح');
    }



    public function render()
    {
        $reports = new LengthAwarePaginator([], 0, 5);
        $total   = 0;

        if (!empty($this->filters))
        {
            $reportService  = app(ReportsInterface::class);
            $result         = $reportService->getSupplierReports($this->filters);


            $reports = $result['reports']; // ← هنا Paginator جاهز
            $this->total   = $result['total'];

            // dd($this->total);
        }

        return view('livewire.admin.reports.supplier-report-filter', [
            'reports'   => $reports,
            'total'     => $this->total,
            'notes'     => $this->notes
        ]);
    }
}
