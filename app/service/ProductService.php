<?php

namespace App\Service;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProductService {

    public function getAll() {
        return $products = Product::with('category')->get();
    }

    public function create(Array $request) {
        $created_product = new Product();
        $created_product->name = $request['name'];
        $created_product->product_category_id = $request['product_category_id'];
        $created_product->price = $request['price'];
        $created_product->image = $request['image'];
        $created_product->save();
        return $created_product;
    }

    public function update(Array $request, $id) {
        $updated_product = Product::find($id);
        $updated_product->name = $request['name'];
        $updated_product->product_category_id = $request['product_category_id'];
        $updated_product->price = $request['price'];
        $updated_product->image = $request['image'];
        $updated_product->save();
        return $updated_product;
    }

    public function getOne($id) {
        return Product::with('category')->findOrFail($id);
    }

    public function delete($id) {
        $deleted_product = Product::find($id);
        $deleted_product->delete();
        return $deleted_product;
    }
}