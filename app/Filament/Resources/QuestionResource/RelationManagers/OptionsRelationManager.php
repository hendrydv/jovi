<?php

namespace App\Filament\Resources\QuestionResource\RelationManagers;

use App\Filament\BaseRelationManager;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\Option;

class OptionsRelationManager extends BaseRelationManager
{
    protected static ?string $model = Option::class;
    protected static ?string $recordTitleAttribute = 'option';

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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                ->color('primary')
                ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                ->icon('heroicon-s-external-link')
                ->url(function (Option $record): string {
                    $slug = static::getPluralModelLabel();
                    return route("filament.resources.$slug.edit", $record);
                }),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }    
}
