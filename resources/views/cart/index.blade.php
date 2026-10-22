<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Point of Sale</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>@endif
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow"><h3 class="text-lg font-bold mb-4">Products</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($products as $product)
                    <div class="border p-4 rounded"><h4 class="font-semibold">{{ $product->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm">Stock: {{ $product->stock }}</p>
                        <form method="POST" action="{{ route('cart.add') }}" class="mt-2">@csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 rounded border-gray-300 text-sm">
                            <button type="submit" class="ml-2 px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">Add</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow"><h3 class="text-lg font-bold mb-4">Cart</h3>
                @if(empty($cart))<p class="text-gray-500">Cart is empty</p>
                @else
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $subtotal = $item['product']->price * $item['quantity']; $total += $subtotal; @endphp
                        <div class="flex justify-between items-center mb-2 pb-2 border-b">
                            <div class="flex-1"><p class="font-semibold text-sm">{{ $item['product']->name }}</p>
                                <p class="text-xs text-gray-600">{{ $item['quantity'] }} × Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right"><p class="font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                <form method="POST" action="{{ route('cart.remove', $id) }}" class="inline">@csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 text-xs hover:text-red-800">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 pt-4 border-t">
                        <div class="flex justify-between mb-2"><span>Subtotal:</span><span class="font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between mb-2"><span>Tax (10%):</span><span>Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between text-lg font-bold mb-4"><span>Total:</span><span>Rp {{ number_format($total * 1.1, 0, ',', '.') }}</span></div>
                        <form method="POST" action="{{ route('cart.checkout') }}">@csrf
                            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Checkout</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="mt-6 flex gap-4">
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Manage Products</a>
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">View Transactions</a>
        </div>
    </div></div>
</x-app-layout>
