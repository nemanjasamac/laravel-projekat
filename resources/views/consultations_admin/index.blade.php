@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Upravljanje konsultacijama</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table id="consultations-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Poruka</th>
                    <th>Status</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $consultation)
                    <tr>
                        <td>{{ $consultation->user->name ?? '-' }}</td>
                        <td>{{ $consultation->user->email ?? '-' }}</td>
                        <td>{{ Str::limit(strip_tags($consultation->notes), 50) }}</td>
                        <td>{{ ucfirst($consultation->status) }}</td>

                        <td class="d-flex">
                            <a href="{{ route('admin.consultations.edit', $consultation->id) }}"
                                class="btn btn-sm btn-primary me-2">Izmeni status</a>
                            <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST"
                                onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu konsultaciju?');">
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#consultations-table').DataTable({
                "pageLength": 5,
                "lengthChange": true,
                "responsive": true,
                "language": {
                    "search": "Pretraga:",
                    "lengthMenu": "Prikaži _MENU_ konsultacija po strani",
                    "zeroRecords": "Nema pronađenih konsultacija",
                    "info": "Prikazano _START_ do _END_ od _TOTAL_ konsultacija",
                    "infoEmpty": "Nema dostupnih konsultacija",
                    "infoFiltered": "(filtrirano od _MAX_ ukupno konsultacija)",
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