<?php

namespace App\Filament\Resources\LocationResource\RelationManagers;

use App\Filament\BaseRelationManager;
use App\Models\Department;
use App\Models\Location;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;
use function route;

class DepartmentsRelationManager extends BaseRelationManager
{
    public static ?string $model = Department::class;

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
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
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
                    ->url(function (Department $record): string {
                        $slug = static::getPluralModelLabel();
                        return route("filament.resources.$slug.edit", $record);
                    }),
                Tables\Actions\DetachAction::make()
                    ->icon('heroicon-s-x')
                    ->action(fn (Department $record) => $record->location()->dissociate()->save()),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()
                    ->icon('heroicon-s-x')
                    ->action(fn (Collection $records) => $records->each(
                        fn (Department $record) => $record->location()->dissociate()->save()
                    )),
            ]);
    }
}
