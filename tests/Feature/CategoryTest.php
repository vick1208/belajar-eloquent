<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Scopes\IsActiveScope;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ReviewSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class CategoryTest extends TestCase
{
    public function testInsert()
    {
        $category = new Category();
        $category->id = "GAD";
        $category->name = "Gadget";
        $category->is_active = true;
        $res = $category->save();

        assertTrue($res);
    }

    public function testManyInsert()
    {
        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Name $i",
                "is_active" => true
            ];
        }

        // $res = Category::query()->insert($categories);
        $res = Category::insert($categories);

        self::assertTrue($res);

        $total = Category::count();

        assertEquals(10, $total);
    }
    public function testFind()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find("FOOD");
        self::assertNotNull($category);

        assertEquals("FOOD", $category->id);
        assertEquals("Food", $category->name);
        assertEquals("Food Category", $category->description);
    }

    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        $category =  Category::find("FOOD");
        $category->name = "Food Updated";

        $res = $category->update();

        assertTrue($res);
    }
    public function testSelect()
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->id = "ID $i";
            $category->name = "Name $i";
            $category->is_active = true;
            $category->save();
        }

        $categories = Category::whereNull("description")->get();

        assertEquals(5, $categories->count());

        $categories->each(function ($category) {
            self::assertNull($category->description);

            $category->description = "Edited";
            $category->update();
        });
    }
    public function testManyUpdate()
    {
        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Name $i",
                "is_active"=>true
            ];
        }

        $res = Category::insert($categories);

        assertTrue($res);

        Category::whereNull("description")->update([
            "description" => "Edited"
        ]);
        $total = Category::where("description", "=", "Edited")->count();
        assertEquals(10, $total);
    }
    public function testDelete()
    {
        $this->seed(CategorySeeder::class);
        $cat = Category::find("FOOD");
        $result = $cat->delete();
        self::assertTrue($result);
        $total = Category::count();

        assertEquals(0, $total);
    }
    public function testManyDelete()
    {
        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Name $i",
                "is_active" => true
            ];
        }

        $res = Category::insert($categories);
        assertTrue($res);

        $total = Category::count();
        assertEquals(10, $total);

        Category::whereNull("description")->delete();

        $total = Category::count();
        assertEquals(0, $total);
    }

    public function testCreate()
    {

        $request = [
            "id" => "FOOD",
            "name" => "Food",
            "description" => "lorem"
        ];

        $category = new Category($request);
        $category->save();
        self::assertNotNull($category->id);
    }
    public function testCreateQueryBuild()
    {

        $request = [
            "id" => "FOOD",
            "name" => "Food",
            "description" => "lorem"
        ];

        $category = Category::create($request);
        self::assertNotNull($category->id);
    }

    public function testMassUpd()
    {
        $this->seed(CategorySeeder::class);

        $request = [
            "name" => "Food Updated",
            "description" => "Food Category Updated"
        ];

        $category = Category::find("FOOD");
        $category->fill($request);
        $category->save();

        self::assertNotNull($category->id);
    }
    public function testGlobalScope()
    {
        $category = new Category();
        $category->id = "ANIME";
        $category->name = "Anime";
        $category->description = "Anime Category";
        $category->is_active = false;
        $category->save();

        $category = Category::query()->find("ANIME");
        self::assertNull($category);
        $category = Category::query()->withoutGlobalScope(IsActiveScope::class)->find("ANIME");
        self::assertNotNull($category);
    }
    public function testOneToManyCat()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::query()->find("FOOD");
        self::assertNotNull($category);

        $products = $category->products;
        self::assertNotNull($products);
        self::assertCount(2, $products);
    }

    public function testOneToManyQuery()
    {
        $category = new Category();
        $category->id = "MANGA";
        $category->name = "Manga";
        $category->description = "Manga Category";
        $category->is_active = true;
        $category->save();

        $product = new Product();
        $product->id = "1";
        $product->name = "Product 1";
        $product->description = "Description 1";

        $category->products()->save($product);

        self::assertNotNull($product->category_id);
    }

    public function testRelationshipQuery()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::find("FOOD");
        $products = $category->products;
        self::assertCount(2, $products);

        $outOfStockProducts = $category->products()->where('stock', '<=', 0)->get();
        self::assertCount(2, $outOfStockProducts);
    }
    public function testHasManyThrough()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, CustomerSeeder::class, ReviewSeeder::class]);

        $category = Category::find("FOOD");
        self::assertNotNull($category);

        $reviews = $category->reviews;
        self::assertNotNull($reviews);
        self::assertCount(2, $reviews);
    }

    public function testQueryingRelation()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::query()->find("FOOD");
        $products = $category->products()->where("price", "=", "200")->get();

        self::assertCount(1, $products);
        self::assertEquals("2", $products[0]->id);
    }
    public function testAggregateRelation()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::query()->find("FOOD");

        $total = $category->products()->count();
        self::assertEquals(2, $total);
        $total = $category->products()->where("price", "200")->count();
        self::assertEquals(1, $total);

    }
}
