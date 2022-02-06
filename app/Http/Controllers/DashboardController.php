<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $post = Post::all()->count();
        $category = Category::all()->count();
        $user = User::all()->count();

        $data = [
            'post' => $post,
            'category' => $category,
            'user' => $user
        ];

        return view('dashboard', $data);
    }
}
