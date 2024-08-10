<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryProductResource;
use App\Service\CategoryProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{

    protected $categoryProductService;

    public function __construct(CategoryProductService $categoryProductService) {
        $this->categoryProductService = $categoryProductService;
    }

    public function index() {
        $categoryProducts = $this->categoryProductService->getAll();
        return CategoryProductResource::collection($categoryProducts);
    }

    public function show($id) {
        $categoryProduct = $this->categoryProductService->getOne($id);
        return new CategoryProductResource($categoryProduct);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $categoryProduct = $this->categoryProductService->create($request);
        
        return new CategoryProductResource($categoryProduct);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $categoryProduct = $this->categoryProductService->update($request, $id);
        return new CategoryProductResource($categoryProduct);
    }

    public function delete($id) {
        $this->categoryProductService->delete($id);
        return response()->json(['message' => 'success'], 200);
    }
}
