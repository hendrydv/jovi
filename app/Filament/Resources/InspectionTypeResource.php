<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\InspectionTypesResource\Pages;
use App\Models\InspectionList;
use App\Models\InspectionType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class InspectionTypeResource extends BaseResource
{
    protected static ?string $model = InspectionType::class;

    protected static ?string $navigationGroup = 'Inspections';

    protected static ?string $navigationIcon = 'heroicon-s-template';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->translateLabel()
                    ->maxLength(255),
                Forms\Components\Select::make('inspection_list_id')
                    ->options(function () {
                        return InspectionList::all()->pluck('name', 'id');
                    })
                    ->helperText(
                        'Selecteer een inspectie lijst die aan de inspectie soort wordt gekoppeld. Als er dan een
                        inspectie wordt gemaakt met dit inspectie soort, wordt deze inspectie lijst gebruikt. Dit veld is
                        uniek, dus er kan maar 1 inspectie lijst worden gekoppeld aan 1 inspectie soort.'
                    )
                    ->unique()
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('inspectionList.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListInspectionType::route('/'),
            'create' => Pages\CreateInspectionType::route('/create'),
            'edit' => Pages\EditInspectionType::route('/{record}/edit'),
        ];
    }
}
