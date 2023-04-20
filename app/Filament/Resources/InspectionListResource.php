<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\InspectionListResource\Pages;
use App\Filament\Resources\InspectionListResource\RelationManagers;
use App\Models\InspectionList;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class InspectionListResource extends BaseResource
{
    protected static ?string $model = InspectionList::class;

    protected static ?string $navigationGroup = 'Inspections';

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-list';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
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
            ])
            ->filters([
                //
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
            RelationManagers\QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInspectionLists::route('/'),
            'create' => Pages\CreateInspectionList::route('/aanmaken'),
            'edit' => Pages\EditInspectionList::route('/{record}/bewerken'),
        ];
    }
}
