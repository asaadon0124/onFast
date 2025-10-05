<?php

namespace App\Services\Admin;

use App\Models\Status;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\OrderDetailes;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Admin\ReportsInterface;

class ReportsService implements ReportsInterface
{
    public function index()
    {
        $suppliers      = Supplier::select('id', 'name')->get();
        $status         = Status::select('id', 'name')->get();
        return
        [
            'suppliers' => $suppliers,
            'status'    => $status
        ];
    }


    public function getSupplierReports($data, $filter = null)
    {
        $supplier = Supplier::find($data['supplier_id']);

        if (!$supplier)
        {
            return
            [
                'total'     => 0,
                'reports'   => collect()
            ]; // لو المورد مش موجود
        }

        // الشرط الأول: حالة الشحنة = 1
        if ($data['status_id'] == 1)
        {
            $query = $supplier->products()->with(['supplier', 'cities.governorate', 'status'])->where('status_id', 1);

            // لو في تواريخ
            if (!empty($data['date1']) && !empty($data['date2']))
            {
                $query->whereDate('products.created_at', '>=', $data['date1'])->whereDate('products.created_at', '<=', $data['date2']);
            }


            $totalQuery = (clone $query);
            $total      = $totalQuery->sum('product_price'); // هنا لأن الحقل موجود في order_detailes

        } else
        {
            $lastOrderDetails = DB::table('order_detailes')
                ->selectRaw('MAX(id) as id')
                ->where('product_status', $data['status_id']) // فلترة على الحالة المطلوبة
                ->groupBy('product_id');

            $query = $supplier->orderDetailes()
                ->with(['product.supplier', 'product.cities.governorate', 'status', 'order.servant'])
                ->whereIn('order_detailes.id', $lastOrderDetails); // هنا هيرجع آخر id لنفس الحالة المطلوبة

            // لو في تواريخ
            if (!empty($data['date1']) && !empty($data['date2']))
            {
                $query->whereDate('order_detailes.created_at', '>=', $data['date1'])
                    ->whereDate('order_detailes.created_at', '<=', $data['date2']);
            }

            $totalQuery = (clone $query);
            $total = $totalQuery->sum('product_price'); // هنا لأن الحقل موجود في order_detailes


        }

        $reports = $query->paginate(5);

        return
        [
            'reports' => $reports,
            'total'   => $total
        ];
    }



    // public function find($data, $id)
    // {
    //     // استدعاء الخدمة
    //     $result = $this->getSupplierReports($data);

    //     // جبت التقارير
    //     $reports = $result['reports'];

    //     // دلوقتي تقدر تجيب شحنة واحدة بالـ id
    //     $product = $reports->where('id', $id)->first();
    //     return $product;
    // }



    // public function find($id)
    // {
    //     return $product = OrderDetailes::with(['product.supplier','product.cities.governorate','status','order.servant'])->withTrashed()
    //             ->find($id);
    // }


    public function UpdateNote($data,$id,$notes)
    {

        try
        {
            DB::beginTransaction();

            OrderDetailes::where('id', $id)->update(['notes' => $notes]);

            $product = OrderDetailes::with(['product' => function($query)
            {
                $query->withTrashed();
            }])->withTrashed()->find($id);

            $product->notes = $notes;
            $product->save();

            if ($product && $product->product_id)
            {
                // dd('yes');
                Product::where('id', $product->product_id)->update(['notes' => $notes]);
            }

        // dd($product);

            DB::commit();

            return $product;

        } catch (\Throwable $th)
        {
            // throw $th;
            DB::rollBack();
        }

    }
}
