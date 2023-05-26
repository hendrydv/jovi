<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\SpaceResource\Pages;
use App\Filament\Resources\SpaceResource\RelationManagers;
use App\Models\Space;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\Department;

class SpaceResource extends BaseResource
{
    protected static ?string $model = Space::class;

    protected static ?string $navigationGroup = 'Customers';

    protected static ?string $navigationIcon = 'heroicon-s-cube';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('department_id')
                    ->translateLabel()
                    ->options(function () {
                        return Department::all()->pluck('name', 'id');
                    }),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('department.location.customer.name')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->translateLabel()
                    ->getStateUsing( function (Space $record){
                        return $record->department?->location?->fullAddress() ?? "";
                    }),
                Tables\Columns\TextColumn::make('department.name')
                    ->translateLabel()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->translateLabel()
                    ->relationship('department', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MachinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpaces::route('/'),
            'create' => Pages\CreateSpace::route('/aanmaken'),
            'edit' => Pages\EditSpace::route('/{record}/bewerken'),
        ];
    }
}
