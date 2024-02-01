<x-app-layout>

    <div class="max-w-4xl mx-auto p-3 mt-10">
        <a class="flex items-center gap-1 underline" href="{{ route('products.index') }}">
            <svg data-slot="icon" class="w-5" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"></path>
              </svg>
              <span>Todos los productos</span>
        </a>
    </div>

    <div class="max-w-4xl mx-auto p-8 bg-white mt-10">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <img
                    class="w-full rounded"
                    src="{{ asset("storage/{$product->images->first()?->name}") }}" alt="Imagen de producto">
            </div>
            <div>
                <h2 class="text-2xl font-bold">{{$product->name}}</h2>
                <p>{{$product->description}}</p>
            </div>
        </div>

        <hr class="my-6">
        <p>Más productos</p>
    </div>

</x-app-layout>

