<?php

namespace App\Livewire\Frontend\Checkout;

use id;
use no;
use App\Models\Order;
use Livewire\Component;
use App\Models\Keranjang;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutShow extends Component
{
    public $keranjangs, $totalHarga;
    public $id_user, $no_tracking, $fullname, $email, $phone, $pincode, $address, $status_message, $payment_mode = null, $payment_id = null;
    public $selectedPaymentMethod, $no_rekening, $harga_produk;

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:15|min:10',
            'pincode' => 'required|string|max:8',
            'address' => 'required|string|max:125',
        ];
    }

    public function placeOrder()
    {
        $validatedData = $this->validate();
        $order = Order::create([
            'id_user' => auth()->user()->id,
            'no_tracking' => 'limike'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone'=> $this->phone,
            'pincode' => $this->pincode,
            'address'=> $this->address,
            'total_harga'=> $this->totalHargaKeranjang(),
            'status_message' => 'belum di verifikasi',
            'payment_mode' => $this->payment_mode,
            'id_payment' => $this->payment_id,
        ]);
        
        foreach ($this->keranjangs as $keranjang) {
            // dump($keranjang->produk->harga_jual * $keranjang->jumlah);

            $this->harga_produk = $keranjang->produk->harga_jual * $keranjang->jumlah;
            $orderItems = OrderItem::create([
                'id_order' => $order->id,
                'id_produk' => $keranjang->produk->id,
                'jumlah'=> $keranjang->jumlah,
                'harga' => $this->harga_produk,    
            ]);
        }

        return $order;
    }
    
    public function codOrder()
    {
        $this->payment_mode = 'Cash On Delivery';
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            Keranjang::where('id_user', auth()->user()->id)->delete();
            $this->dispatch('got-keranjangCount');
            session()->flash('message','Keranjang berhasil dicheckout');
            redirect()->to('thank-you');
        } else {
            session()->flash('danger-alert','Terjadi kesalahan saat men checkout!');
        }
    }

    public function onlineOrder()
    {
        $validatedData = $this->validate([
            'no_rekening' => ['required', 'string', 'max:255', 'regex:/^\d+$/'], // Contoh: Hanya angka diperbolehkan
        ]);
        
        $this->payment_mode = $this->selectedPaymentMethod;
        $onlineOrder = $this->placeOrder();
        
        if ($onlineOrder) {
            $orderID = $onlineOrder->id;
            $payment = Payment::create([
                'id_user' => auth()->user()->id,
                'id_order' => $orderID,
                'no_rekening' => $this->no_rekening,
                'jenis_rekening' => $this->payment_mode,
                'total_bayar' => $this->totalHarga,
                'payment_status' => 'belum di verifikasi',        
            ]);
            
            $onlineOrder->update(['id_payment' => $payment->id]);

            Keranjang::where('id_user', auth()->user()->id)->delete();
            $this->dispatch('got-keranjangCount');
            session()->flash('message','Keranjang berhasil dicheckout, silahkan tunggu admin untuk memverifikasi pembayaran');
            redirect()->to('thank-you');
        } else {
            session()->flash('danger-alert','Terjadi kesalahan saat men checkout!');
        }
    }
    
    public function totalHargaKeranjang()
    {
        $user_id = auth()->user()->id;
        $totalHarga = DB::select("SELECT calculate_total_harga_keranjang($user_id) AS total")[0]->total;
        $this->keranjangs = Keranjang::where('id_user', $user_id)->get();
        $this->totalHarga = $totalHarga;

        return $this->totalHarga;
    }
    
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        
        $this->totalHarga = $this->totalHargaKeranjang();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalHarga' => $this->totalHarga,
        ]);
    }
}
