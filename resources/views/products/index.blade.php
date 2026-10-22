<x-app-layout>
    <x-slot name="header"><div class="flex justify-between items-center"><h2 class="font-semibold text-xl text-gray-800">Products</h2>
        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">+ New Product</a></div></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>@endif
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="w-full">
                <thead><tr class="border-b"><th class="text-left py-2">SKU</th><th class="text-left">Name</th><th class="text-left">Category</th><th class="text-right">Price</th><th class="text-right">Stock</th><th class="text-right">Actions</th></tr></thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b"><td class="py-2">{{ $product->sku }}</td><td>{{ $product->name }}</td><td>{{ $product->category->name ?? '-' }}</td>
                        <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td><td class="text-right">{{ $product->stock }}</td>
                        <td class="text-right"><a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $products->links() }}</div>
        </div>
    </div></div>
</x-app-layout>
