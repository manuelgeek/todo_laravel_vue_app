<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Helper;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['categories' => fractal(Category::orderByDesc('created_at')->get(), new CategoryTransformer())], 200);
    }

    public function show(Category $category): \Illuminate\Http\JsonResponse
    {
        return response()->json(['category' => fractal($category, new CategoryTransformer())], 200);
    }

    public function store(CategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $category = auth()->user()->categories()->create([
            'name' => $request->name,
            'slug' => Helper::getSlug($request->name)
        ]);
        return response()->json(['category' => fractal($category, new CategoryTransformer())], 201);
    }

    public function update(CategoryRequest $request, Category $category): \Illuminate\Http\JsonResponse
    {
        $category->update([
            'name' => $request->name,
//        no updating slug
//            'slug' => Helper::getSlug($request->name)
        ]);
        return response()->json(['category' => fractal($category, new CategoryTransformer())], 201);
    }

    public function destroy(Category $category): \Illuminate\Http\JsonResponse
    {
        $category->tasks()->delete();
        $category->delete();
        return response()->json(['message' => 'Category deleted!'], 201);
    }
}
