<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $subcategory;
    public $families;
    public $subcategoryEdit;

    public function mount($subcategory)
    {
        $this->families = Family::all();

        $this->subcategoryEdit = [
            'family_id' => $subcategory->category->family_id,
            'category_id' => $subcategory->category_id,
            'name' => $subcategory->name,
        ];
    }
    public function updatedSubcategoryEditFamilId()
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
        ([
            'subcategoryEdit.family_id' => 'required|exists:families,id',
            'subcategoryEdit.category_id' => 'required|exists:categories,id',
            'subcategoryEdit.name' => 'required',
        ]);

        $this->subcategory->update($this->subcategoryEdit);

        /*session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'Subcategoria actualizada correctamente',
        ]);*/

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'Subcategoria actualizada correctamente',

        ]);
    }
    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }
}
