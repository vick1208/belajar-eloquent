<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Insert satu data
        // $product = new Product();
        // $product->id = "1";
        // $product->name = 'Product 1';
        // $product->description = 'Description Anything 1';
        // $product->category_id = 'FOOD';
        // $product->save();


        // Insert beberapa baris

        $products = [];

        for ($i=1; $i <= 9; $i++) {
         $products[] = [
            "id" => "{$i}",
            "name" => "Product {$i}",
            "description" => "Description Anything {$i}",
            "category_id" => "ANIME"
         ];
        }

        Product::insert($products);



    }
}
