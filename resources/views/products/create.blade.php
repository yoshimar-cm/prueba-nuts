<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow-lg">

        <h3 class="font-bold text-2xl">New product</h3>
        <hr class="my-5">

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="text-gray-700" for="name">Name</label>
                <input type="text"
                id="name"
                class="w-full rounded border-gray-300">
            </div>
            <div class="mb-4">
                <label class="text-gray-700" for="description">Description</label>
                <textarea name="description"
                id="description"
                class="w-full rounded border-gray-300"
                rows="6"></textarea>
            </div>
            <div class="mb-5 bg-gray-100 p-3 rounded border border-gray-300">
                <label class="text-gray-700" for="video">Video</label>
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
            </div>
            <div class="mb-5 bg-gray-100 p-3 rounded border border-gray-300">
                <label class="text-gray-700" for="video">Images</label>
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
            </div>

            <button class="bg-blue-700 text-white py-3 px-10 rounded font-bold mt-8" type="submit">Save</button>

        </form>
    </div>

</x-app-layout>

