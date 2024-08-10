<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Service\CategoryProductService;
use App\Service\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryProductService;

    public function __construct(ProductService $productService, CategoryProductService $categoryProductService) {
        $this->productService = $productService;
        $this->categoryProductService = $categoryProductService;
    }
    public function index() {
        return $products = $this->productService->getAll();
        return ProductResource::collection($products);
    }

    public function show($id) {
        $product = $this->productService->getOne($id);
        return new ProductResource($product);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category_product = $this->categoryProductService->getOne(intval($request->product_category_id));
        
        if (!$category_product) {
            return response()->json(['message' => 'Category product not found'], 404);
        }

        $req = $request->only('name', 'price', 'product_category_id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $image_name);
            $req['image'] = $path;
        }



        $product = $this->productService->create($req);
        return new ProductResource($product);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $product = $this->productService->getOne($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $category_product = $this->categoryProductService->getOne(intval($request->product_category_id));
        
        if (!$category_product) {
            return response()->json(['message' => 'Category product not found'], 404);
        }

        $req = $request->only('name', 'price', 'product_category_id');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $image_name);
            $req['image'] = $path;
        }



        $product = $this->productService->update($req, $id);
        return new ProductResource($product);


    }

    public function delete($id) {
        $this->productService->delete($id);
        return response()->json(['message' => 'success'], 200);
    }
}
