<?php

namespace App\Filament\Resources;

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

class MachineResource extends Resource
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
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('supplier')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\Select::make('kind_id')
                    ->options(function () {
                        return Kind::all()->pluck('name', 'id');
                    })
                    ->label('Kind'),
                Forms\Components\Select::make('brand_id')
                    ->options(function () {
                        return Brand::all()->pluck('name', 'id');
                    })
                    ->label('Brand'),
                Forms\Components\Select::make('inspection_list_id')
                    ->options(function () {
                        return InspectionList::all()->pluck('name', 'id');
                    })
                    ->label('Inspection list'),
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
                    ->sortable()
                    ->label('Kind'),
                Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable()
                    ->label('Brand'),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('InspectionList.name')
                    ->sortable()
                    ->searchable()
                    ->label('Inspection list'),
                Tables\Columns\ImageColumn::make('image')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kind')
                    ->relationship('kind', 'name'),
                Tables\Filters\SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
                Tables\Filters\SelectFilter::make('inspectionList')
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
            'create' => Pages\CreateMachine::route('/create'),
            'edit' => Pages\EditMachine::route('/{record}/edit'),
        ];
    }
}
