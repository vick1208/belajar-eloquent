<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
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
            self::assertEquals('product', $comment->commentable_type);
            self::assertEquals($product->id, $comment->commentable_id);
        }
    }
    public function testOneOfManyPolymorphic()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, CommentSeeder::class]);

        $product = Product::find("1");
        self::assertNotNull($product);
        $comment = $product->latestComment;
        self::assertNotNull($comment);
        $comment = $product->oldestComment;
        self::assertNotNull($comment);
    }
    public function testManyToManyPolymorphic()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, TagSeeder::class]);

        $product = Product::find("1");
        $tags = $product->tags;
        self::assertNotNull($tags);
        self::assertCount(1, $tags);

        foreach ($tags as $tag) {
            self::assertNotNull($tag->id);
            self::assertNotNull($tag->name);

            $vouchers = $tag->vouchers;
            self::assertNotNull($vouchers);
            self::assertCount(1, $vouchers);
        }
    }
    public function testEloquentCollection()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        # 2 product 1,2
        $products = Product::query()->get();
        # WHERE id IN (1,2)
        $product = $products->toQuery()->where("price", 200)->get();

        self::assertNotNull($product);
        self::assertEquals("2", $product[0]->id);
    }

    public function testSerializale()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $products = Product::query()->get();
        self::assertCount(2, $products);

        $json = $products->toJson(JSON_PRETTY_PRINT);

        Log::info($json);
    }
    public function testSerializaleRelation()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, ImageSeeder::class]);

        $products = Product::query()->get();
        $products->load(["category", "image"]);
        self::assertCount(2, $products);

        $json = $products->toJson(JSON_PRETTY_PRINT);

        Log::info($json);
    }
}
