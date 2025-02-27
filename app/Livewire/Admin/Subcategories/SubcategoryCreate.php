<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryCreate extends Component
{
    public $families;
    public $subCategory = [
        'family_id' => '',
        'category_id' => '',
        'name' => ''
    ];

    /**
     * Se ejecuta cuando el componente se carga
     */
    public function mount()
    {
        $this->families = Family::all();
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subCategory['family_id'])->get();
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}
