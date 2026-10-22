<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Transactions</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow mb-6"><h3 class="text-lg font-bold">Today's Sales: Rp {{ number_format($todaySales, 0, ',', '.') }}</h3></div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="w-full"><thead><tr class="border-b"><th class="text-left py-2">Code</th><th class="text-left">Date</th><th class="text-right">Total</th><th class="text-right">Actions</th></tr></thead>
                <tbody>@foreach($transactions as $trx)
                    <tr class="border-b"><td class="py-2">{{ $trx->transaction_code }}</td><td>{{ $trx->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-right font-bold">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                        <td class="text-right"><a href="{{ route('transactions.show', $trx) }}" class="text-indigo-600 hover:text-indigo-800">View</a></td>
                    </tr>
                @endforeach</tbody>
            </table>
            <div class="mt-4">{{ $transactions->links() }}</div>
        </div>
    </div></div>
</x-app-layout>
