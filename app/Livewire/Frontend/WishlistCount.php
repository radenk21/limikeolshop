<?php

namespace App\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class WishlistCount extends Component
{
    public $wishlistCount;
    
    
    #[On('got-wishlistCount')]
    public function gotWishlistCount()
    {
        $this->wishlistCount = Wishlist::where('id_user', auth()->user()->id)->count();
    }
    
    public function checkWishlistCount()
    {
        if (Auth::check()) {
            return $this->wishlistCount = Wishlist::where('id_user', auth()->user()->id)->count();
        } else {
            return $this->wishlistCount = 0;
        }
        
    }
    
    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count', [
            'wishlistCount' => $this->wishlistCount,
        ]);
    }
}
