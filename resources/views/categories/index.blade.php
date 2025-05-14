@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Kategorije</h2>

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Dodaj novu kategoriju</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Izmeni</a>
                        @endif
                        
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Da li ste sigurni?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
