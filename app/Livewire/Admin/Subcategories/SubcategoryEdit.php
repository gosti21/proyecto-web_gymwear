<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $families;

    public $subcategory;

    public $subcategoryEdit;

    protected $listeners = ['save' => 'save'];

    /**
     * Se ejectura ni bien se cargue el componente  
     */
    public function mount($subcategory)
    {
        $this->families = Family::all();

        $this->subcategoryEdit = [
            'family_id' => $subcategory->category->family_id,
            'category_id' => $subcategory->category_id,
            'name' => $subcategory->name
        ];
    }

    /**
     * Ciclo de vida del componente
     */
    public function updatedSubCategoryEditFamilyId()
    {
        $this->subcategoryEdit['category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }

    public function save()
    {
        $this->validate([
            'subcategoryEdit.family_id' => 'required|exists:families,id',
            'subcategoryEdit.category_id' => 'required|exists:categories,id',
            'subcategoryEdit.name' => 'required',
        ], [], [
            'subcategoryEdit.family_id' => 'familia',
            'subcategoryEdit.category_id' => 'categoria',
            'subcategoryEdit.name' => 'nombre',
        ]);

        $this->subcategory->update($this->subcategoryEdit);

        $this->dispatch('subcategoryUpdated', $this->subcategoryEdit['name']);
        
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Categororía actualizada!',
            'text' => "La categoría " . $this->subcategoryEdit['name'] . " ha sido actualizada correctamente",
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        
        
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }
}
