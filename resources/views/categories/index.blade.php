@extends('layouts.admin')
@section('content')
    <div class="mx-auto">
        <table class="table table-zebra mx-auto mt-20">
            <thead>
                <tr class="">
                    <td class="">Category ID</td>
                    <td class="">Category Name</td>
                    <td class="">Actions</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $cat)
                    <tr class="hover">
                        <td>{{ $cat->id }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', ['category' => $cat->id]) }}"
                                class="btn btn-outline btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}" method="post"
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
