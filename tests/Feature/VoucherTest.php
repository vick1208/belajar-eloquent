<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VoucherTest extends TestCase
{
    public function testInsertVoucher()  {
        $voucher = new Voucher();
        $voucher->name = "Sample";
        $voucher->voucher_code="123455557777";
        $voucher->save();

        self::assertNotNull($voucher->id);
    }
    public function testInsertVoucherUuid()  {
        $voucher = new Voucher();
        $voucher->name = "Sample";
        $voucher->save();

        self::assertNotNull($voucher->id);
        self::assertNotNull($voucher->voucher_code);
    }
}
