<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    public function testEmployeeFactory(){
        $employee1 = Employee::factory()->programmer()->make();
        $employee1->id = "1";
        $employee1->name = "Employee #1";
        $employee1->save();

        self::assertNotNull(Employee::query()->where('id','1')->first());

        $employee2 = Employee::factory()->seniorProgrammer()->create([
            'id' => '2',
            'name' => 'Employee #2'
        ]);
        self::assertNotNull($employee2);
        self::assertNotNull(Employee::query()->where('id','2')->first());
    }
}
