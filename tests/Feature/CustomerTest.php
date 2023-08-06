<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Wallet;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\VirtualAccountSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class CustomerTest extends TestCase
{
    public function testOneToOne()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class]);

        $customer = Customer::query()->find("VIC");
        assertNotNull($customer);
        $wallet = $customer->wallet;
        assertNotNull($wallet);

        assertEquals(1_000_000, $wallet->amount);
    }

    public function testOneToOneQuery()
    {
        $customer = new Customer();
        $customer->id = "VIC";
        $customer->name = "Vicky";
        $customer->email = "Vicky@example.com";
        $customer->save();

        $wallet = new Wallet();
        $wallet->amount = 1000;


        $customer->wallet()->save($wallet);

        assertNotNull($wallet->customer_id);
    }

    public function testHasOneThrough()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class, VirtualAccountSeeder::class]);

        $customer = Customer::query()->find("VIC");

        assertNotNull($customer);

        $virtualAccount = $customer->virtualAccount;
        assertNotNull($virtualAccount);

        assertEquals("Mandiri", $virtualAccount->bank);
    }

    public function testManyToMany()
    {
        $this->seed([CustomerSeeder::class, CategorySeeder::class, ProductSeeder::class]);

        $customer = Customer::query()->find("VIC");
        self::assertNotNull($customer);

        $customer->likeProducts()->attach("1");

        $products = $customer->likeProducts;
        self::assertCount(1, $products);

        self::assertEquals("1", $products[0]->id);
    }
    public function testDetachManyToMany()
    {
        $this->testManyToMany();

        $customer = Customer::query()->find("VIC");
        $customer->likeProducts()->detach("1");

        $products = $customer->likeProducts;
        self::assertCount(0, $products);
    }
}
