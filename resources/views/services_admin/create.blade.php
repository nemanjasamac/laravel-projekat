@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dodaj novu uslugu</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Naziv usluge</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Cena (RSD)</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategorija</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Odaberi kategoriju --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">Istaknuta usluga</label>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Slika usluge</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Sačuvaj</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Otkaži</a>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#description').summernote({
        height: 200,
        placeholder: 'Unesite opis usluge...'
    });
});
</script>
@endsection
