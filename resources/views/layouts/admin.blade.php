<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    {{-- Font Awsome Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lara Books</title>
</head>

<body class="antialiased">

    <header class="bg-fuchsia-900 text-white flex justify-between items-center px-6 py-2">
        <div><a href="{{ route('home.index') }}" class="text-2xl font-bold">Home</a></div>

        <h1 class="font-bold">LARAVEL BOOKS LIBRARY</h1>
        @guest
            <div>
                <a href="{{ route('users.login') }}" class="btn">Log in</a>
                <a href="{{ route('users.register') }}" class="btn">Register</a>
            </div>
        @else
            <div class="flex space-x-2">
                <a href="{{ route('books.index') }}" class="btn">Dashboard</a>
                <form action="{{ route('users.logout', ['id' => Auth::user()->id]) }}" method="POST" class="">
                    @csrf
                    <input type="submit" class="btn btn-error " value="Logout">
                </form>
            </div>
            {{-- <div>
                <i class="fa-solid fa-user mr-4"></i>
                <i class="fa-solid fa-book"></i>
            </div> --}}
        @endguest
    </header>

    <div class="flex">
        <nav class="m bg-gray-800 text-gray-100 md:w-2/12">
            <ul class="menu w-56 min-h-screen">
                <li class="hover-bordered hover:bg-gray-600"><a href="{{ route('books.index') }}">All Books</a></li>
                <li class="hover-bordered hover:bg-gray-600"><a href="{{ route('books.create') }}">Add Book</a></li>
                <li class="hover-bordered hover:bg-gray-600"><a href="{{ route('categories.index') }}">All Categories</a></li>
                <li class="hover-bordered hover:bg-gray-600"><a href="{{ route('categories.create') }}">Add Category</a></li>
                <li class="hover-bordered hover:bg-gray-600"><a href="{{ route('book_issues.issue_requests') }}">Issue
                        Requests</a></li>
            </ul>
        </nav>

        
        <div class="md:w-10/12 mx-auto ">
            @if (session('message'))
            <div class="h-20 relative">
                <p class="absolute top-0 left-0 w-full bg-green-400 p-2 text-center">{{ session('message') }}</p>
            </div>
        @elseif(session('error'))
            <div class="h-20 relative">
                <p class="absolute top-0 left-0 w-full bg-red-400 p-2 text-center">{{ session('error') }}</p>
            </div>
        @endif
        
            @yield('content')
        </div>
        
    </div>

</body>
</html>
