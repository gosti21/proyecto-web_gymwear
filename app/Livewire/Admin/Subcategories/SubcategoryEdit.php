<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $families;

    public $data;

    public $subcategoryEdit;

    protected $listeners = ['save' => 'save'];

    /**
     * Se ejectura ni bien se cargue el componente  
     */
    public function mount($data)
    {
        $this->families = Family::all();

        $this->subcategoryEdit = [
            'family_id' => $data->category->family_id,
            'category_id' => $data->category_id,
            'name' => $data->name
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
            'subcategoryEdit.name' => [
                'required',
                'string',
                'regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/',
                'between:3,60',
                Rule::unique('sub_categories', 'name')
                    ->where(fn($query) => $query->where('category_id', $this->subcategoryEdit['category_id']))
                    ->ignore($this->data->id)
            ],
        ], 
        [
            'subcategoryEdit.name.regex' => 'El campo nombre solo puede contener letras y espacios.',
            'subcategoryEdit.name.unique' => 'El nombre ya está relacionado con esta categoria.'
        ], 
        [
            'subcategoryEdit.family_id' => 'familia',
            'subcategoryEdit.category_id' => 'categoria',
            'subcategoryEdit.name' => 'nombre',
        ]);

        $this->data->update($this->subcategoryEdit);

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
