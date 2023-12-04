<?php

namespace App\Livewire\Karyawan\Kasir;

use App\Models\Order;
use App\Models\Produk;
use Livewire\Component;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\OrderItem;
use App\Models\SubKategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $keranjangs, $totalHarga, $produks, $produk, $user_id, $is_checkout = false, $search;

    public function mount($produks)
    {
        $this->produks = $produks;
    }
    
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

    public function addToCart($produk_id)
    {
        if (Auth::check()) {
            // dump($this->produks->where('id', $produk_id)->where('status', '0')->first());
            if ($this->produks->where('id', $produk_id)->where('status', '0')->isNotEmpty()) {
                $this->produk = $this->produks->where('id', $produk_id)->where('status', '0')->first();
                if (Keranjang::where('id_user', Auth::user()->id)->where('id_produk', $produk_id)->exists()) {
                    session()->flash('danger-alert', 'Produk sudah ditambahkan ke keranjang');
                } else {
                    if ($this->produk->jumlah > 0) {
                        Keranjang::create([
                            'id_user' => Auth::user()->id,
                            'id_produk' => $produk_id,
                            'jumlah' => 1,
                        ]);
                        // $this->dispatch('got-keranjangCount');
                        session()->flash('message', 'Produk berhasil ditambahkan ke keranjang');
                    } else {
                        session()->flash('danger-alert', 'Stok barang tidak tersedia');
                        return false;            
                    }
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

    public function checkoutKeranjang($user_id)
    {
        
        $result = DB::select("CALL checkout_keranjang_kasir(?)", [$user_id]);
        
        return redirect()->with('message', 'Keranjang Berhasil Di Checkout');
    }
    
    public function totalHargaKeranjang()
    {
        $user_id = auth()->user()->id;
        $totalHarga = DB::select("SELECT calculate_total_harga_keranjang($user_id) AS total")[0]->total;
        $this->keranjangs = Keranjang::where('id_user', $user_id)->get();
        $this->totalHarga = $totalHarga;

        return $this->totalHarga;
    }

    public function generateFaktur()
    {
        $order = Order::latest()->first();

        return view('livewire.karyawan.kasir.invoiceKasir', compact('order'));
    }
    
    public function render()
    {
        if (!$this->search) {
            $this->produks = Produk::where('status', 0)->get();
        } else {
            $this->produks = Produk::where('status', 0)->where('name', 'LIKE', '%'. $this->search.'%')->get();
        }
        $kategoris = Kategori::where('status', 0)->get();
        $subKategoris = SubKategori::where('status', 0)->get();
        $this->keranjangs = Keranjang::where('id_user', auth()->user()->id)->get();
        $this->totalHarga = $this->totalHargaKeranjang();

        return view('livewire.karyawan.kasir.index', [
            'produks' => $this->produks,
            'kategoris' => $kategoris,
            'subKategoris' => $subKategoris,
            'keranjangs' => $this->keranjangs,
            'totalHarga' => $this->totalHarga,
        ]);
    }
}
