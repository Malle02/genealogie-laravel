

<x-app-layout>
    <div class="container mt-4">
        <h1 class="text-primary">👨‍👩‍👧‍👦 Liste des personnes</h1>
        <a href="{{ route('people.create') }}" class="btn btn-success mb-3">➕ Ajouter une personne</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>👤 Prénom</th>
                            <th>🔠 Nom</th>
                            <th>🆔 Créé par</th>
                            <th>⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($people as $person)
                            <tr>
                                <td>{{ $person->first_name }}</td>
                                <td>{{ $person->last_name }}</td>
                                <td>{{ $person->createdBy->name ?? 'Inconnu' }}</td>
                                <td>
                                    <a href="{{ route('people.show', $person->id) }}" class="btn btn-info btn-sm">👁️ Voir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $people->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
