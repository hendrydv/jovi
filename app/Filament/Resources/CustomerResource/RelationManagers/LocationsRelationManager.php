<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Models\Location;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;

class LocationsRelationManager extends RelationManager
{
    protected static string $relationship = 'locations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('house_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('house_number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('open')
                    ->label('Open')
                    ->icon('heroicon-s-external-link')
                    ->url(fn (Location $record): string => route('filament.resources.locations.edit', $record)),
                Tables\Actions\Action::make('detach')
                    ->label('Detach')
                    ->icon('heroicon-s-x')
                    ->action(fn (Location $record) => $record->customer()->dissociate()->save()),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('detach')
                    ->label('Detach selected')
                    ->icon('heroicon-s-x')
                    ->action(fn (Collection $records) => $records->each(
                        fn (Location $record) => $record->customer()->dissociate()->save()
                    )),
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['street', 'house_number', 'zip_code', 'city'];
    }
}
