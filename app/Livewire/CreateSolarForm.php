<?php

namespace App\Livewire;

use App\Enums\StatusEnum;
use App\Models\SolarForm;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class CreateSolarForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('hasSolar')
                    ->label('Do you already have solar panels?')
                    ->inline(false)
                    ->onColor('success')
                    ->offColor('danger')
                    ->required()
                    ->rules(['boolean']),
                TextInput::make('panel_count')
                    ->label('How many solar panels do you want to install?')
                    ->required()
                    ->numeric()
                    ->rules([
                        fn(): Closure => function (string $attribute, $value, Closure $fail) {
                            if ($value < 0) {
                                $fail('The number is invalid.');
                            }
                        },
                    ])
            ])
            ->statePath('data');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function create(): void
    {
        //Validate
        //dd($this->form->getState());

        SolarForm::create($this->form->getState());
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.create-solar-form');
    }
}
