<?php

namespace App\Filament\Resources\InspectionListResource\RelationManagers;

use App\Filament\BaseRelationManager;
use App\Models\Question;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class QuestionsRelationManager extends BaseRelationManager
{
    protected static ?string $model = Question::class;

    protected static ?string $recordTitleAttribute = 'question';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
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
            ->reorderable('index')
            ->defaultSort('index')
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('question')
                    ->translateLabel()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->translateLabel()
                    ->color('primary')
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
