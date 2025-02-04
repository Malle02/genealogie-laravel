 <x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h1 class="text-primary">➕ Ajouter une personne</h1>
            
            <form action="{{ route('people.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">📝 Prénom</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">🔠 Nom</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">📜 Nom de naissance</label>
                    <input type="text" name="birth_name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">🔤 Autres prénoms</label>
                    <input type="text" name="middle_names" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">📅 Date de naissance</label>
                    <input type="date" name="date_of_birth" class="form-control">
                </div>

                <button type="submit" class="btn btn-success w-100">✅ Ajouter</button>
            </form>
        </div>
    </div>
</x-app-layout>
