<x-app-layout>
    <div class="container mt-4">
        <h1 class="text-primary">📨 Mes Invitations</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>👤 Personne</th>
                            <th>📧 Email</th>
                            <th>⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invitations as $invitation)
                            <tr>
                                <td>{{ $invitation->person->first_name }} {{ $invitation->person->last_name }}</td>
                                <td>{{ $invitation->email }}</td>
                                <td>
                                    <a href="{{ route('invite.accept', $invitation->id) }}" class="btn btn-success btn-sm">✅ Accepter</a>
                                    <a href="{{ route('invite.reject', $invitation->id) }}" class="btn btn-danger btn-sm">❌ Refuser</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
