<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\SolarFormResource\Pages;
use App\Filament\Resources\SolarFormResource\RelationManagers;
use App\Models\SolarForm;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SolarFormResource extends Resource
{
    protected static ?string $model = SolarForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('hasSolar')
                    ->required(),
                TextInput::make('panel_count')
                    ->required()
                    ->numeric(),
                ToggleButtons::make('status')
                    ->options(array_column(StatusEnum::cases(), 'name', 'value'))
                    ->required()
                    ->default(StatusEnum::UNQUALIFIED->value)
                    ->grouped()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('hasSolar')
                    ->boolean(),
                TextColumn::make('panel_count')
                    ->numeric()
                    ->sortable(),
                SelectColumn::make('status')
                    ->options(array_column(StatusEnum::cases(), 'name', 'value'))
                    ->rules(['required']),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSolarForms::route('/'),
        ];
    }
}
