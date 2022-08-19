@extends('layouts.admin')
@section('content')
    <div class="container mx-auto">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-2xl mx-auto mt-16 px-4 md:px-32 flex flex-col space-y-4">
            @csrf

            <div class="form-control max-w-xl">
                <label class="label">
                    <span class="label-text">Category Name</span>
                </label>
                <input type="text" placeholder="Category Name" name="name" class="input input-bordered" />
                @error('title')
                    <p class="text-red-500 mt-1 text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-control max-w-xl">
                <button class="btn btn-accent text-white text-xl">Add Category</button>
            </div>

        </form>
    </div>
@endsection
