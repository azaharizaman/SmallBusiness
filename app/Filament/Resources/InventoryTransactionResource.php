<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryTransactionResource\Pages;
use App\Filament\Resources\InventoryTransactionResource\RelationManagers;
use App\Models\InventoryTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryTransactionResource extends Resource
{
    protected static ?string $model = InventoryTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'id')
                    ->required(),
                Forms\Components\TextInput::make('quantity_in')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('quantity_out')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('value_in')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('value_out')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('transaction_type')
                    ->required(),
                Forms\Components\TextInput::make('transaction_status')
                    ->required(),
                Forms\Components\TextInput::make('transaction_date')
                    ->required(),
                Forms\Components\TextInput::make('transaction_time')
                    ->required(),
                Forms\Components\TextInput::make('transaction_user')
                    ->required(),
                Forms\Components\TextInput::make('transaction_notes')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity_in')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity_out')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value_in')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value_out')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_time')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_user')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_notes')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListInventoryTransactions::route('/'),
            'create' => Pages\CreateInventoryTransaction::route('/create'),
            'view' => Pages\ViewInventoryTransaction::route('/{record}'),
            'edit' => Pages\EditInventoryTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
