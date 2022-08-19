@extends('layouts.base')
@section('content')
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
