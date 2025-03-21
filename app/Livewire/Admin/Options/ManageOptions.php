<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{

    public $options;

    public function mount()
    {
        $this->options = Option::all();
    }
    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
