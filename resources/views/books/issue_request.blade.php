@extends('layouts.admin')
@section('content')

    <div class="mt-20">
        <table class="table table-zebra ">
            <thead>
                <tr class="">
                    <td class=""></td>
                    <td class="">Book ID</td>
                    <td class="">Title</td>
                    <td class="">Author</td>
                    <td class="">Publisher</td>
                    <td class="text-center ">User Name</td>
                    <td class="text-center ">Action</td>
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
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->name }}</td>
                        <td>
                            <form action="{{ route('book_issues.issue_book', ['issue_id' => $book->issue_id]) }}"
                                method="post" class="inline-block">
                                @csrf
                                <input type="submit" name="" id="" class="btn btn-outline btn-accent"
                                    value="Approve">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
