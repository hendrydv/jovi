<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\OptionResource\Pages;
use App\Models\Option;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class OptionResource extends BaseResource
{
    protected static ?string $model = Option::class;

    protected static ?string $navigationGroup = 'Inspections';

    protected static ?string $navigationIcon = 'heroicon-s-question-mark-circle';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('option')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('option')
                    ->translateLabel(),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOptions::route('/'),
            'create' => Pages\CreateOption::route('/aanmaken'),
            'edit' => Pages\EditOption::route('/{record}/bewerken'),
        ];
    }    
}
