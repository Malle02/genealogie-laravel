
<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h1 class="text-primary">👤 {{ $person->first_name }} {{ $person->last_name }}</h1>

            <h3 class="mt-3">📩 Inviter un membre</h3>
            <form action="{{ route('invite') }}" method="POST">
                @csrf
                <input type="hidden" name="person_id" value="{{ $person->id }}">
                <div class="mb-3">
                    <label class="form-label">📧 Email du membre</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">📨 Envoyer l'invitation</button>
            </form>

            <h3 class="mt-3">🧑‍🤝‍🧑 Parents</h3>
            <ul class="list-group">
                @foreach($person->parents as $parent)
                    <li class="list-group-item">{{ $parent->first_name }} {{ $parent->last_name }}</li>
                @endforeach
            </ul>

            <h3 class="mt-3">👶 Enfants</h3>
            <ul class="list-group">
                @foreach($person->children as $child)
                    <li class="list-group-item">{{ $child->first_name }} {{ $child->last_name }}</li>
                @endforeach
            </ul>
            <a href="{{ route('modifications.propose') }}" class="btn btn-warning">✏️ Proposer une modification</a>

            <a href="{{ route('people.index') }}" class="btn btn-secondary mt-4">⬅️ Retour</a>
        </div>
    </div>
</x-app-layout>
