<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class NiceAlert extends Component
{
    public $text, $type, $status;

    #[On('get-alert')]
    public function getAlert()
    {
        
    }
    
    public function render()
    {
        return view('livewire.nice-alert');
    }
}
