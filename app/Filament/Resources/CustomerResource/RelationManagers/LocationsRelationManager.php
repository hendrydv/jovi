<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Filament\BaseRelationManager;
use App\Models\Location;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;

class LocationsRelationManager extends BaseRelationManager
{
    public static ?string $model = Location::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('street')
                    ->label('Straat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('house_number')
                    ->label('Huisnummer')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip_code')
                    ->label('Postcode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label('Plaats')
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
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('house_number')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('open')
                    ->icon('heroicon-s-external-link')
                    ->url(function (Location $record): string {
                        $slug = static::getPluralModelLabel();
                        return route("filament.resources.$slug.edit", $record);
                    }),
                Tables\Actions\DetachAction::make()
                    ->action(fn (Location $record) => $record->customer()->dissociate()->save())
                    ->icon('heroicon-s-x'),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()
                    ->icon('heroicon-s-x')
                    ->action(fn (Collection $records) => $records->each(
                        fn (Location $record) => $record->customer()->dissociate()->save()
                    )),
            ]);
    }
}
