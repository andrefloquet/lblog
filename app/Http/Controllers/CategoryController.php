<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category as CategoryResource;
use App\Models\User;
use App\Models\Category;

class CategoryController extends Controller
{
	public function store(Request $request) 
	{
		$category = new Category;
		$category->name = $request->name;
		$category->user()->associate($request->user());
		$category->save();

		return new CategoryResource($category);
	}
		
	public function index(Request $request) 
	{
		return CategoryResource::collection(Category::all());
	}

	public function show(Category $category) 
	{
		return new CategoryResource($category);
	}

	public function update(Request $request, Category $category) 
	{
		$category->name = $request->name;
		$category->save();
		return new CategoryResource($category);
	}

	public function destroy(Category $category) 
	{
		$category->delete();
		return response(null, 204);
	}
}
