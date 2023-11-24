<?php

namespace App\Livewire\Frontend\Produk;

use App\Models\Brand;
use App\Models\Produk;
use Livewire\Component;
use App\Models\Wishlist;
use App\Models\SubKategori;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;

class Index extends Component
{
    public $kategori, $subKategoris, $subKategori, $uniqueBrands, $selectedBrands = [], $priceInput;

    #[Rule('number')]
    public $priceMinInput;
    #[Rule('number')]
    public $priceMaxInput;
    
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
        
    public function mount($kategori, $subKategori)
    {
        $this->kategori = $kategori;
        $this->subKategoris = $subKategori;
        $this->uniqueBrands = Brand::where('status', '0')->get();
        $this->selectedBrands = request()->input('selectedBrands', []);
        $this->priceInput = request()->input('priceSort', 'high-to-low');
        $this->priceMinInput = request()->input('harga_minimum');
        $this->priceMaxInput = request()->input('harga_maksimum');
    }
    
    public function render()
    {
        // $this->subKategoris = SubKategori::
        //                                     when($this->kategori == null, function ($qsubKategori) {
        //                                         return $qsubKategori->wherein('id_kategori', $this->kategori)->get();
        //                                     })->
        //                                     when($this->kategori != null, function ($qsubKategori) {
        //                                         return $qsubKategori->where('id_kategori', $this->kategori->id)->get();
        //                                     });

        if ($this->priceMaxInput && $this->priceMinInput) {
            if ($this->priceMaxInput <= $this->priceMinInput && $this->priceMaxInput != null && $this->priceMinInput != null) {
                session()->flash('danger-alert', 'Pastikan menginput rentang harga yang benar');
            }
        }
        
        $this->produks = Produk::
                        when($this->kategori, function ($qKategori) {
                            return $qKategori->where('id_kategori', $this->kategori->id);
                        })
                        ->when($this->subKategori, function ($qSubKategori) {
                            return $qSubKategori->where('id_sub_kategori', $this->subKategori->id);
                        })
                        ->when($this->selectedBrands, function ($qBrands) {
                            return $qBrands->whereIn('id_brand', $this->selectedBrands);
                        })
                        ->when($this->priceInput === 'high-to-low', function ($qPriceHighToLow) {
                            return $qPriceHighToLow->orderBy('harga_jual', 'desc');
                        })
                        ->when($this->priceInput === 'low-to-high', function ($qPriceLowToHigh) {
                            return $qPriceLowToHigh->orderBy('harga_jual', 'asc');
                        })
                        ->when($this->priceMinInput !== null && $this->priceMaxInput !== null, function ($qRentangHarga) {
                            return $qRentangHarga->whereBetween('harga_jual', [$this->priceMinInput, $this->priceMaxInput]);
                        })
                        ->where('status', '0')
                        ->get();
        // dd($this->uniqueBrands);
        return view('livewire.frontend.produk.index', [
            'produks' => $this->produks,
            'kategori' => $this->kategori,
            'subKategoris' => $this->subKategoris,
            'uniqueBrands' => $this->uniqueBrands,
        ]);
    }
}
