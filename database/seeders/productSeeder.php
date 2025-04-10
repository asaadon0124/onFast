<?php

use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                [
                    'resever_name' => 'احمد سعدون علي',
                    'resver_phone' => 741485285,
                    'supplier_id' => 1,
                    'city_id' => 1,
                    'adress' => '6 شارع علي مبارك ',
                    'product_price' => 450,
                    'total_price' => 500,
                    'shipping_price' => 50,
                    'status_id' => 1,
                    'package_number' => 12345678,
                    'notes' => 'تم تسجيل الشحنة في المخزن بنجاح',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'rescive_date' => date('Y-m-d'),
                ],
                [
                    'resever_name' => 'محمد عمر امير',
                    'resver_phone' => 64581289,
                    'supplier_id' => 2,
                    'city_id' => 2,
                    'adress' => '15 شارع محمد حسن من شارع الفاتح',
                    'product_price' => 350,
                    'total_price' => 400,
                    'shipping_price' => 50,
                    'status_id' => 1,
                    'package_number' => 987456123,
                    'notes' => 'تم تسجيل الشحنة في المخزن بنجاح',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'rescive_date' => date('Y-m-d'),
                ],
                [
                    'resever_name' => 'مازن محمد امير',
                    'resver_phone' => 784512586,
                    'supplier_id' => 2,
                    'city_id' => 2,
                    'adress' => '15 شارع  مراد الخولي من شارع الصاغة',
                    'product_price' => 150,
                    'total_price' => 250,
                    'shipping_price' => 100,
                    'status_id' => 1,
                    'package_number' => 89865656,
                    'notes' => 'تم تسجيل الشحنة في المخزن بنجاح',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'rescive_date' => date('Y-m-d'),
                ],
                [
                    'resever_name' => 'مروان ممدوح احمد',
                    'resver_phone' => 85522158,
                    'supplier_id' => 2,
                    'city_id' => 3,
                    'adress' => '10 شارع   المامون البحري من شارع الفاتح',
                    'product_price' => 700,
                    'total_price' => 800,
                    'shipping_price' => 100,
                    'status_id' => 1,
                    'package_number' => 7841212156,
                    'notes' => 'تم تسجيل الشحنة في المخزن بنجاح',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'rescive_date' => date('Y-m-d'),
                ],
                [
                    'resever_name' => 'طاهر ممدوح احمد',
                    'resver_phone' => 885566611,
                    'supplier_id' => 1,
                    'city_id' => 4,
                    'adress' => '28 شارع    الصفا و المروة من شارع الجلاء',
                    'product_price' => 300,
                    'total_price' => 350,
                    'shipping_price' => 50,
                    'status_id' => 1,
                    'package_number' => 89797974645,
                    'notes' => 'تم تسجيل الشحنة في المخزن بنجاح',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'rescive_date' => date('Y-m-d'),
                ],

            ]);
    }
}
