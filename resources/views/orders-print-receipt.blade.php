<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt #{{ $order->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border-bottom: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print(); window.close();">
<h2>{{ __('orders.receipt-title') }}</h2>
<p>{{ __('orders.order-id') }}: #{{ $order->id }}</p>
<p>{{ __('orders.table') }}: {{ $order->table?->table_number }} ({{ $order->table?->place?->name }})</p>
<p>{{ __('orders.customer') }}: {{ $order->customer?->name ?? __('orders.default-customer') }}</p>
<p>{{ __('orders.cacher') }}: {{ $order->cacher?->name ?? __('orders.default-cacher') }}</p>

<table>
    <thead>
    <tr>
        <th>{{ __('items.name') }}</th>
        <th>{{ __('orders.amount') }}</th>
        <th>{{ __('orders.price') }}</th>
        <th>{{ __('orders.total-price') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->item?->name }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ number_format($item->price, 2) }}</td>
            <td>{{ number_format($item->final_price, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p><strong>{{ __('orders.total') }}:</strong> {{ number_format($order->items_sum_final_price, 2) }}</p>
<p><strong>{{ __('orders.discount') }}:</strong> {{ $order->discount ?? 0 }}%</p>
<p><strong>{{ __('orders.final-price') }}:</strong> {{ number_format($order->final_price, 2) }}</p>
@push('scripts')
    <script>
        document.addEventListener('open-print-window', e => {
            window.open(e.detail.url, '_blank', 'width=800,height=600');
        });
    </script>
@endpush

</body>
</html>
