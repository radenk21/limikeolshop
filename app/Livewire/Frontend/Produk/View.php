<?php

namespace App\Livewire\Frontend\Produk;

use Livewire\Component;
use App\Models\Wishlist;

use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $produk, $jumlahCount = 1;
    
    public function decerementJumlah()
    {
        if ($this->jumlahCount > 1) {
            $this->jumlahCount--;
        }
    }

    public function incrementJumlah()
    {
        if ($this->jumlahCount < 10) {
            $this->jumlahCount++;
        }
    }
    
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
    
    public function addToCart($produk_id)
    {
        if (Auth::check()) {
            if ($this->produk->where('id', $produk_id)->where('status', '0')->exists()) {
                if ($this->produk->jumlah > 0) {
                    if ($this->produk->jumlah > $this->jumlahCount) {
                        
                    } else {
                        session()->flash('danger-alert', 'Hanya tersedia '.$this->produk->jumlah. ' stok');
                        return false;            
                    }
                } else {
                    session()->flash('danger-alert', 'Stok barang tidak tersedia');
                    return false;            
                }
            } else {
                session()->flash('danger-alert', 'Stok barang tidak tersedia');
                return false;            
            }
            
        } else {
            session()->flash('danger-alert', 'Silahkan login terlebih dahulu untuk bisa menambahkan ke keranjang');
            return false;
        }
        
    }
    
    public function mount($produk)
    {
        $this->produk = $produk;
    }
    
    public function render()
    {
        return view('livewire.frontend.produk.view', [
            'produk' => $this->produk
        ]);
    }
}
