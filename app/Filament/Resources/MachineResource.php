<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\MachineResource\Pages;
use App\Models\Machine;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\Kind;
use App\Models\Brand;
use App\Models\InspectionList;

class MachineResource extends BaseResource
{
    protected static ?string $model = Machine::class;

    protected static ?string $navigationGroup = 'Machines';

    protected static ?string $navigationIcon = 'heroicon-s-chip';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('supplier')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->translateLabel()
                    ->image(),
                Forms\Components\Select::make('kind_id')
                    ->translateLabel()
                    ->options(function () {
                        return Kind::all()->pluck('name', 'id');
                    }),
                Forms\Components\Select::make('brand_id')
                    ->translateLabel()
                    ->options(function () {
                        return Brand::all()->pluck('name', 'id');
                    }),
                Forms\Components\Select::make('inspection_list_id')
                    ->translateLabel()
                    ->options(function () {
                        return InspectionList::all()->pluck('name', 'id');
                    }),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('InspectionList.name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->translateLabel()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kind')
                    ->translateLabel()
                    ->relationship('kind', 'name'),
                Tables\Filters\SelectFilter::make('brand')
                    ->translateLabel()
                    ->relationship('brand', 'name'),
                Tables\Filters\SelectFilter::make('inspectionList')
                    ->translateLabel()
                    ->relationship('inspectionList', 'name'),
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
            'index' => Pages\ListMachines::route('/'),
            'create' => Pages\CreateMachine::route('/aanmaken'),
            'edit' => Pages\EditMachine::route('/{record}/bewerken'),
        ];
    }
}
