<?php

use Illuminate\Database\Seeder;

class Product_detailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_details = array(
            [
            'product_id' => '1',
            'quantity'  => '5',
            'price'  => '150'
            ],
            [
                'product_id' => '2',
                'quantity'  => '7',
                'price'  => '1500'
            ],
            [
                'product_id' => '3',
                'quantity'  => '2',
                'price'  => '500'
            ]
        );

        DB::table('product_details')->insert($product_details);
    }
}
