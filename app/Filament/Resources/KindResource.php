<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\KindResource\Pages;
use App\Models\Kind;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class KindResource extends BaseResource
{
    protected static ?string $model = Kind::class;

    protected static ?string $navigationGroup = 'Machines';

    protected static ?string $navigationIcon = 'heroicon-s-template';

    protected static ?int $navigationSort = 6;

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

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKinds::route('/'),
            'create' => Pages\CreateKind::route('/aanmaken'),
            'edit' => Pages\EditKind::route('/{record}/bewerken'),
        ];
    }
}
