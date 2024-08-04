<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Tour;
use Livewire\Component;

class Listwisata extends Component
{
    public $categories;

    public function mount(){
        $this->categories = Category::all();
    }
    public function render()
    {
        return view('livewire.listwisata', [
            'listwisata' => Tour::all()
        ]);
    }
}
