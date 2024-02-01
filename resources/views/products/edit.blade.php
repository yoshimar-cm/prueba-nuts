<x-app-layout>


    <div class="max-w-3xl mx-auto p-3 mt-10">
        <a class="flex items-center gap-1 underline" href="{{ route('products.index') }}">
            <svg data-slot="icon" class="w-5" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"></path>
              </svg>
              <span>Todos los productos</span>
        </a>
    </div>


    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow-lg">

        <h3 class="font-bold text-2xl">Editar producto</h3>
        <hr class="my-5">

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="text-gray-700" for="name">Nombre</label>
                <input type="text"
                id="name"
                name="name"
                value="{{$product->name}}"
                class="w-full rounded border-gray-300">
                @error('name')
                    <span class="text-xs text-red-500" type="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="text-gray-700" for="description">Descripción</label>
                <textarea name="description"
                id="description"
                class="w-full rounded border-gray-300"
                rows="6">{{$product->description}}</textarea>
                @error('description')
                    <span class="text-xs text-red-500" type="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5 bg-gray-100 p-3 rounded border border-gray-300">
                <label class="text-gray-700" for="video">Vídeo</label>
                <input type="file"
                id="video"
                name="video"
                class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-200 file:text-blue-800
                    hover:file:bg-blue-300
                    "/>
                <div>
                    <p>Video actual</p>
                </div>
                @error('video')
                    <span class="text-xs text-red-500" type="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5 bg-gray-100 p-3 rounded border border-gray-300">
                <label class="text-gray-700" for="video">Imágenes</label>
                <input type="file"
                multiple
                id="images"
                name="images[]"
                class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-200 file:text-blue-800
                    hover:file:bg-blue-300
                    "/>
                <div class="grid grid-cols-4">
                    @foreach ($product->images as $image)
                        <div>
                            {{$image->name}}
                        </div>
                    @endforeach
                </div>
                @error('images')
                    <span class="text-xs text-red-500" type="alert">{{ $message }}</span>
                @enderror
            </div>

            <button class="bg-blue-700 text-white py-3 px-10 rounded font-bold mt-8" type="submit">Guardar</button>

        </form>
    </div>

</x-app-layout>

