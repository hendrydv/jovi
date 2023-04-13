<?php

namespace App\Filament\Resources\LocationResource\RelationManagers;

use App\Models\Department;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;
use function route;

class DepartmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'departments';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('open')
                    ->label('Open')
                    ->icon('heroicon-s-external-link')
                    ->url(fn (Department $record): string => route('filament.resources.departments.edit', $record)),
                Tables\Actions\Action::make('detach')
                    ->label('Detach')
                    ->icon('heroicon-s-x')
                    ->action(fn (Department $record) => $record->location()->dissociate()->save()),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('detach')
                    ->label('Detach selected')
                    ->icon('heroicon-s-x')
                    ->action(fn (Collection $records) => $records->each(
                        fn (Department $record) => $record->location()->dissociate()->save()
                    )),
            ]);
    }
}
