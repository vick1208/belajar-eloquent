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

        for ($i=0; $i < 10; $i++) { 
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
    public function testFind() {
        $this->seed(CategorySeeder::class);

        $category = Category::find("FASH");
        self::assertNotNull($category);

        assertEquals("FASH",$category->id);
        assertEquals("Fashion",$category->name);
        assertEquals("Fashion Category",$category->description);
    }
}
