<?php

namespace App\Filament\Resources;

use App\Filament\BaseResource;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Exception;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\Database\Query\Builder;

class CustomerResource extends BaseResource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationGroup = 'Customers';

    protected static ?string $navigationIcon = 'heroicon-s-user';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('contract_start_date')
                    ->translateLabel()
                    ->required(),
                Forms\Components\DatePicker::make('contract_end_date')
                    ->translateLabel()
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->translateLabel()
                    ->default(true)
                    ->required(),
                Select::make('preferred_month')
                    ->translateLabel()
                    ->options(Customer::MONTHS)
                    ->required(),
                Forms\Components\Section::make('Notes')
                    ->translateLabel()
                    ->schema([
                        Forms\Components\RichEditor::make('notes')
                            ->translateLabel()
                    ]),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        $contractPeriods = ['start', 'end'];

        $contractForms = [];

        foreach ($contractPeriods as $contractPeriod) {
            $contractForms[] = Filter::make("contract_{$contractPeriod}_date")
                ->form([
                    Forms\Components\DatePicker::make("contract_{$contractPeriod}_from")
                        ->translateLabel(),
                    Forms\Components\DatePicker::make("contract_{$contractPeriod}_until")
                        ->translateLabel(),
                ])
                ->query(function (Builder $query, array $data) use ($contractPeriod): Builder {
                    return $query
                        ->when(
                            $data["contract_{$contractPeriod}_from"],
                            fn (Builder $query, $date): Builder => $query->whereDate(
                                "contract_{$contractPeriod}_date",
                                '>=',
                                $date
                            ),
                        )
                        ->when(
                            $data["contract_{$contractPeriod}_until"],
                            fn (Builder $query, $date): Builder => $query->whereDate(
                                "contract_{$contractPeriod}_date",
                                '<=',
                                $date
                            ),
                        );
                });
        }

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contract_start_date')
                    ->translateLabel()
                    ->sortable()
                    ->date(),
                Tables\Columns\TextColumn::make('contract_end_date')
                    ->translateLabel()
                    ->sortable()
                    ->date(),
                Tables\Columns\IconColumn::make('is_active')
                    ->translateLabel()
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('preferred_month')
                    ->translateLabel()
                    ->getStateUsing(fn (Customer $record) => Customer::MONTHS[$record->preferred_month] ?? "")
                    ->sortable(),
            ])
            ->filters([
                ...$contractForms,
                Tables\Filters\TernaryFilter::make('is_active')
                    ->translateLabel(),
                Tables\Filters\SelectFilter::make('preferred_month')
                    ->translateLabel()
                    ->options(Customer::MONTHS),
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
            RelationManagers\LocationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/aanmaken'),
            'edit' => Pages\EditCustomer::route('/{record}/bewerken'),
        ];
    }
}
