<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category.family')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
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
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required'
        ]);

        Subcategory::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien',
            'text' => 'Subcategoria creada correctamente'
        ]);

        return redirect()->route('admin.subcategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->products->count() > 0) {

            session()->flash('swal', [
                'icon' => 'errors',
                'title' => 'Ups',
                'text' => 'No se puede eliminar la subcategoria'
            ]);

            return redirect()->route('admin.subcategories.edit', $subcategory);
        }

        $subcategory->delete();

        session()->flash('swal', [
            'icon' => 'errors',
            'title' => 'Ups',
            'text' => 'Subcategoria elimanada correctamente0'
        ]);

        return redirect()->route('admin.subcategories.edit');
    }
}
