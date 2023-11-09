<?php

namespace App\Livewire\Frontend\Keranjang;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class KeranjangCount extends Component
{
    public $keranjangCount;
    
    #[On('got-keranjangCount')]
    public function gotKeranjangCount()
    {
        $this->keranjangCount = Keranjang::where('id_user', auth()->user()->id)->count();
    }
    
    public function checkKeranjangCount()
    {
        if (Auth::check()) {
            return $this->keranjangCount = Keranjang::where('id_user', auth()->user()->id)->count();
        } else {
            return $this->keranjangCount = 0;
        }
        
    }
    
    public function render()
    {
        $this->keranjangCount = $this->checkKeranjangCount();
        return view('livewire.frontend.keranjang.keranjang-count', [
            'keranjangCount' => $this->keranjangCount,
        ]);
    }
}
