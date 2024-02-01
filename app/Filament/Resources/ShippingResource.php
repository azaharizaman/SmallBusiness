<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingResource\Pages;
use App\Filament\Resources\ShippingResource\RelationManagers;
use App\Models\Shipping;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippingResource extends Resource
{
    protected static ?string $model = Shipping::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
                Forms\Components\Select::make('business_partner_id')
                    ->relationship('business_partner', 'id')
                    ->required(),
                Forms\Components\TextInput::make('shipping_number')
                    ->required(),
                Forms\Components\TextInput::make('shipping_method')
                    ->required(),
                Forms\Components\TextInput::make('shipping_status')
                    ->required(),
                Forms\Components\TextInput::make('shipping_cost')
                    ->required(),
                Forms\Components\TextInput::make('shipping_currency')
                    ->required(),
                Forms\Components\TextInput::make('shipping_carrier')
                    ->required(),
                Forms\Components\TextInput::make('shipping_tracking_url')
                    ->required(),
                Forms\Components\TextInput::make('shipping_tracking_number')
                    ->required(),
                Forms\Components\Textarea::make('shipping_tracking_status')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_partner.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipping_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_cost')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_currency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_carrier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_tracking_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shipping_tracking_number')
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
            'index' => Pages\ListShippings::route('/'),
            'create' => Pages\CreateShipping::route('/create'),
            'view' => Pages\ViewShipping::route('/{record}'),
            'edit' => Pages\EditShipping::route('/{record}/edit'),
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
