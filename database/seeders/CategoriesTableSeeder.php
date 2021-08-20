<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    static $categories = [
        'Computer',
        'TV',
        'Devices',
        //...
    ];
    // ...

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $count= 1;
        foreach (self::$categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'sort_order' => $count++
            ]);

        }
    }
}
