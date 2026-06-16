@php
use Illuminate\Support\Str;
@endphp

@extends('layout')

@section('content')

<div class="bg-white rounded-2xl shadow-lg p-6">

     <div class="flex justify-between items-center mb-6">

        <h1 class="text-xl font-bold">Dashboard Buku</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                Logout
            </button>
        </form>

    </div>

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

        <div>
            <h1 class="text-4xl font-bold text-slate-800">
                Data Buku Digital
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola data buku perpustakaan digital dengan mudah
            </p>
        </div>

        <a href="{{ route('books.create') }}"
           class="mt-4 md:mt-0 bg-emerald-500 hover:bg-emerald-600
                  text-white px-5 py-3 rounded-xl shadow
                  transition duration-300">

            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Buku

        </a>

    </div>


    <!-- ALERT -->
    @if(session('success'))

        <div class="bg-emerald-100 border border-emerald-300
                    text-emerald-700 px-4 py-3 rounded-lg mb-5">

            {{ session('success') }}

        </div>

    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-slate-800 text-white">

                    <th class="px-5 py-4 text-center rounded-tl-xl">
                        No
                    </th>

                    <th class="px-5 py-4 text-center">
                        Cover
                    </th>

                    <th class="px-5 py-4 text-left">
                        Judul
                    </th>

                    <th class="px-5 py-4 text-left">
                        Penulis
                    </th>

                    <th class="px-5 py-4 text-left">
                        Kategori
                    </th>

                    <th class="px-5 py-4 text-center">
                        Tahun
                    </th>

                    <th class="px-5 py-4 text-center rounded-tr-xl">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody class="bg-white">

                @forelse($books as $book)

                <tr class="border-b hover:bg-slate-50 transition duration-200">

                    <!-- NO -->
                    <td class="px-5 py-5 text-center font-semibold text-slate-600">
                        {{ $loop->iteration }}
                    </td>

                    <!-- COVER -->
                    <td class="px-5 py-5">

                        <img src="{{ asset('storage/' . $book->cover) }}"
                             class="w-24 h-32 object-cover rounded-xl shadow-md mx-auto">

                    </td>

                    <!-- JUDUL -->
                    <td class="px-5 py-5">

                        <h2 class="font-bold text-slate-800 text-lg">
                            {{ $book->title }}
                        </h2>

                        <p class="text-slate-500 text-sm mt-1">
                            {{ Str::limit($book->description, 50) }}
                        </p>

                    </td>

                    <!-- PENULIS -->
                    <td class="px-5 py-5 text-slate-700 font-medium">
                        {{ $book->author }}
                    </td>

                    <!-- KATEGORI -->
                    <td class="px-5 py-5">

                        <span class="bg-blue-100 text-blue-700
                                     px-3 py-1 rounded-full text-sm">

                            {{ $book->category }}

                        </span>

                    </td>

                    <!-- TAHUN -->
                    <td class="px-5 py-5 text-center text-slate-700">
                        {{ $book->year }}
                    </td>

                    <!-- ACTION -->
                    <td class="px-5 py-5">

                        <div class="flex justify-center gap-3">

                            <!-- EDIT -->
                            <a href="{{ route('books.edit', $book->id) }}"

                               class="bg-yellow-400 hover:bg-yellow-500
                                      text-white px-4 py-2 rounded-lg shadow
                                      transition duration-200">

                                <i class="fa-solid fa-pen-to-square"></i>

                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('books.destroy', $book->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"

                                        onclick="return confirm('Yakin ingin menghapus data ini?')"

                                        class="bg-red-500 hover:bg-red-600
                                               text-white px-4 py-2 rounded-lg shadow
                                               transition duration-200">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <!-- EMPTY STATE -->
                <tr>

                    <td colspan="7"
                        class="text-center py-10 text-slate-500">

                        <div class="flex flex-col items-center">

                            <i class="fa-solid fa-book text-5xl mb-3 text-slate-300"></i>

                            <p class="text-lg font-medium">
                                Data buku belum tersedia
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection