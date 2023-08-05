<?php

namespace Tests\Feature;

use App\Models\Customer;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class CustomerTest extends TestCase
{
    public function testOneToOne(){
        $this->seed([CustomerSeeder::class,WalletSeeder::class]);

        $customer = Customer::query()->find("VIC");
        assertNotNull($customer);
        $wallet = $customer->wallet;
        assertNotNull($wallet);

        assertEquals(1_000_000,$wallet->amount);
    }
}
