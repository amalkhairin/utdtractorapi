<?php

namespace App\Service;

use App\Models\CategoryProduct;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CategoryProductService {

    public function getAll() {
        return CategoryProduct::all();
    }

    public function create(Request $request) {
        $created_category_product = new CategoryProduct();
        $created_category_product->name = $request->name;
        $created_category_product->save();
        return $created_category_product;
    }

    public function update(Request $request, $id) {
        $updated_category_product = CategoryProduct::find($id);
        $updated_category_product->name = $request->name;
        $updated_category_product->save();
        return $updated_category_product;
    }

    public function getOne($id) {
        return CategoryProduct::find($id);
    }

    public function delete($id) {
        $deleted_category_product = CategoryProduct::find($id);
        $deleted_category_product->delete();
        return $deleted_category_product;
    }
}