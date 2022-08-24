<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $books = DB::table('books')
            ->join('categories', 'categories.id', '=', 'books.cat_id')
            ->select('books.*', 'categories.name as category')->get();

        return view('index', ['books' => $books]);
    }

    public function search(Request $request)
    {
        $term = $request->search;
        $books = DB::table('books')
            ->join('categories', 'categories.id', '=', 'books.id')
            ->where('title', 'like', '%' . $term . '%')
            ->orWhere('author', 'like', '%' . $term . '%')
            ->select('books.*', 'categories.name as category')->get();

        return view('search', ['books' => $books]);
    }
}
