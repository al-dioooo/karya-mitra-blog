<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('livewire.footer', compact('categories'));
    }
}
