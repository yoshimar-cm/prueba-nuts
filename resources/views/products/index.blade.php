<x-app-layout>

    <div class="max-w-6xl mx-auto px-7 mt-10 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Productos</h2>
        <a
        class="bg-blue-700 hover:bg-blue-800 text-white font-bold px-8 py-3 rounded"
        href="{{ route('products.create') }}">Nuevo producto</a>
    </div>

    <div class="max-w-6xl mx-auto px-7 mt-10">
        <div class="grid grid-cols-4 gap-8">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}" class="bg-white hover:bg-gray-50 border-b-4 border-transparent hover:border-blue-700 shadow-xl rounded overflow-hidden block">
                    <img
                    class="w-full"
                    src="{{ asset("storage/{$product->images->first()?->name}") }}" alt="Imagen de producto">
                    <div class="p-4">
                        <p class="font-bold text-lg">{{$product->name}}</p>
                    </div>
                </a>
            @empty

            @endforelse
        </div>
    </div>

</x-app-layout>

