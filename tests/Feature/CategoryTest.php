<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
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
        $res = $category->save();

        assertTrue($res);
    }

    public function testManyInsert()
    {
        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Name $i"
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

        $category = Category::find("FASH");
        self::assertNotNull($category);

        assertEquals("FASH", $category->id);
        assertEquals("Fashion", $category->name);
        assertEquals("Fashion Category", $category->description);
    }

    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        $category =  Category::find("FASH");
        $category->name = "Fashion Updated";

        $res = $category->update();

        assertTrue($res);
    }
    public function testSelect()
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->id = "ID $i";
            $category->name = "Name $i";
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
                "name" => "Name $i"
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
        $cat = Category::find("FASH");
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
                "name" => "Name $i"
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
}
