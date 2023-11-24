<?php

namespace App\Livewire\Frontend;

use App\Models\Produk;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class HomeIndex extends Component
{
    public $produks;
    
    public function addToWishlist($produk_id)
    {
        // dd($produk_id);
        if (Auth::check()) {
            if (Wishlist::where('id_user', auth()->user()->id)->where('id_produk', $produk_id)->exists()) {
                session()->flash('message', 'Produk sudah dimasukkan ke wishlist');
                return false;
            }
            else {
                Wishlist::create([
                    'id_user' => auth()->user()->id,
                    'id_produk' => $produk_id
                ]);
                $this->dispatch('got-wishlistCount');
                session()->flash('message', 'Produk berhasil dimasukkan ke wishlist');
            }
        } else {
            session()->flash('danger-alert', 'Silahkan login terlebih dahulu untuk bisa menambahkan wishlist');
            return false;
        }
    }
    
    public function render()
    {
        $this->produks = Produk::where('status', '0')->limit(8)->get(); 

        // dd($this->produks);
        return view('livewire.frontend.home-index', [
            'produks' => $this->produks,
        ]);
    }
}
