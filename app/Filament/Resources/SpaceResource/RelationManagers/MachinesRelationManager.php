<?php

namespace App\Filament\Resources\SpaceResource\RelationManagers;

use App\Models\Machine;
use App\Models\Space;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;
use function route;

class MachinesRelationManager extends RelationManager
{
    protected static string $relationship = 'machines';

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
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
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kind.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kind')
                    ->relationship('kind', 'name'),
                Tables\Filters\SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make('Add machine')
                    ->label('Add machine')
                    ->color('primary')
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->label('Open')
                    ->icon('heroicon-s-external-link')
                    ->url(fn (Machine $record): string => route('filament.resources.machines.edit', $record)),
                Tables\Actions\DetachAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()
            ]);
    }
}
