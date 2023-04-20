<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\InspectionResource\Pages;
use App\Filament\Resources\InspectionResource\RelationManagers\InspectionResultsRelationManager;
use App\Models\Inspection;
use App\Models\Machine;
use App\Models\Space;
use App\Models\User;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class InspectionResource extends BaseResource
{
    protected static ?string $model = Inspection::class;

    protected static ?string $navigationGroup = 'Inspections';

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-check';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('space_id')
                    ->translateLabel()
                    ->options(function () {
                        return Space::all()->mapWithKeys(function ($space) {
                            return [$space->id => $space->fullSpaceName()];
                        });
                    }),
                Forms\Components\Select::make('machine_id')
                    ->translateLabel()
                    ->options(function () {
                        return Machine::all()->mapWithKeys(function ($machine) {
                            return [$machine->id => $machine->fullMachineName()];
                        });
                    }),
                Forms\Components\Select::make('user_id')
                    ->translateLabel()
                    ->options(function () {
                        return User::all()->pluck('name', 'id');
                    }),
                Forms\Components\DatePicker::make('date')
                    ->translateLabel()
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->translateLabel(),
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
                Tables\Columns\TextColumn::make('machine')
                    ->translateLabel()
                    ->getStateUsing(fn (Inspection $record) => $record->machine?->fullMachineName() ?? ""),
                Tables\Columns\TextColumn::make('user.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->translateLabel()
                    ->relationship('user', 'name'),
                Tables\Filters\SelectFilter::make('machine')
                    ->translateLabel()
                    ->options(function () {
                        return Machine::all()->mapWithKeys(function ($machine) {
                            return [$machine->id => $machine->fullMachineName()];
                        });
                    })
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
            InspectionResultsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInspections::route('/'),
            'create' => Pages\CreateInspection::route('/aanmaken'),
            'edit' => Pages\EditInspection::route('/{record}/bewerken'),
        ];
    }
}
