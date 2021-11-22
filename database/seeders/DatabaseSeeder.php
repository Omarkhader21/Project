<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement("DELETE FROM products");
//        DB::statement("ALTER TABLE products AUTO_INCREMENT=1");
//        DB::statement("DELETE FROM categories");
//        DB::statement("ALTER TABLE categories AUTO_INCREMENT=1");

        // \App\Models\User::factory(10)->create();
//        Category::factory(6)->create();
//        Product::factory(22)->create();

         DB::statement("DELETE FROM sales");
         DB::statement("ALTER TABLE sales AUTO_INCREMENT=1");


    }
}
