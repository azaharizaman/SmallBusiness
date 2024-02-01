<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
                Forms\Components\TextInput::make('parent_id')
                    ->numeric(),
                Forms\Components\Select::make('tax_id')
                    ->relationship('tax', 'name'),
                Forms\Components\Select::make('product_category_id')
                    ->relationship('product_category', 'id'),
                Forms\Components\TextInput::make('product_name')
                    ->required(),
                Forms\Components\TextInput::make('product_code')
                    ->required(),
                Forms\Components\Textarea::make('product_description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('product_type')
                    ->required(),
                Forms\Components\Textarea::make('product_group')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('product_images')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('product_is_physical')
                    ->required(),
                Forms\Components\TextInput::make('inventory_quantity_on_hand')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('product_cost_price')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('product_selling_price')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tax.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_category.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('product_is_physical')
                    ->boolean(),
                Tables\Columns\TextColumn::make('inventory_quantity_on_hand')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_cost_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_selling_price')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
