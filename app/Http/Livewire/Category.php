<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{

    public $category_name;

    public function store(){
        $this->validate([
            'category_name' => 'required'
        ]);

        ModelsCategory::create([
            'category_name' => $this->category_name
        ]);
        session()->flash('message', 'Data Berhasil Disimpan.');
        // return redirect()->route('post.index');
    }

    public function render()
    {
        return view('livewire.category', [
            'category' => ModelsCategory::all()
        ]);
     }
}
