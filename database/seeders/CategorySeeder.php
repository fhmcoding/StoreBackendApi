<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'name' => 'Perfume',
                'image_url'=>'/media/categories/perfume.png'
            ],
            [
                'name'=>'Eau de Perfume',
                'image_url'=>'/media/categories/eau_de_perfume.png'
            ],
            [
                'name'=>'Eau de Toilette',
                'image_url'=>'/media/categories/eau_de_toilette.png'

            ],
            [
                'name'=>'Eau de Cologne',
                'image_url'=>'/media/categories/eau_de_cologne.png'
            ],
            [
                'name'=>'Eau Fraiche',
                'image_url'=>'/media/categories/eau_fraiche.png'
            ]
        ]);
    }
}
