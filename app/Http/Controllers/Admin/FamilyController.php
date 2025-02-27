<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::paginate(10);
        return view('admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        Family::create($validated);

        session()->flash('swal', [
            'title' => "¡Familia creada!",
            'text' => "La familia $request->name ahora está disponible",
            'icon' => "success",
            'draggable' => true,
            'timer' => 1600,
            'timerProgressBar' => true
        ]);

        return redirect()->route('admin.families.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        return view('admin.families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $family->update($validated);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Familia actualizada!',
            'text' => "La familia $family->name ha sido actualizada correctamente"
        ]);

        return redirect()->route('admin.families.edit', $family);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        if($family->categories->count() > 0){
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => "No se puede eliminar la familia $family->name, porque tiene categorias asociadas"
            ]);

            return redirect()->route('admin.families.index');
        }

        $family->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Familia eliminada!',
            'text' => "La familia $family->name ha sido eliminada correctamente"
        ]);

        return redirect()->route('admin.families.index');
    }
}
