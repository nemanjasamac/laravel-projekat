@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="text-center mb-5">Dobrodosli, {{ auth()->user()->name }}!</h1>

        <div class="d-flex justify-content-between mb-4">
            <h2>Konsultacije</h2>
            <a href="{{ route('consultations.create') }}" class="btn btn-primary">Zakazi novu konsultaciju</a>
        </div>

        @if($consultations->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Klijent</th>
                            <th>Usluga</th>
                            <th>Datum</th>
                            <th>Status</th>
                            <th>Beleske</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consultations as $consultation)
                            <tr>
                                <td>
                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
                                        {{ $consultation->user->name ?? '-' }}
                                    @else
                                        Vi
                                    @endif
                                </td>
                                <td>{{ $consultation->service->title ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($consultation->scheduled_at)->format('d.m.Y. H:i') }}</td>
                                <td>{{ ucfirst($consultation->status) }}</td>
                                <td>{{ $consultation->notes }}</td>
                                <td>
                                    <a href="{{ route('consultations.edit', $consultation->id) }}"
                                        class="btn btn-sm btn-warning me-2">Izmeni</a>
                                    <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST"
                                        style="display: inline-block;"
                                        onsubmit="return confirm('Da li sigurno zelite da obrisete ovu konsultaciju?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Obriši</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Nema zakazanih konsultacija.</p>
        @endif

    </div>

@endsection