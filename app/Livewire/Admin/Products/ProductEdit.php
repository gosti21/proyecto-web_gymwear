<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\Admin\skuGenerator;
use App\Traits\Admin\sweetAlerts;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;
    use skuGenerator;
    use sweetAlerts;

    public $data;
    public $image;
    public $families;

    public $family_id = '';
    public $category_id = '';
    public $sub_category_id = '';
    public $name = '';
    public $price = '';
    public $stock = '';
    public $description = '';
    public $path = '';

    protected $listeners = ['save' => 'save'];

    public function mount($data)
    {
        $this->families = Family::all();

        $this->family_id = $data->subCategory->category->family_id;
        $this->category_id = $data->subCategory->category_id;
        $this->sub_category_id = $data->sub_category_id;
        $this->name = $data->name;
        $this->price = $data->price;
        if(!$this->data->variants->count() > 0){
            $this->stock = $data->stock;
        }
        $this->description = $data->description;
        $this->path = $data->images->first()->path; #obtenemos la primera imagen
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->alertGenerate2([
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'text' => "El formulario contiene errores",
                ]);
            }
        });
    }

    public function updatedFamilyId()
    {
        $this->reset('category_id');
        $this->reset('sub_category_id');
    }

    public function updatedCategoryId()
    {
        $this->reset('sub_category_id');
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories()
    {
        return SubCategory::where('category_id', $this->category_id)->get();
    }

    public function save()
    {
        $this->validateData();

        if($this->data->name !== $this->name || $this->data->sub_category_id !== $this->sub_category_id)
        {
            $sku = $this->generateSku($this->sub_category_id, $this->name);
            $skuvariant = $this->generateSkuVariant($this->name);

            $variant = Product::findOrFail($this->data->id);
            $variant->variants()->update([
                'sku' => $skuvariant
            ]);

        }else{
            $sku = $this->data->sku;
        }

        DB::beginTransaction();
        try {
            $product = Product::findOrFail($this->data->id);
            
            $product->update([
                'name' => $this->name,
                'price' => $this->price,
                'sku' => $sku,
                'description' => $this->description,
                'sub_category_id' => $this->sub_category_id,
            ]);

            if ($this->image) {
                Storage::delete($this->path);
                $this->path = $this->image->store('products');
                
                $product->images()->update([
                    'path' => $this->path
                ]);
            }
        
            DB::commit();

            $this->dispatch('subcategoryUpdated', $this->name);

            $this->alertGenerate2([
                'title' => '¡Registro actualizado!',
                'text' => "El registro ha sido actualizado correctamente",
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            $this->alertGenerate2([
                'title' => "¡Error!",
                'text' => "$e",
                'icon' => "error",
            ]);
        }
    }

    public function validateData()
    {
        $this->validate(
            [
                'family_id' => 'required|exists:families,id',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'name' => [
                    'required',
                    'string',
                    'regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/',
                    'between:3,80',
                    Rule::unique('products', 'name')
                        ->where(fn(Builder $query) => $query->where('sub_category_id', $this->sub_category_id))
                        ->ignore($this->data->id)
                ],
                'price' => 'required|numeric|decimal:2|min:1',
                'stock' => ['sometimes', 'numeric', 'min:1', Rule::requiredIf(fn() => $this->data->variants->count() == 0)],
                'description' => 'nullable|string',
                'image' => 'nullable|image|max:1024'
            ],
            [
                'name.regex' => 'El campo nombre solo puede contener letras y espacios.',
                'name.unique' => 'El nombre ya está relacionado con esta subcategoria.',
                'price.min' => 'El precio debe ser mayor a S/. 0.00'
            ],
            [
                'category_id' => 'categoría',
                'sub_category_id' => 'subcategoría',
            ]
        );
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
