<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\VoucherSeeder;
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
        self::assertEquals("FOOD", $category->id);
    }

    public function testHasOneOfMany()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::query()->find("FOOD");

        self::assertNotNull($category);

        $low = $category->lowestPrice;
        self::assertNotNull($low);
        self::assertEquals("1", $low->id);

        $high = $category->highestPrice;
        self::assertNotNull($high);
        self::assertEquals("2", $high->id);
    }

    public function testOneToOnePolymorphicProduct()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, ImageSeeder::class]);

        $product = Product::find("1");
        self::assertNotNull($product);

        $image = $product->image;
        self::assertNotNull($image);

        self::assertEquals("https://www.example.com/image/gamma.png", $image->url);
    }
    public function testOneToManyPolymorphicProduct()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, CommentSeeder::class]);

        $product = Product::find("1");
        self::assertNotNull($product);

        $comments = $product->comments;
        foreach ($comments as $comment) {
            self::assertEquals(Product::class, $comment->commentable_type);
            self::assertEquals($product->id, $comment->commentable_id);
        }
    }
}
