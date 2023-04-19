<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InspectionResource\Pages;
use App\Filament\Resources\InspectionResource\RelationManagers\InspectionResultsRelationManager;
use App\Models\Inspection;
use App\Models\Machine;
use App\Models\Space;
use App\Models\User;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class InspectionResource extends Resource
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
                    ->options(function () {
                        return Space::all()->mapWithKeys(function ($space) {
                            return [$space->id => $space->fullSpaceName()];
                        });
                    })
                    ->label('Space'),
                Forms\Components\Select::make('machine_id')
                    ->options(function () {
                        return Machine::all()->mapWithKeys(function ($machine) {
                            return [$machine->id => $machine->fullMachineName()];
                        });
                    })
                    ->label('Machine'),
                Forms\Components\Select::make('user_id')
                    ->options(function () {
                        return User::all()->pluck('name', 'id');
                    })
                    ->label('User'),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Textarea::make('notes'),
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
                    ->getStateUsing( function (Inspection $record) {
                        return $record->machine->fullMachineName() ?? "";
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name'),
                Tables\Filters\SelectFilter::make('machine')
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
            'create' => Pages\CreateInspection::route('/create'),
            'edit' => Pages\EditInspection::route('/{record}/edit'),
        ];
    }
}
