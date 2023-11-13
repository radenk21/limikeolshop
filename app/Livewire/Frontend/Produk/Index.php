<?php

namespace App\Livewire\Frontend\Produk;

use App\Models\Produk;
use App\Models\SubKategori;
use Livewire\Component;

class Index extends Component
{
    public $kategori, $subKategoris, $uniqueBrands, $selectedBrands = [], $subKategoriInput;
    public $produks;
    protected $queryString = [
        'subKategoriInput' => ['except' => '', 'as' => 'subKategori'],
    ];

    public function mount($kategori, $uniqueBrands, $subKategoris, $produks)
    {
        $this->produks = $produks;
        $this->kategori = $kategori;
        $this->subKategoris = $subKategoris;
        $this->uniqueBrands = $uniqueBrands;
    }
    public function render()
    {
        // $this->subKategoris = SubKategori::where('id_kategori', $this->kategori->id)->get();
        // $this->produks = Produk::where('id_kategori', $this->kategori->id)
        //                 ->when($this->subKategoriInput, function($qSubKategori) {
        //                     $qSubKategori->where('id_sub_kategori', $this->subKategoriInput);
        //                 })
        //                 ->where('status', '0')
        //                 ->get();
        return view('livewire.frontend.produk.index', [
            'produks' => $this->produks,
            'kategori' => $this->kategori,
            'subKategoris' => $this->subKategoris,
            'uniqueBrands' => $this->uniqueBrands,
        ]);
    }
}
