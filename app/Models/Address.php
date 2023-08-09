<?php

namespace App\Models;

class Address
{
    public string $street;
    public string $city;
    public string $province;
    public string $postal_code;

    public function __construct(string $street, string $city, string $province, string $postal_code)
    {
        $this->street = $street;
        $this->city = $city;
        $this->province = $province;
        $this->postal_code = $postal_code;
    }
}
