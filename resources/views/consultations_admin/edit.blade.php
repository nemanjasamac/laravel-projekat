@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Izmeni status konsultacije</h2>

    <form action="{{ route('admin.consultations.update', $consultation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="zakazano" {{ $consultation->status == 'zakazano' ? 'selected' : '' }}>Zakazano</option>
                <option value="završeno" {{ $consultation->status == 'završeno' ? 'selected' : '' }}>Završeno</option>
                <option value="otkazano" {{ $consultation->status == 'otkazano' ? 'selected' : '' }}>Otkazano</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
        <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">Nazad</a>
    </form>
</div>
@endsection
