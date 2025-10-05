<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Status;
use App\Models\Product;
use App\Models\Reserve;
use Livewire\Component;
use App\Models\ReserveOrder;
use App\Models\OrderDetailes;
use Illuminate\Support\Facades\DB;
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


        if ($this->orderDetailId)
        {
            $orderDetailes  = OrderDetailes::withTrashed()->with('product','order')->findOrFail($this->orderDetailId);
            $oldStatus      = $orderDetailes->product_status;
            $newStatus      = $this->currentStatus;

            // Mapping table for status transitions
            $statusMap =
            [
                2 =>
                [
                    3 => ['type' => 0, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1], 'delete' => true],
                    4 => ['type' => 0, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1], 'delete' => true],
                    5 => ['type' => 1, 'returns' => 0, 'order' => null, 'delete' => true],
                    6 => ['type' => 1, 'returns' => 0, 'order' => null, 'delete' => true, 'reserve' => true],
                    7 => ['type' => 2, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1], 'delete' => true],
                ],
                3 =>
                [
                    2 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1], 'restore' => true],
                    4 => ['type' => 0, 'returns' => 1, 'order' => null, 'profit' => 0, 'delete' => true],
                    5 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1]],
                    6 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1], 'reserve' => true],
                    7 => ['type' => 2, 'returns' => 1, 'order' => null, 'delete' => true],
                ],
                4 =>
                [
                    2 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1], 'restore' => true],
                    3 => ['type' => 0, 'returns' => 1, 'order' => null, 'delete' => true],
                    5 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1]],
                    6 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1], 'reserve' => true],
                    7 => ['type' => 2, 'returns' => 1, 'order' => null],
                ],
                5 =>
                [
                    2 => ['type' => 1, 'returns' => 0, 'order' => null, 'restore' => true],
                    3 => ['type' => 0, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1]],
                    4 => ['type' => 0, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1]],
                    6 => ['type' => 1, 'returns' => 0, 'order' => null, 'reserve' => true],
                    7 => ['type' => 2, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1]],
                ],
                6 =>
                [
                    2 => ['type' => 1, 'returns' => 0, 'order' => null, 'restore' => true],
                    3 => ['type' => 0, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1]],
                    4 => ['type' => 0, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1]],
                    5 => ['type' => 1, 'returns' => 0, 'order' => null],
                    7 => ['type' => 2, 'returns' => 1, 'order' => ['total_prices' => -1, 'total_shipping' => -1], 'reserve' => true],
                ],
                7 =>
                [
                    2 => ['type' => 1, 'returns' => 0, 'order' => null, 'restore' => true],
                    3 => ['type' => 0, 'returns' => 1, 'order' => null, 'delete' => true],
                    4 => ['type' => 0, 'returns' => 1, 'order' => null, 'profit' => 0, 'delete' => true],
                    5 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1]],
                    6 => ['type' => 1, 'returns' => 0, 'order' => ['total_prices' => 1, 'total_shipping' => 1], 'reserve' => true],
                ],
            ];


            if (!isset($statusMap[$oldStatus][$newStatus]))
            {
                return response()->json(['status' => false, 'msg' => 'يجب اختيار الحالة بشكل صحيح']);
            }


            $action = $statusMap[$oldStatus][$newStatus];


            try
            {
                DB::beginTransaction();

                      // Update orderDetailes
                    $orderDetailes->update(['product_status' => $newStatus] + ($action['profit'] ?? []));
                    if (!empty($action['delete']))
                    {
                        $orderDetailes->delete();
                    }

                    if (!empty($action['restore']))
                    {
                        $orderDetailes->restore();
                    }


                    // Update order totals
                    if (!empty($action['order']))
                    {
                        $order = $orderDetailes->order;
                        foreach ($action['order'] as $key => $multiplier)
                        {
                            $order->$key += $multiplier * ($key == 'total_prices' ? $orderDetailes->total_price : $orderDetailes->shipping_price);
                        }
                        $order->save();

                        // dd($orderDetailes);
                    }


                        // Handle reserves if needed
                        if (!empty($action['reserve']))
                        {
                            $this->handleReserve($orderDetailes, $newStatus);
                        }


                        // Update product
                        $orderDetailes->product->update(
                        [
                            'type'      => $action['type'],
                            'returns'   => $action['returns'],
                            'status_id' => $newStatus
                        ]);

                        // dd($orderDetailes->product->product_price);
                        if (!empty($action['restore']))
                        {
                            $orderDetailes->product->restore();
                        }

                         // بعد تحديث order totals
                        $this->dispatch('OrderDeailesStatusUpdated',
                        [
                            'orderDetailId' => $orderDetailes->id,
                            'productPrice'    => $orderDetailes->product->product_price,
                        ]);

                    DB::commit();




                    return response()->json(
                    [
                        'status' => true,
                        'status_name' => $orderDetailes->status->name,
                        'status_date_update' => $orderDetailes->updated_at,
                        'msg' => 'تم تعديل حالة الشحنة بنجاح',
                    ]);
                } catch (\Throwable $th)
                {
                    DB::rollback();
                    dd($th);
                    return response()->json([
                        'status' => false,
                        'msg' => 'حدث خطأ أثناء التحديث: ' . $th->getMessage()
                    ]);
                }





        }

        $this->lastUpdate = now()->format('d/m/Y');
        session()->flash('success', 'تم تحديث الحالة بنجاح');
    }



    protected function handleReserve($orderDetailes, $status_id)
    {
        $reserves = Reserve::with('reservesDetailes')
            ->where('supplier_id', $orderDetailes->product->supplier_id)
            ->whereDate('created_at', Carbon::today()->toDateString())
            ->first();

        if ($reserves && $reserves->reservesDetailes->where('product_id', $orderDetailes->product->id)->count() > 0) {
            throw new \Exception('تم تعديل حالة الشحنة من قبل');
        }

        if (!$reserves)
        {
            $reserves = Reserve::create(['supplier_id' => $orderDetailes->product->supplier_id]);
        }

        ReserveOrder::create(
        [
            'product_id'    => $orderDetailes->product->id,
            'status_id'     => $status_id,
            'reserve_id'    => $reserves->id,
        ]);
    }



    public function render()
    {
        return view('livewire.admin.status-selector');
    }
}
