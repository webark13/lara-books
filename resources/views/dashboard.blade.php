@extends('layouts.base')

@section('content')
    
    <div class=" mt-20 mx-auto">
        <table class="table table-zebra mx-auto">
            <thead>
                <tr class="">
                    <td>Cover</td>
                    <td>Issue ID</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Publisher</td>
                    <td>Issue Time</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="hover">
                        <td>
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('storage/book.png') }}"
                                        alt="book cover" />
                                </div>
                            </div>
                        </td>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td>
                            <form action="{{ route('book_issues.return_book', ['issue_id' => $book->id]) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <input type="submit" class="btn btn-accent" value="Return">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
