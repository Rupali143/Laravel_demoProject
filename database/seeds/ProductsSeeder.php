<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            [
                'id' => 1,
            'name' => 'Soap',
            'category' => 'Godrej',
            ],
            [
                'id' => 2,
                'name' => 'Dairy',
                'category' => 'solid',
            ],
            [
                'id' => 3,
                'name' => 'Dairy',
                'category' => 'liquid',
            ]
        );
        DB::table('products')->insert($products);
    }
}
