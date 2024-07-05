<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('types')->get();
        return response()->json($categories);
    }
    public function show($id)
    {
        $category = Category::with('types')->find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

      
        $category = Category::create(['name' => $request->name]);

        return response()->json($category, 201);
    }

    
    public function addType(Request $request, $categoryId)
    {
       

      
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $type = $category->types()->create(['name' => $request->name]);

        return response()->json($type, 201);
    }
}
