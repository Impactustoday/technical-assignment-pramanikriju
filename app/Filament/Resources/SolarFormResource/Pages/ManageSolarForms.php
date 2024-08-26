<?php

namespace App\Filament\Resources\SolarFormResource\Pages;

use App\Filament\Resources\SolarFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSolarForms extends ManageRecords
{
    protected static string $resource = SolarFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
