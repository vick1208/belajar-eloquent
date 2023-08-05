<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Wallet;
use Database\Seeders\CustomerSeeder;
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
        $this->seed([CustomerSeeder::class,WalletSeeder::class,VirtualAccountSeeder::class]);

        $customer = Customer::query()->find("VIC");

        assertNotNull($customer);

        $virtualAccount = $customer->virtualAccount;
        assertNotNull($virtualAccount);

        assertEquals("Mandiri",$virtualAccount->bank);
    }
}
