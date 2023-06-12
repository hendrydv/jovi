<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\InspectionTypesResource\Pages;
use App\Models\InspectionType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class InspectionTypesResource extends BaseResource
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel(),
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
            'index' => Pages\ListInspectionTypes::route('/'),
            'create' => Pages\CreateInspectionTypes::route('/create'),
            'edit' => Pages\EditInspectionTypes::route('/{record}/edit'),
        ];
    }
}
