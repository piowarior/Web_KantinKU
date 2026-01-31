<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $order->menu->name ?? 'Menu tidak ditemukan' }}</h5>
        <p class="card-text">
            <strong>Jumlah:</strong> {{ $order->quantity }} <br>
            <strong>Catatan:</strong> {{ $order->notes ?? '-' }} <br>
            <strong>Dipesan pada:</strong> {{ $order->created_at->format('d M Y H:i') }}
        </p>
    </div>
</div>
