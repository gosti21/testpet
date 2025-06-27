<?php

namespace App\Livewire\Admin\Options;

use App\Livewire\Forms\Admin\Options\NewOptionForm;
use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{
    public $options;
    public NewOptionForm $newOption;
    public $openModal = false;

    public function mount()
    {
        $this->options = Option::with('features')->get();
    }

    public function addFeature()
    {
        $this->newOption->addFeature();
    }
    public function removeFeature($index)
    {
        $this->newOption->removeFeature($index);
    }
    public function addOption()
    {

        $this->newOption->save();

        $this->options = Option::with('features')->get();

        $this->reset('openModal', 'newOption');

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Opcion agregada',
            'text' => 'La opcion se agreago',

        ]);
    }
    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
