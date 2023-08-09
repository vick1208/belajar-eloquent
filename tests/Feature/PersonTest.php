<?php

namespace Tests\Feature;

use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonTest extends TestCase
{
    public function testPersonName()
    {
        $person = new Person();
        $person->first_name = "Eko";
        $person->family_name = "Soegianto";
        $person->save();

        self::assertEquals("EKO Soegianto",$person->full_name);

        $person->full_name = "Joko Wiranto";
        $person->save();
        self::assertEquals("JOKO",$person->first_name);
        self::assertEquals("Wiranto",$person->family_name);
    }
    public function testAttCasts(){
        $person = new Person();
        $person->first_name = "Eko";
        $person->family_name = "Soegianto";
        $person->save();

        self::assertNotNull($person->created_at);
        self::assertNotNull($person->updated_at);
        self::assertInstanceOf(Carbon::class,$person->created_at);
        self::assertInstanceOf(Carbon::class,$person->updated_at);
    }
}
