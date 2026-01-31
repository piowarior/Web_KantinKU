<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderPage extends Component
{
    public $orderId;
    public $order;

    public function mount($orderId = null)
    {
        $this->orderId = $orderId;
        $this->order = Order::with('menu')->find($orderId);

        if (!$this->order) {
            abort(404, 'Order tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.order-page');
    }
}
