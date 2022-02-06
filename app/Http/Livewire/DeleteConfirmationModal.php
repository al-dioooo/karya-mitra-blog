<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class DeleteConfirmationModal extends Component
{
    public $showing = false;
    public $title;
    public $content;

    public function render()
    {
        return view('livewire.delete-confirmation-modal');
    }

    public function show()
    {
        $this->showing = true;
    }

    // public function hide()
    // {
    //     $this->showing = false;
    // }

    // public function delete() {
    //     $this->showing = false;
    // }
}
