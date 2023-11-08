<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistShow extends Component
{
    public function removeWishlistitem($wishlist_id)
    {
        $wishlist = Wishlist::where('id_user', auth()->user()->id)->where('id', $wishlist_id)->delete();
        $this->dispatch('got-wishlistCount');
        session()->flash('message', 'Item Wishlist telah di hapus');
    }
    
    public function render()
    {
        $wishlists = Wishlist::where('id_user', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlists' => $wishlists,
        ]);
    }
}
