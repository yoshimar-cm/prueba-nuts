<x-app-layout>

    <div class="max-w-4xl mx-auto p-3 mt-10 flex justify-between items-center">
        <a class="flex items-center gap-1 underline" href="{{ route('products.index') }}">
            <svg data-slot="icon" class="w-5" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"></path>
              </svg>
              <span>Todos los productos</span>
        </a>

        <div class="flex items-center gap-2 font-semibold">
            <a class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-2 rounded"
            href="{{ route('products.edit', $product) }}">Editar</a>
            <form method="POST"
            onsubmit="return confirm('Estás seguro de eliminar éste producto?');"
            action="{{ route('products.destroy', $product) }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-700 hover:bg-red-800 text-white px-8 py-2 rounded" type="submit">Eliminar</button>
            </form>
        </div>
    </div>

    <div class="max-w-4xl mx-auto p-8 bg-white mt-10">
        <div class="grid grid-cols-2 gap-4">
            <div>
                {{-- <img
                    class="w-full rounded"
                    src="{{ asset("storage/{$product->images->first()?->name}") }}" alt="Imagen de producto"> --}}

                    <section class="splide mt-3 clip-path-bottom"  aria-label="Splide Basic HTML Example">
                        <div class="splide__track rounded-xl overflow-hidden">
                              <ul class="splide__list">
                                  @foreach ($product->images as $key => $image)
                                    <li class="splide__slide p-1">
                                        <img
                                            class="w-full rounded"
                                            src="{{ asset("storage/{$image->name}") }}" alt="Imagen de producto">
                                    </li>
                                  @endforeach
                                    <li class="splide__slide p-1">
                                        <div class="flex justify-center items-center h-full bg-gray-100 rounded">
                                            <video class="w-full" controls src="{{ asset("storage/$product->video") }}"></video>
                                        </div>
                                    </li>
                              </ul>
                        </div>
                      </section>
            </div>
            <div>
                <h2 class="text-2xl font-bold">{{$product->name}}</h2>
                <p>{{$product->description}}</p>
            </div>
        </div>


    </div>

</x-app-layout>

