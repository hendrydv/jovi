<?php

namespace App\Filament\Resources\InspectionResource\RelationManagers;

use App\Models\InspectionResult;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InspectionResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'inspectionResults';
    protected static ?string $pluralModelLabel = 'inspectie resultaten';

    protected static ?string $recordTitleAttribute = 'question';

//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Forms\Components\TextInput::make('question')
//                    ->required()
//                    ->maxLength(255),
//            ]);
//    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question.question'),
                Tables\Columns\SelectColumn::make('result')
                    ->options(InspectionResult::RESULT_TYPES)
                    ->rules(['required'])
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
