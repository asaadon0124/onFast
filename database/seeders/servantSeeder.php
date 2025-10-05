<?php


use Illuminate\Database\Seeder;

class servantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servants')->insert(
            [
                [
                    'name' => 'ahmed',
                    'adress' => 'admin@app.com',
                    'phone' => 45125485,
                    'age' => 28,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'mohamed',
                    'adress' => 'agency@app.com',
                    'phone' => 45124512,
                    'age' => 25,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'), 
                ],
            ]);
    }
}
