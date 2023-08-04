<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class VoucherTest extends TestCase
{
    public function testInsertVoucher()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample";
        $voucher->voucher_code = "123455557777";
        $voucher->save();

        self::assertNotNull($voucher->id);
    }
    public function testInsertVoucherUuid()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample";
        $voucher->save();

        self::assertNotNull($voucher->id);
        self::assertNotNull($voucher->voucher_code);
    }
    public function testSoftDeletes()
    {
        $this->seed(VoucherSeeder::class);

        $voucher = Voucher::where("name", "=", "Test Voucher")->first();
        $voucher->delete();

        $voucher = Voucher::where("name", "=", "Test Voucher")->first();
        self::assertNull($voucher);

        $voucher = Voucher::withTrashed()->where("name", "=", "Test Voucher")->first();
        self::assertNotNull($voucher);
    }
    public function testLocalScope()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample";
        $voucher->is_active = true;
        $voucher->save();

        $total = Voucher::query()->active()->count();
        assertEquals(1, $total);
        $total = Voucher::query()->notActive()->count();
        assertEquals(0, $total);
    }
}
