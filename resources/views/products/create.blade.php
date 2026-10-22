<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Create Product</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 rounded-lg shadow">
        <form method="POST" action="{{ route('products.store') }}">@csrf
            <div class="mb-4"><label class="block text-sm font-medium mb-2">Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-md border-gray-300">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror</div>
            <div class="mb-4 grid grid-cols-2 gap-4"><div><label class="block text-sm font-medium mb-2">SKU *</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" required class="w-full rounded-md border-gray-300">
                    @error('sku')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror</div>
                <div><label class="block text-sm font-medium mb-2">Category</label>
                    <select name="category_id" class="w-full rounded-md border-gray-300"><option value="">None</option>
                        @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach
                    </select></div></div>
            <div class="mb-4 grid grid-cols-2 gap-4"><div><label class="block text-sm font-medium mb-2">Price *</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01" required class="w-full rounded-md border-gray-300">
                    @error('price')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror</div>
                <div><label class="block text-sm font-medium mb-2">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" min="0" required class="w-full rounded-md border-gray-300">
                    @error('stock')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror</div></div>
            <div class="flex gap-3"><button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Create</button>
                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</a></div>
        </form>
    </div></div></div>
</x-app-layout>
