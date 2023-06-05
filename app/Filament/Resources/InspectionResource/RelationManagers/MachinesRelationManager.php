<?php

namespace App\Filament\Resources\InspectionResource\RelationManagers;

use App\Filament\BaseRelationManager;
use App\Models\SpaceMachine;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use function route;

class MachinesRelationManager extends BaseRelationManager
{
    protected static ?string $model = SpaceMachine::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('machine.type')
                    ->translateLabel()
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
                Tables\Columns\TextColumn::make('machine.type')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('machine.kind.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('machine.brand.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('space.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inventory_number')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
