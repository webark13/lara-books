@extends('layouts.base')
@section('content')
    <div class="container mx-auto">
        <div class="mx-4  my-10 bg-gray-200 rounded-lg py-8 md:max-w-xl md:mx-auto">
            <h2 class="font-semibold text-2xl text-center py-4">Register</h2>
            <form action="{{ route('users.store') }}" method="POST" class="w-2/3 mx-auto items-center">
                @csrf
                <div>
                    <input type="text" name="name" placeholder="Enter your name"
                        class="input input-bordered input-accent w-full" />
                    @error('name')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <input type="text" name="email" placeholder="Enter Email"
                        class="input input-bordered input-accent w-full" />
                        @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <input type="password" name="password" placeholder="Enter your password"
                        class="input input-bordered input-accent w-full" />
                        @error('password')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <input type="password" name="password_confirmation" placeholder="Enter password again"
                        class="input input-bordered input-accent w-full" />
                </div>

                <button class="btn btn-accent mt-8 w-28">Register</button>

            </form>
        </div>
    </div>
@endsection
