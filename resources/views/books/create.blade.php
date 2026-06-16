@extends('layout')

@section('content')

<div class="bg-white p-6 rounded-xl shadow max-w-2xl mx-auto">

    <h1 class="text-3xl font-bold mb-5 text-green-600">
        Tambah Buku
    </h1>

    @if($errors->any())

        <div class="bg-red-200 text-red-700 p-4 rounded mb-4">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('books.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- Judul -->

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Judul Buku
            </label>

            <input type="text"
                   name="title"
                   placeholder="Masukkan judul buku"
                   value="{{ old('title') }}"
                   class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Penulis -->

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Penulis
            </label>

            <input type="text"
                   name="author"
                   placeholder="Masukkan nama penulis"
                   value="{{ old('author') }}"
                   class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Penerbit -->

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Penerbit
            </label>

            <input type="text"
                   name="publisher"
                   placeholder="Masukkan nama penerbit"
                   value="{{ old('publisher') }}"
                   class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Tahun -->

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Tahun Terbit
            </label>

            <input type="number"
                   name="year"
                   placeholder="Contoh: 2025"
                   value="{{ old('year') }}"
                   class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Kategori -->

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Kategori
            </label>

            <input type="text"
                   name="category"
                   placeholder="Contoh: Novel"
                   value="{{ old('category') }}"
                   class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Deskripsi -->

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Deskripsi
            </label>

            <textarea name="description"
                      rows="5"
                      placeholder="Masukkan deskripsi buku"
                      class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description') }}</textarea>

        </div>

        <!-- Cover -->

        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Upload Cover Buku
            </label>

            <input type="file"
                   name="cover"
                   class="w-full border rounded-lg p-3 bg-white">

        </div>

        <!-- Button -->

        <div class="flex gap-3">

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg transition">

                Simpan

            </button>

            <a href="{{ route('books.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg transition">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection