<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InspectionResource\Pages;
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

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                    ->getStateUsing( function (Inspection $record){
                        return $record->machine->fullMachineName() ?? "";
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
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
