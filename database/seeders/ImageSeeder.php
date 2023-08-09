<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $img = new Image();
            $img->url = "https://www.example.com/image/alpha.png";
            $img->imageable_id = "VIC";
            $img->imageable_type = 'customer';
            $img->save();

            $img = new Image();
            $img->url = "https://www.example.com/image/gamma.png";
            $img->imageable_id = "1";
            $img->imageable_type = 'product';
            $img->save();
        }
    }
}
