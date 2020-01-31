<?php

use Illuminate\Database\Seeder;

class CategoriesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array([
            'id' => 1,
            'name' => 'Electronics',
        ],[
            'id' =>2,
            'name' => 'Phones',
        ]);

        DB::table('categories')->insert($categories);
    }
}
