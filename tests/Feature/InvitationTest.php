<?php
use App\Models\User;
use App\Models\Person;
use App\Models\Invitation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('permet à un utilisateur d’envoyer une invitation', function () {
    $user = User::factory()->create();
    $person = Person::factory()->create();

    $this->actingAs($user); 

    $response = $this->post('/invite', [
        'email' => 'test@example.com',
        'person_id' => $person->id
    ]);

    $response->assertRedirect();
    expect(Invitation::where('email', 'test@example.com')->exists())->toBeTrue();
});

it('un utilisateur ne peut pas envoyer une invitation à un email déjà enregistré', function () {
    $user = User::factory()->create();
    $person = Person::factory()->create();
    User::factory()->create(['email' => 'test@example.com']);

    $this->actingAs($user); 

    $response = $this->post('/invite', [
        'email' => 'test@example.com',
        'person_id' => $person->id
    ]);

    $response->assertSessionHasErrors('email');
});

