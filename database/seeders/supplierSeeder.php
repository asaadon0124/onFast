<?php

use Illuminate\Database\Seeder;

class supplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert(
            [
                [
                    'name' => 'ابو جودي',
                    'adress' => 'admin@app.com',
                    'phone' => 451241233,
                    'city_id' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'احمد السيد',
                    'adress' => 'agency@app.com',
                    'phone' => 774556622,
                    'city_id' => 4,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'), 
                ],
            ]);
    }
}
