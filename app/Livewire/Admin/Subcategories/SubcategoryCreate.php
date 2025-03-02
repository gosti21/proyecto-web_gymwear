<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\SubCategory;
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
     * Se ejectura ni bien se cargue el componente  
     */
    public function mount()
    {
        $this->families = Family::all();
    }

    /**
     * Ciclo de vida del componente
     */
    public function updatedSubCategoryFamilyId()
    {
        $this->subCategory['category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subCategory['family_id'])->get();
    }

    public function save()
    {
        $this->validate([
            'subCategory.family_id' => 'required|exists:families,id',
            'subCategory.category_id' => 'required|exists:categories,id',
            'subCategory.name' => 'required',
        ],[],[
            'subCategory.family_id' => 'familia',
            'subCategory.category_id' => 'categoria',
            'subCategory.name' => 'nombre',
        ]);

        SubCategory::create($this->subCategory);

        session()->flash('swal', [
            'title' => "¡SubCategoría creada!",
            'text' => "La subcategoría " . $this->subCategory['name'] . " ahora está disponible",
            'icon' => "success",
            'draggable' => true,
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        return redirect()->route('admin.subcategories.create');
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}
