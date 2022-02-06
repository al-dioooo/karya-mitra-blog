<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(5);

        $data = [
            'category' => $category
        ];

        return view('guest.category.index', $data);
    }

    public function show(Category $category)
    {
        $post = $category->posts()->where('is_published', 1)->paginate(14);

        $data = [
            'category' => $category,
            'post' => $post
        ];

        return view('guest.category.show', $data);
    }
}
