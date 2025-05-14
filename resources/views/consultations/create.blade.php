@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Zakaži konsultaciju</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('consultations.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="service_id" class="form-label">Usluga</label>
            <select required name="service_id" id="service_id" class="form-select @error('service_id') is-invalid @enderror">
                <option value="">Izaberite uslugu</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->title }}
                    </option>
                @endforeach
            </select>
            @error('service_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="date" class="form-label">Datum</label>
            <input type="date" required name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="time" class="form-label">Vreme</label>
            <input type="time" required name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}">
            @error('time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="notes" class="form-label">Dodatne napomene</label>
            <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Zakaži konsultaciju</button>
    </form>
</div>
@endsection
