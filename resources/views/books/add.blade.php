@extends('layouts.admin')
@section('content')

    <div class="container mx-auto">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-2xl mx-auto mt-16 px-4 md:px-32 flex flex-col space-y-4">
            @csrf

            <div class="form-control max-w-xl">
                <label class="label">
                    <span class="label-text">Add Book Title</span>
                </label>
                <input type="text" placeholder="Book Title" name="title" class="input input-bordered" />
                @error('title')
                    <p class="text-red-500 mt-1 text-xs">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="form-control max-w-xl">
                <label class="label">
                    <span class="label-text">Author</span>
                </label>
                <input type="text" placeholder="Enter Author" name="author" class="input input-bordered" />
                @error('author')
                    <p class="text-red-500 mt-1 text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-control max-w-xl">
                <label class="label">
                    <span class="label-text">Publisher</span>
                </label>
                <input type="text" placeholder="Enter Publisher" name="publisher" class="input input-bordered" />
                @error('publisher')
                    <p class="text-red-500 mt-1 text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-control max-w-xl">
                <label for="" class="label">
                    <span class="label-text">Add Image</span>
                </label>
                <input type="file" name="image" class="">
                @error('image')
                    <p class="text-red-500 mt-1 text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-control max-w-xl">
                <label class="label">
                    <span class="label-text">Select Category</span>
                </label>
                <select name="category" id="category" class="input input-bordered">
                    <option value="">Choose Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-red-500 mt-1 text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-control max-w-xl">
                <button class="btn btn-accent text-white text-xl">Add Book</button>
            </div>

        </form>
    </div>
@endsection
