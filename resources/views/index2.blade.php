@extends('layouts/base')
@section('content')
    <div id="home-cover" class="">
        <div class="bg-black bg-opacity-40 min-h-screen py-12">
            <div class="max-w-2xl mx-auto text-center">
                <div>
                    <h1 class="px-20 text-yellow-400 text-3xl md:text-4xl font-bold leading-normal ">Welcome to Library Management System</h1>
                    <p class="text-md text-white mt-4">Your all in one management tool for your library</p>
                    <h3 class="text-3xl text-white mt-10">Select one of the options below to proceed</h3>
                </div>

                <div class="flex flex-col px-8 mt-28 space-y-4  justify-center md:space-y-0 md:flex-row md:space-x-4 ">
                    <a href="" class=" px-6 py-4 bg-cyan-400 hover:bg-cyan-300 rounded-md text-xl font-bold sm:max-w-60 "><i class="fa-solid fa-user-lock mr-6"></i> I am an Admin</a>
                    <a href="{{ route('users.authenticate') }}"  class=" px-6 py-4 bg-gray-200 hover:bg-gray-100 rounded-md text-xl font-bold sm:max-w-60 "><i class="fa-regular fa-user mr-6"></i>I am an User</a>
                </div>
            </div>
        </div>
    </div>
@endsection
