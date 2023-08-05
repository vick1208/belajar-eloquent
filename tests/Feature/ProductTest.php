<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testOneToManyPro()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $product = Product::find("1");
        self::assertNotNull($product);

        $category = $product->category;
        self::assertNotNull($category);
        self::assertEquals("FOOD",$category->id);


    }

    public function testHasOneOfMany(){
        $this->seed([CategorySeeder::class,ProductSeeder::class]);

        $category = Category::query()->find("FOOD");

        self::assertNotNull($category);

        $low = $category->lowestPrice;
        self::assertNotNull($low);
        self::assertEquals("1",$low->id);

        $high = $category->highestPrice;
        self::assertNotNull($high);
        self::assertEquals("2",$high->id);

    }
}
