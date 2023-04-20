<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Customer;
use App\Models\Department;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\Location;

class DepartmentResource extends BaseResource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationGroup = 'Customers';

    protected static ?string $navigationIcon = 'heroicon-s-location-marker';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('location_id')
                    ->translateLabel()
                    ->options(function () {
                        return Location::all()->mapWithKeys(function ($location) {
                            return [$location->id => $location->fullAddress()];
                        });
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
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.customer.name')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->translateLabel()
                    ->getStateUsing( function (Department $record){
                        return $record->location?->fullAddress() ?? "";
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('customer')
                    ->translateLabel()
                    ->relationship('customer', 'name'),
                Tables\Filters\SelectFilter::make('location')
                    ->translateLabel()
                    ->options(function () {
                        return Location::all()->mapWithKeys(function ($location) {
                            $customer = $location->customer?->name;
                            if (!$customer) {
                                return [];
                            }
                            return [$location->id => "$customer - {$location->fullAddress()}"];
                        });
                    })
                    ->multiple()
                    ->attribute('location_id'),
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
            RelationManagers\SpacesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/aanmaken'),
            'edit' => Pages\EditDepartment::route('/{record}/bewerken'),
        ];
    }
}
