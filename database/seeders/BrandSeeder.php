<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            [
                'name' => 'Lancôme',
                'image_url'=>'/media/brands/lancôme.png'
            ],
            [
                'name'=>'Ellis Brooklyn',
                'image_url'=>'/media/brands/ellis_brooklyn.png'
            ],
            [
                'name'=>'Tom Ford',
                'image_url'=>'/media/brands/tom_ford.png'

            ],
            [
                'name'=>'Krigler',
                'image_url'=>'/media/brands/Krigler.png'
            ],
            [
                'name'=>'Biotherm',
                'image_url'=>'/media/brands/biotherm.png'
            ],
            [
                'name'=>'Nuxe',
                'image_url'=>'/media/brands/nuxe.png'
            ]
        ]);
    }
}
