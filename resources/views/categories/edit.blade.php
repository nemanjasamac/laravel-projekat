@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Izmeni kategoriju</h2>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Naziv kategorije</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" >
        </div>

        <button type="submit" class="btn btn-primary">Ažuriraj</button>
    </form>
</div>
@endsection
