<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

use App\Livewire\CreateSolarForm;
use App\Models\SolarForm;
use function Pest\Laravel\{post, get, put};
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;


uses(RefreshDatabase::class);

// Test that the form is displayed correctly
it('renders the solar panel form correctly', function () {

    $this->get('/')
        ->assertSeeLivewire(CreateSolarForm::class)
        ->assertOk()
        ->assertSee('Do you already have solar panels?')
        ->assertSee('How many solar panels do you want to install?');
});

// Test the form submission with valid data
it('can submit the form with valid data', function () {
    livewire(CreateSolarForm::class)
    ->fillForm([
        'has_solar_panels' => 1,
        'panel_count' => 6,
    ])
    ->call('create')
    ->assertHasNoFormErrors();
    $this->assertDatabaseHas('solar_forms', [
        'panel_count' => 6,
        'status' => 'qualified',
    ]);
});

// Test that the form is marked as unqualified if panel count < 5
it('marks form as unqualified if panel count is less than five', function () {
    livewire(CreateSolarForm::class)
    ->fillForm([
        'has_solar_panels' => 1,
        'panel_count' => 4,
    ])
    ->call('create')
    ->assertHasNoFormErrors();

    $this->assertDatabaseHas('solar_forms', [
        'panel_count' => 4,
        'status' => 'unqualified',
    ]);
});

// Test that form submission requires a valid panel count
it('requires the panel count to be a number', function () {
    livewire(CreateSolarForm::class)
    ->fillForm([
        'has_solar_panels' => 1,
        'panel_count' => 'definitely not a number',
    ])
    ->call('create')
    ->assertHasFormErrors(['panel_count' => 'numeric']);
});
