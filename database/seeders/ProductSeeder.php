<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryIds = CategoryProduct::pluck('id');

        Product::create([
            'product_category_id' => $categoryIds->random(),
            'name' => 'Lemari',
            'price' => 150000,
            'image' => 'lemari.jpg',
        ]);

        Product::create([
            'product_category_id' => $categoryIds->random(),
            'name' => 'Baju Renang',
            'price' => 200000,
            'image' => 'baju_renang.jpg',
        ]);

        Product::create([
            'product_category_id' => $categoryIds->random(),
            'name' => 'Sepatu Lari',
            'price' => 180000,
            'image' => 'sepatu_lari.jpg',
        ]);
    }
}
