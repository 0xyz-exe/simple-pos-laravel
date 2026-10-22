<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Transaction {{ $transaction->transaction_code }}</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-6"><p><strong>Date:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Cashier:</strong> {{ $transaction->user->name }}</p></div>
        <table class="w-full mb-6"><thead><tr class="border-b"><th class="text-left py-2">Product</th><th class="text-right">Qty</th><th class="text-right">Price</th><th class="text-right">Subtotal</th></tr></thead>
            <tbody>@foreach($transaction->items as $item)
                <tr class="border-b"><td class="py-2">{{ $item->product->name }}</td><td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach</tbody>
        </table>
        <div class="border-t pt-4"><div class="flex justify-between mb-2"><span>Subtotal:</span><span>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span></div>
            <div class="flex justify-between mb-2"><span>Tax:</span><span>Rp {{ number_format($transaction->tax, 0, ',', '.') }}</span></div>
            <div class="flex justify-between text-xl font-bold"><span>Total:</span><span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span></div>
        </div>
        <div class="mt-6"><a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Back</a></div>
    </div></div></div>
</x-app-layout>
