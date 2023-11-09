<?php

namespace App\Livewire\Frontend\Keranjang;

use Livewire\Component;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class KeranjangShow extends Component
{
    public $keranjangs, $totalHarga;
    
    public function decrementJumlah($keranjang_id)
    {
        $dataKeranjang = Keranjang::where('id', $keranjang_id)->where('id_user', auth()->user()->id)->first();
        if ($dataKeranjang) {
            if ($dataKeranjang->produk->jumlah >= $dataKeranjang->jumlah && $dataKeranjang->jumlah !== 0) {
                $dataKeranjang->decrement('jumlah');
                session()->flash('message', 'Item keranjang telah berhasil dikurangi');                
            } else {
                session()->flash('danger-alert', 'Hanya tersedia '.$dataKeranjang->produk->jumlah. ' stok');
                return false;
            }
        } else {
            session()->flash('danger-alert', 'Terjadi kesalahan saat mengurangi item');                
            return false;
        }
    }
    public function incrementJumlah($keranjang_id)
    {
        $dataKeranjang = Keranjang::where('id', $keranjang_id)->where('id_user', auth()->user()->id)->first();
        if ($dataKeranjang) {
            if ($dataKeranjang->produk->jumlah > $dataKeranjang->jumlah) {
                $dataKeranjang->increment('jumlah');
                session()->flash('message', 'Item keranjang telah berhasil ditambah');                
            } else {
                session()->flash('danger-alert', 'Hanya tersedia '.$dataKeranjang->produk->jumlah. ' stok');
                return false;
            }
        } else {
            session()->flash('danger-alert', 'Terjadi kesalahan saat menambah item');                
            return false;
        }
    }
    
    public function removeKeranjangitem($keranjang_id)
    {
        $dataKeranjang = Keranjang::where('id_user', auth()->user()->id)->where('id', $keranjang_id)->first();
        if ($dataKeranjang) {
            $dataKeranjang->delete();
            $this->dispatch('got-keranjangCount');
            session()->flash('message', 'Item keranjang telah berhasil dihapus');                
        } else {
            session()->flash('danger-alert', 'Item keranjang gagal dihapus');                
        }
    }
    
    public function render()
    {
        $this->totalHarga = Keranjang::where('id_user', auth()->user()->id)
        ->join('produks', 'keranjangs.id_produk', '=', 'produks.id')
        ->sum(DB::raw('keranjangs.jumlah * produks.harga_jual'));
        $this->keranjangs = Keranjang::where('id_user', auth()->user()->id)->get();
        return view('livewire.frontend.keranjang.keranjang-show', [
            'keranjangs' => $this->keranjangs,
            'totalHarga' => $this->totalHarga,
        ]);
    }
}
