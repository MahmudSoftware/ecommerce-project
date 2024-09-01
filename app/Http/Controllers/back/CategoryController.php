<?php

namespace App\Http\Controllers\back;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $formData = $request->validated();
        $formData['slug'] = Helpers::generateSlug($formData['name']);
        Category::create($formData);
        return response()->json('Category Created Successfully');
    }
}
