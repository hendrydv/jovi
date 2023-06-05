<?php

namespace App\Filament\Resources\InspectionResource\RelationManagers;

use App\Filament\BaseRelationManager;
use App\Models\Space;
use App\Models\SpaceMachine;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;
use function route;

class MachinesRelationManager extends BaseRelationManager
{
    protected static ?string $model = SpaceMachine::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('machine.type')
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
//                Tables\Columns\TextColumn::make('id')
//                    ->sortable()
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('name')
//                    ->translateLabel()
//                    ->sortable()
//                    ->searchable(),
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\Action::make('open')
//                    ->translateLabel()
//                    ->icon('heroicon-s-external-link')
//                    ->url(function (Space $record): string {
//                        $slug = static::getPluralModelLabel();
//                        return route("filament.resources.$slug.edit", $record);
//                    }),
//                Tables\Actions\DetachAction::make()
//                    ->icon('heroicon-s-x')
//                    ->action(fn (Space $record) => $record->department()->dissociate()->save()),
            ])
            ->bulkActions([
                //
            ]);
    }
}
