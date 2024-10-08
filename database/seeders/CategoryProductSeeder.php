<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryProduct::create([
            'name' => 'Tools',
        ]);

        CategoryProduct::create([
            'name' => 'Foot Wear',
        ]);

        CategoryProduct::create([
            'name' => 'shirt',
        ]);
    }
}
