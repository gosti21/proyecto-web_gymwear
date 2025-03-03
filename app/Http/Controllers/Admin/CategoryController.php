<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('family')->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families = Family::all();
        return view('admin.categories.create', compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        Category::create($request->all());

        session()->flash('swal', [
            'title' => "¡Categoría creada!",
            'text' => "La categoría $request->name ahora está disponible",
            'icon' => "success",
            'draggable' => true,
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        return redirect()->route('admin.categories.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $families = Family::all();
        return view('admin.categories.edit', compact('category', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categororía actualizada!',
            'text' => "La categoría $category->name ha sido actualizada correctamente",
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->subCategories->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => "No se puede eliminar la categoría $category->name, porque tiene subcategorías asociadas",
                'timer' => 1600,
                'timerProgressBar' => true
            ]);

            return redirect()->route('admin.categories.index');
        }

        $category->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Categoría eliminada!',
            'text' => "La categoría $category->name ha sido eliminada correctamente",
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        return redirect()->route('admin.categories.index');
    }
}
