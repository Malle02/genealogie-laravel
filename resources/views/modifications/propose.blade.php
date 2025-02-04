<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h1 class="mb-4 text-primary">📌 Proposer une modification</h1>
            <form action="{{ route('modifications.propose') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">📝 Type de modification</label>
                    <select name="type" class="form-select">
                        <option value="ajout_relation">Ajouter une relation</option>
                        <option value="modification_person">Modifier une personne</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">🔍 ID de la personne concernée</label>
                    <input type="number" name="person_id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">📜 Données (JSON)</label>
                    <textarea name="data" class="form-control" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">✅ Soumettre</button>
            </form>
        </div>
    </div>
</x-app-layout>
