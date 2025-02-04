<?php
use App\Models\User;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('permet à un utilisateur authentifié de créer une personne', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/people', [
        'first_name' => 'John',
        'last_name' => 'DOE',
        'middle_names' => 'James',
        'birth_name' => 'DOE',
        'date_of_birth' => '2000-01-01',
    ]);

    $response->assertRedirect('/people');
    expect(Person::where('first_name', 'John')->exists())->toBeTrue();
});

it('empêche un utilisateur non authentifié de créer une personne', function () {
    $response = $this->post('/people', [
        'first_name' => 'Jane',
        'last_name' => 'DOE',
    ]);

    $response->assertRedirect('/login');
});
