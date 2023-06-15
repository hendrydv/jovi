<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\InspectionResource\Pages;
use App\Filament\Resources\InspectionResource\RelationManagers\MachinesRelationManager;
use App\Filament\Resources\InspectionResource\Widgets\ExecuteInspectionWidget;
use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\Machine;
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
                Forms\Components\Select::make('customer_id')
                    ->translateLabel()
                    ->options(function () {
                        return Customer::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->translateLabel()
                    ->options(function () {
                        return User::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('inspection_type_id')
                    ->translateLabel()
                    ->options(function () {
                        return InspectionType::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
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
                Tables\Columns\TextColumn::make('customer.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inspection_type.name')
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
            MachinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInspections::route('/'),
            'create' => Pages\CreateInspection::route('/aanmaken'),
            'edit' => Pages\EditInspection::route('/{record}/bewerken'),
            'execute' => Pages\ExecuteInspection::route('/{inspection}/uitvoeren/{spaceMachine}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ExecuteInspectionWidget::class,
        ];
    }
}
