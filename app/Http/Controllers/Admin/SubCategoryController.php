<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category.family')->paginate();
        return view('admin.subcategories.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required'
        ]);

        SubCategory::create($validated);

        session()->flash('swal', [
            'title' => "¡SubCategoría creada!",
            'text' => "La subcategoría $request->name ahora está disponible",
            'icon' => "success",
            'draggable' => true,
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        return redirect()->route('admin.subcategories.create'); */
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subcategory)
    {
        return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subcategory)
    {
        if ($subcategory->products()->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => "No se puede eliminar la subcategoría $subcategory->name, porque tiene productos asociadas",
                'timer' => 1600,
                'timerProgressBar' => true
            ]);

            return redirect()->route('admin.categories.index');
        }

        $subcategory->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡SubCategoría eliminada!',
            'text' => "La subcategoría $subcategory->name ha sido eliminada correctamente",
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        return redirect()->route('admin.subcategories.index');
    }
}
