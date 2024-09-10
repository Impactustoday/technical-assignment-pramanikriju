<?php

use App\Filament\Resources\SolarFormResource;
use App\Filament\Resources\SolarFormResource\Pages\ManageSolarForms;
use App\Models\SolarForm;
use App\Models\User;
use function Pest\Laravel\{actingAs};
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;
use App\Enums\StatusEnum;


uses(RefreshDatabase::class);

test('authenticated user can access the dashboard', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/admin')
        ->assertStatus(200);
        actingAs($user)->get('/admin/solar-forms')
        ->assertStatus(200);
});


it('can render status columns', function () {
    $forms = SolarForm::factory()->count(10)->create();

    livewire(ManageSolarForms::class)
        ->assertCanSeeTableRecords($forms)
        ->assertCountTableRecords(10)
        ->assertCanRenderTableColumn('status');
});

it('can render status select columns with options', function () {
    $form = SolarForm::factory()->create();

    livewire(ManageSolarForms::class)
        ->assertCanRenderTableColumn('status')
        ->assertTableSelectColumnHasOptions('status', array_column(StatusEnum::cases(), 'name', 'value'), $form);

});
