<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert satu baris

        // $category = new Category();
        // $category->id = "FOOD";
        // $category->name = "Food";
        // $category->description = "Food Category";
        // $category->is_active = true;
        // $category->save();


        // Insert beberapa baris

        $categories = [
            ["id" => "FOOD", "name" => "Food", "description" => "Food Category","is_active"=>true],
            ["id" => "ANIME", "name" => "Anime", "description" => "Anime Category","is_active"=>true],
            ["id" => "MANGA", "name" => "Manga", "description" => "Manga Category","is_active"=>true],
        ];

        Category::insert($categories);


    }
}
