@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Administracija usluga</h2>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('services.create') }}" class="btn btn-primary">Dodaj novu uslugu</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($services->count())
            <div class="table-responsive">
                <table id="services-table" class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Naziv</th>
                            <th>Opis</th>
                            <th>Cena</th>
                            <th>Kategorija</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->title }}</td>
                                <td>{!! $service->description !!}</td>
                                <td>{{ number_format($service->price, 0) }} RSD</td>
                                <td>{{ $service->category->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('services.edit', $service->id) }}"
                                        class="btn btn-sm btn-warning me-2">Izmeni</a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu uslugu?');">
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
            <p class="text-muted">Trenutno nema dostupnih usluga.</p>
        @endif
    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#services-table').DataTable({
        "pageLength": 5,
        "lengthChange": true,
        "responsive": true,
        "language": {
            "search": "Pretraga:",
            "lengthMenu": "Prikaži _MENU_ zapisa po strani",
            "zeroRecords": "Nema pronađenih zapisa",
            "info": "Prikazano _START_ do _END_ od _TOTAL_ zapisa",
            "infoEmpty": "Nema dostupnih zapisa",
            "infoFiltered": "(filtrirano od _MAX_ ukupno zapisa)",
            "paginate": {
                "first": "Prva",
                "last": "Poslednja",
                "next": "Sledeća",
                "previous": "Prethodna"
            }
        }
    });
});
</script>
@endsection

