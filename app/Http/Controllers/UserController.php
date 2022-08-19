<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BookIssue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show Register Page
    public function register()
    {
        return view('auth.register');
    }

    // Save User Credentials into Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);

        return redirect()->route('users.login')->with('message', 'You have been successfully registered!');
    }    

    // Show Login Page
    public function login()
    {
        return view('auth.login');
    }

    // Authenticate User and Login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role == 'admin') {
                return redirect()->route('books.index')->with('message', 'you have successfully logged in');
            }

            return redirect()->route('home.index')->with('message', 'you have successfully logged in');
        }
    }

    // Logout User
    public function logout(Request $request, $id)
    {
        $user = User::find($id);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('home.index')->with('message', 'You have logged out successfully');
    }

    public function dashboard()
    {
        // $books = DB::table('books')
        //         ->join('book_issues', 'books.id', '=', 'book_issues.book_id')
        //         ->where('user_id', Auth::id())->get();
        
        $books = DB::table('books')
                ->join('book_issues', 'book_issues.book_id', '=', 'books.id')
                ->where('issue', '=', true)
                ->where('user_id', '=', Auth::user()->id)->get();

                // dd($books);
        return view('dashboard', ['books' => $books]); 
    }

    

}
