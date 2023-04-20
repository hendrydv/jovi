<?php

namespace App\Filament\Resources\SpaceResource\RelationManagers;

use App\Filament\BaseRelationManager;
use App\Models\Machine;
use App\Models\Space;
use Closure;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Contracts\HasRelationshipTable;

class MachinesRelationManager extends BaseRelationManager
{
    protected static ?string $model = Machine::class;

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
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
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kind.name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->translateLabel(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kind')
                    ->translateLabel()
                    ->relationship('kind', 'name'),
                Tables\Filters\SelectFilter::make('brand')
                    ->translateLabel()
                    ->relationship('brand', 'name'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->color('primary')
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('inventory_number')
                            ->translateLabel()
                            ->numeric()
                            ->required()
                            ->rules([
                                function (HasRelationshipTable $hasRelationShip) {
                                    /* @var Space $space */
                                    $space = $hasRelationShip->getRelationship()->getParent();
                                    return function (string $attribute, $value, Closure $fail) use ($space) {
                                        $spaceHasInventoryNumber = Space::find($space->id)
                                            ->machines()
                                            ->where(['inventory_number' => $value])
                                            ->exists();
                                        if ($spaceHasInventoryNumber) {
                                            $fail(__('spaceHasInventoryNumber'));
                                        }
                                    };
                                }
                            ])
                    ])
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->translateLabel()
                    ->icon('heroicon-s-external-link')
                    ->url(function (Machine $record): string {
                        $slug = static::getPluralModelLabel();
                        return route("filament.resources.$slug.edit", $record);
                    }),
                Tables\Actions\DetachAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()
            ]);
    }
}
