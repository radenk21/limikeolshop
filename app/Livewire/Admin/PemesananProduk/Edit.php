<?php

namespace App\Livewire\Admin\PemesananProduk;

use App\Models\Produk;
use Livewire\Component;
use App\Models\PemesananProduk;

class Edit extends Component
{
    // public $pemesananProduk, $id_pemesanan_produk, $total_kalkulasi_harga, $jumlah_produk;

    // public function mount($pemesananProduk)
    // {
    //     $this->pemesananProduk = $pemesananProduk;
    // }

    // public $harga_beli_produk;
    // public $total_harga_beli = 0;

    // public function setHargaBeliProduk()
    // {
    //     // Mendapatkan data pemesanan produk
    //     $pemesananProduk = PemesananProduk::find($this->id_pemesanan_produk);

    //     // Validasi jika pemesanan produk ditemukan
    //     if ($pemesananProduk) {
    //         // Mendapatkan data produk berdasarkan id_produk pada pemesanan_produk
    //         $produk = Produk::find($pemesananProduk->id_produk);

    //         // Validasi jika produk ditemukan
    //         if ($produk) {
    //             // Set nilai harga_beli_produk
    //             $this->harga_beli_produk = $produk->harga_beli;
    //         }
    //     }
    // }
    
    // protected $listeners = ['updateJumlahStok'];
    // public function updateJumlahStok($jumlahStok)
    // {
    //     dd($jumlahStok);
    //     $this->jumlah_produk = $jumlahStok;
    //     // $this->updateTotalHarga();
    // }
    
    // // public function upJumlahProduk($id_pemesanan_produk, $jumlah_produk)
    // // {
    // //     dd($id_pemesanan_produk, $jumlah_produk);
    // //     $this->jumlah_produk += $jumlah_produk;
    // //     dd($this->jumlah_produk);
    // //     dd($this->setHargaBeliProduk());
    // // }

    // public function hitungTotalHarga()
    // {
    //     $this->total_harga_beli = $this->jumlah_produk * $this->harga_per_produk;
    // }

    // public function edit()
    // {
    //     $this->pemesananProduk->update([
    //         'total_harga_pesan' => $this->total_harga_beli,
    //         'jumlah_beli_stok' => $this->jumlah_produk,
    //         'status' => 'telah di pesan',
    //     ]);

    //     session()->flash('message', 'Berhasil memesan produk');
    //     return redirect()->back();
    // }
    
    // public function render()
    // {
    //     return view('livewire.admin.pemesanan-produk.edit', [
    //         'pemesananProduk' => $this->pemesananProduk,
    //         'jumlah_produk' => $this->jumlah_produk,
    //         'total_harga_beli' => $this->total_harga_beli,
    //     ]);
    // }
}
