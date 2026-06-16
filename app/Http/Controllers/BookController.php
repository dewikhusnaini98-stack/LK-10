<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('id', 'asc')->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|numeric',
            'category' => 'required|max:255',
            'description' => 'required',
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $cover = $request->file('cover')->store('covers', 'public');

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'category' => $request->category,
            'description' => $request->description,
            'cover' => $cover
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|numeric',
            'category' => 'required|max:255',
            'description' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('cover')) {

            Storage::disk('public')->delete($book->cover);

            $cover = $request->file('cover')->store('covers', 'public');

        } else {
            $cover = $book->cover;
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'category' => $request->category,
            'description' => $request->description,
            'cover' => $cover
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Storage::disk('public')->delete($book->cover);

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil dihapus');
    }
}