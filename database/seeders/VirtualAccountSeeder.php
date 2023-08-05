<?php

namespace Database\Seeders;

use App\Models\VirtualAccount;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VirtualAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wallet = Wallet::query()->where("customer_id", "VIC")->firstOrFail();

        $virtualAccount = new VirtualAccount();
        $virtualAccount->bank = "Mandiri";
        $virtualAccount->va_number = "121256565653651365316";
        $virtualAccount->wallet_id = $wallet->id;
        $virtualAccount->save();

    }
}
