<?php

namespace App\Livewire\Karyawan\Kasir;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;

class InvoiceKasir extends Component
{
    public $order;
    
    #[On('printInvoice')]
    public function printInvoice($orderId)
    {
        $this->order = Order::findOrFail($orderId);
        // $this->dispatch('printInvoice', orderId: $this->order->id);
        // $this->order = Order::latest()->first();
        // return view('livewire.karyawan.kasir.invoice-kasir', compact('order'));
    }
    
    public function render()
    {
        if ($this->order) {
            return view('livewire.karyawan.kasir.invoice-kasir', [
                'order' => $this->order,
            ]);
        }
        return null;
    }
}
