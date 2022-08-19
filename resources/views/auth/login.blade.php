@extends('layouts.base')
@section('content')

    <div class="container mx-auto">
        <div class="max-w-xl mx-auto mt-20 bg-gray-200 rounded-lg py-8">
            <h2 class="font-semibold text-2xl text-center py-4">Log in</h2>
            <form action="{{ route('users.authenticate') }}" method="POST" class="w-2/3 mx-auto items-center">
                @csrf
                <div>
                    <input type="email" name="email" placeholder="Enter Email" class="input input-bordered input-accent w-full" />
                    @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <input type="password" name="password" placeholder="Enter your password"
                        class="input input-bordered input-accent w-full" />
                </div>

                <button class="btn btn-accent mt-8 w-28">Login</button>
            </form>
            <div class="flex space-x-3 w-2/3 mx-auto mt-4">
                <p>New User?</p>
                <a href="{{ route('users.register') }}" class="text-accent hover:underline">Register</a>
            </div>
        </div>
    </div>
@endsection
