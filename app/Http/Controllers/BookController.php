<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Show All Books
    public function index()
    {
        $books = DB::table('books')
            ->join('categories', 'categories.id', '=', 'books.cat_id')
            ->select('books.*', 'categories.name as category')->get();

        return view('books.index', ['books' => $books]);
    }

    // Show View to Add New Book
    public function create()
    {
        $categories = Category::all();

        return view('books.add', ['categories' => $categories]);
    }

    // Save New Book into Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'publisher' => ['required'],
            'category' => ['required'],
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->cat_id = $request->category;

        // Save Book image in Storage
        if ($request->hasFile('image')) {
            $image_name = time() . '.' . $request->file('image')->extension();
            Storage::disk('public')->put(
                $image_name,
                file_get_contents($request->file('image')->getRealPath())
            );
            $book->image = $image_name;
        }

        $book->save();
        return redirect()->back()->with('message', 'Book added successfully');
    }

    // Show Edit Page to
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('books.edit', ['book' => $book, 'categories' => $categories]);
    }

    // Update Book
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'publisher' => ['required'],
            'category' => ['required'],
        ]);

        $book = Book::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->cat_id = $request->category;

        // Save Book image in Storage
        if ($request->hasFile('image')) {
            $image_name = time() . '.' . $request->file('image')->extension();
            Storage::disk('public')->put(
                $image_name,
                file_get_contents($request->file('image')->getRealPath())
            );
            $book->image = $image_name;
        }

        $book->save();
        return redirect()->back()->with('message', 'Book Updated successfully');
    }

    // Delete Book
    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->back()->with('message', 'Book Deleted Successfully');
    }
}
