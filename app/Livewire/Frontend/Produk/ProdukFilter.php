<?php

use Livewire\Component;
use App\Models\Produk;
use App\Models\Brand;

class FilterProducts extends Component
{
    public $selectedBrands = [];

    public function filterProducts()
    {
        $selectedBrands = $this->selectedBrands;

        $query = Produk::query();

        if (!empty($selectedBrands)) {
            $query->whereIn('id_brand', $selectedBrands);
        }

        $produks = $query->get();

        // Kemudian kirim data hasil filter ke komponen Produk di halaman produk
        $this->emit('filterProducts', $produks);
    }

    public function render()
    {
        $uniqueBrands = Brand::all();
        return view('livewire.filter-products', ['uniqueBrands' => $uniqueBrands]);
    }
}
