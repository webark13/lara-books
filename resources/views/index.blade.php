@extends('layouts.base')
@section('content')
    <section id="home-cover" class="bg-gray-100">
        <div class="min-h-screen bg-black bg-opacity-50 flex justify-center items-center">
            <form action="{{ route('home.search') }}" method="POST" class="w-full max-w-2xl mx-auto p-4">
                @csrf
                <div class="form-control">
                    <div class="input-group">
                        <input type="text" name="search" placeholder="Search Books or Authors..."
                            class="input-md focus:outline-none text-lg w-10/12 md:w-11/12" />
                        <button class="btn btn-square w-2/12 md:w-1/12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    {{-- Show All Books --}}
    <div class="container mx-auto mt-10">
        @guest
            <h2 class="text-center text-2xl mt-4">Log in to get a Book</h2>
        @endguest
        <table class="table table-zebra mx-auto mt-20">
            <thead>
                <tr class="">
                    <td></td>
                    <td>Book ID</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Category</td>
                    <td>Issue</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($books as $book)
                    <tr class="hover">
                        <td>
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('storage/book.png') }}"
                                        alt="book image" />
                                </div>
                            </div>
                        </td>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category }}</td>
                        @auth
                            <td>
                                <form action="{{ route('book_issues.request_book', ['book_id' => $book->id]) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-accent" value="Request Issue">
                                </form>
                            </td>
                        @else
                            <td><a href="{{ route('users.login') }}"
                                    class="text-blue-500 hover:underline hover:text-blue-600">Login to Issue</a></td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
