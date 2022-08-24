@extends('layouts.admin')
@section('content')

    <div class="mx-auto">
        <table class="table table-zebra mx-auto mt-20">
            <thead>
                <tr class="">
                    <td class=""></td>
                    <td class="">Book ID</td>
                    <td class="">Title</td>
                    <td class="">Author</td>
                    <td class="">Category</td>
                    <td class="text-center ">Actions</td>
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
                        <td>
                            <a href="{{ route('books.edit', ['id' => $book->id]) }}"
                                class="btn btn-outline btn-warning">Edit</a>
                            <form action="{{ route('books.delete', ['id' => $book->id]) }}" method="post"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="" id="" class="btn btn-outline btn-error"
                                    value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
