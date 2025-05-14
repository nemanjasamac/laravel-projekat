@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dodaj novu kategoriju</h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Naziv kategorije</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj</button>
    </form>
</div>
@endsection
