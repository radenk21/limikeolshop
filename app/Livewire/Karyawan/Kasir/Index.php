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
    public $keranjangs, $totalHarga, $produks, $produk;

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
        if(Auth::check()) {
            $order = Order::create([
                'id_user' => auth()->user()->id,
                'no_tracking' => 'limike'.Str::random(10),
                'fullname' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone'=> '0',
                'pincode' => '20147',
                'address'=> 'Limike Olshop, Jl. Panca Karya No.84c, Harjosari II, Kec. Medan Amplas, Kota Medan, Sumatera Utara 20147',
                'total_harga' => $this->totalHargaKeranjang(),
                'status_message' => 'selesai',
                'payment_mode' => 'kasir',
                'id_payment' => null,
            ]);
            
            foreach ($this->keranjangs as $keranjang) {
                $orderItems = OrderItem::create([
                    'id_order' => $order->id,
                    'id_produk' => $keranjang->produk->id,
                    'jumlah'=> $keranjang->jumlah,
                    'harga' => $keranjang->produk->harga_jual * $keranjang->jumlah,    
                ]);

                $keranjang->delete();
            }
                        
            return $order;
        }
    }
    
    public function totalHargaKeranjang()
    {
        $this->keranjangs = Keranjang::where('id_user', auth()->user()->id)->get();
        $this->totalHarga = Keranjang::where('id_user', auth()->user()->id)
        ->join('produks', 'keranjangs.id_produk', '=', 'produks.id')
        ->sum(DB::raw('keranjangs.jumlah * produks.harga_jual'));
        return $this->totalHarga;
    }
    
    public function render()
    {
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
